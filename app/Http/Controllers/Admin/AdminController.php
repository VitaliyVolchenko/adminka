<?php

namespace App\Http\Controllers\Admin;

use App\Http\DTO\AdminFilter;
use App\Http\Requests\StoreAdminRequest;
use App\Models\User;
use App\Services\AdminService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    protected AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filter = new AdminFilter(
            $request->query('name') ?? '',
            $request->query('email') ?? '',
            $request->query('status') ?? ''
        );

        $admins = $this->adminService->getAdmins($filter);

        return view('admin.admins.index', [
            'admins' => $admins,
            'user' => auth()->user(),
            'name' => $filter->name,
            'email' => $filter->email,
            'status' => $filter->status,
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.admins.create');
    }

    /**
     * @param StoreAdminRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAdminRequest $request): RedirectResponse
    {
        $validated = array_merge($request->validated(), ['password' => bcrypt($request->password)]);

        $this->adminService->storeAdmin(new User, $validated);

        return redirect()->route('admin.admins.create')
            ->with('success', 'User created successfully.');
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('admin.admins.edit', compact('user'));
    }

    /**
     * @param StoreAdminRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(StoreAdminRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        if ($validated['password']) $validated['password'] = bcrypt($validated['password']);
        else unset($validated['password']);

        $this->adminService->storeAdmin($user, $validated);

        return redirect()->route('admin.admins.edit', $user->id)->with('success', 'User updated successfully.');
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->back();
    }
}

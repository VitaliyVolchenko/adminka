<?php

namespace App\Services;

use App\Http\DTO\AdminFilter;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AdminService
{
    public function getAdmins(AdminFilter $filter)
    {
        return User::query()
            ->when($filter->name, fn($q) => $q->where('name', 'like', "%{$filter->name}%"))
            ->when($filter->email, fn($q) => $q->where('email', 'like', "%{$filter->email}%"))
            ->when($filter->status != '', fn($q) => $q->where('status', $filter->status))
            ->get();
    }

    /**
     * @param $model
     * @param array $data
     * @return Model
     */
    public function storeAdmin($model, array $data): Model
    {
        $model->fill($data)->save();

        return $model->refresh();
    }
}

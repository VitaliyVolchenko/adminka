@extends('layouts.admin')

@section('content')

    <div class="card-body mt-4">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="d-flex justify-content-start align-content-end mt-17">
                        <a type="button" href="{{ route('admin.admins.create') }}"
                           class="btn btn-primary mr-4">Add New Admin</a>
                    </div>
                </div>
            </div>
            <div class="container mt-4 ps-0 ms-0">
                <form id="ajaxForm" class="row gx-2 align-items-center"
                      action="{{ route('admin.admins.index') }}"
                      method="get">
                    @csrf
                    <!-- Name Field -->
                    <div class=" col-auto
                ">
                        <label for="name" class="visually-hidden">Name</label>
                        <input value="{{ $name ?? '' }}" type="text" class="form-control" id="name" name="name"
                               placeholder="Name">
                    </div>

                    <!-- Email Field -->
                    <div class="col-auto">
                        <label for="email" class="visually-hidden">Email</label>
                        <input value="{{ $email ?? '' }}" type="text" class="form-control" id="email" name="email"
                               placeholder="Email">
                    </div>

                    <!-- Status Field -->
                    <div class="col-auto">
                        <label for="status" class="visually-hidden">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="" {{ $status == null ? 'selected' : '' }}>Status</option>
                            <option value="0" {{ $status == 0 ? 'selected' : '' }}>Inactive</option>
                            <option value="1" {{ $status == 1 ? 'selected' : '' }}>Active</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
            <div class="row mt-2">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                           aria-describedby="example1_info">
                        <thead>
                        <tr>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="email" rowspan="1"
                                colspan="1" aria-sort="ascending"
                                aria-label="Email">Email
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="name" rowspan="1" colspan="1"
                                aria-label="name">Name
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="status" rowspan="1" colspan="1"
                                aria-label="Status">Status
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="actions" rowspan="1" colspan="1"
                                aria-label="Engine version: activate to sort column ascending">Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($admins as $admin)
                            <tr class="even">
                                <td class="dtr-control sorting_1" tabindex="0">{{ $admin->email }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->status ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="pe-2">
                                            <a type="button" href="{{ route('admin.admins.edit', $admin->id) }}"
                                               class="btn btn-success mr-4">Edit</a>
                                        </div>
                                        <form action="{{ route('admin.admins.destroy', $admin->id) }}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <button onclick="return confirm('Are you sure want delete?')" type="submit"
                                                    class="btn btn-danger">Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_after')
    <script>

    </script>
@endsection

@extends('layouts.admin')

@section('js_after')
    <!-- Підключення jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Підключення Laravel File Manager -->
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

    <!-- Ініціалізація File Manager -->
    <script>
        $(document).ready(function () {
            $('#lfm').filemanager('image', {prefix: '/laravel-filemanager'});
        });
    </script>
@endsection

@section('title', 'Edit Admin Page')

@section('content')
    <h3 class="mt-4">Edit Admin Page</h3>

    <div class="container mt-5">

        @if ($errors->any())
            <div class="alert alert-danger w-50">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success w-50">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.admins.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control w-50" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control w-50" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="new-email">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password (leave blank if you don't want to change)</label>
                <div class="input-group w-50">
                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                    <span class="input-group-text toggle-password" id="togglePassword">
                    <i class="bi bi-eye"></i>
                </span>
                </div>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select w-50" id="status" name="status" required>
                    <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>Inactive</option>
                    <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>Active</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="avatar" class="form-label">Avatar</label>
                <div class="input-group w-50">
                    <input id="avatar" class="form-control" type="text" name="avatar" value="{{ old('avatar', $user->avatar ? basename($user->avatar) : '') }}">
                    <button type="button" id="lfm" data-input="avatar" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Select
                    </button>
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                @if($user->avatar)
                    <img src="{{ asset($user->avatar) }}" alt="Avatar" class="img-thumbnail mb-3" style="max-width: 150px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--<script>--}}
{{--    // document.addEventListener('DOMContentLoaded', function () {--}}
{{--    //     // Ініціалізуємо файл-менеджер--}}
{{--    //     $('#lfm').filemanager('image', { prefix: '/laravel-filemanager' });--}}
{{--    //--}}
{{--    //     // Додатково можна налаштувати динамічне оновлення прев'ю--}}
{{--    //     $('#lfm').on('click', function () {--}}
{{--    //         let inputId = $(this).data('input');--}}
{{--    //         let previewId = $(this).data('preview');--}}
{{--    //         let inputElement = document.getElementById(inputId);--}}
{{--    //         let previewElement = document.getElementById(previewId);--}}
{{--    //--}}
{{--    //         if (inputElement && previewElement) {--}}
{{--    //             previewElement.innerHTML = '<img src="' + inputElement.value + '" style="max-height:100px;">';--}}
{{--    //         }--}}
{{--    //     });--}}
{{--    // });--}}
{{--    console.log(typeof $);--}}
{{--    $(document).ready(function () {--}}
{{--        $('#lfm').filemanager('image');--}}
{{--    });--}}
{{--</script>--}}



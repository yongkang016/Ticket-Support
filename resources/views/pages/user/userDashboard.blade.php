<?php

use App\Constants\{WebRouteName, Permission, Role};

$roleOptions = \App\Models\User::roleOptions();


$filterSelectInput = [
    [
        'input_type' => 'input',
        'name' => 'name',
        'id' => 'name',
        'value' => request()->query('name'),
        'clearable' => true,
        'placeholder' => 'Name',
    ],

    [
        'input_type' => 'select',
        'name' => 'role',
        'id' => 'role',
        'options' => $roleOptions,
        'value' => request()->query('role'),
        'clearable' => true,
        'placeholder' => 'Select Role',
        'hideSearch' => 'true',
    ],
]
?>

<x-default-layout>
    @section('title')
        User
    @endsection

    <form action="{{ route(WebRouteName::WEB_ROUTE_USER_INDEX) }}">
        <x-filter-container :selectOptions="$filterSelectInput"
                            redirectUrl="{{ route(WebRouteName::WEB_ROUTE_USER_INDEX) }}">
            @can(Permission::USER_CREATE)
                <div class="w-100 w-sm-auto">
                    <a href="{{ route(WebRouteName::WEB_ROUTE_USER_CREATE)  }}"
                       class="btn btn-primary w-100 w-sm-auto">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Create User
                    </a>
                </div>
            @endcan
        </x-filter-container>
    </form>


    <div class="card mb-6">
        <div class="card-body border-0 pt-6">
            <div class="table-responsive">
                <table class="table table-row-bordered gy-5">
                    <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->name }}</td>
                            <td>
                                @if ($d->role == 1)
                                    Super Admin
                                @elseif ($d->role == 2)
                                    Admin
                                @elseif ($d->role == 3)
                                    Client
                                @elseif ($d->role == 4)
                                    Support Staff
                                @endif
                            </td>
                            <td>{{ $d->created_at}}</td>

                            <td>
                                <div
                                    class="menu menu-column menu-gray-600 menu-active-primary menu-hover-light-primary menu-here-light-primary menu-show-light-primary fw-semibold w-10px"
                                    data-kt-menu="true">
                                    <div class="menu-item" data-kt-menu-trigger="hover"
                                         data-kt-menu-placement="right-start">
                                        <a href="#" class="menu-link">
                                            <i class="bi bi-three-dots"></i>
                                        </a>
                                        <div class="menu-sub menu-hover-bg menu-sub-dropdown w-175px py-2">
                                            @can(Permission::USER_UPDATE)
                                                <div class="menu-item">
                                                    <a href="#" class="menu-link" data-bs-toggle="modal"
                                                       data-bs-target="#editUserModal-{{ $d->id }}">
                                                        <span class="menu-icon">
                                                            <i class="bi bi-pencil-fill fs-3"></i>
                                                        </span>
                                                        <span class="menu-title">Edit</span>
                                                    </a>
                                                </div>
                                            @endcan

                                            @can(Permission::USER_DELETE)
                                                <div class="menu-item">
                                                    <form action="{{ route(WebRouteName::WEB_ROUTE_USER_DELETE) }}"
                                                          method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $d->id }}">
                                                        <button type="submit" class="bg-transparent border-0 menu-link">
                                                            <span class="menu-icon">
                                                                <i class="bi bi-trash-fill fs-3"></i>
                                                            </span>
                                                            <span class="menu-title">Delete</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endcan

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-gray-400 fst-italic fs-4 mt-5 text-center">No User</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @foreach ($data as $index => $d)
        <div class="modal fade" id="editUserModal-{{ $d->id }}" tabindex="-1"
             aria-labelledby="editUserLabel-{{ $d->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route(WebRouteName::WEB_ROUTE_USER_UPDATE) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserLabel-{{ $d->id }}">Edit User
                                ID: {{ $d->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" name="id" value="{{ $d->id }}">

                            <div class="mb-3">
                                <label class="form-check-label w-100" for="kt_modal_update_role_option_0">
                                    <span class="fw-bold text-gray-800">Name</span><br>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="name"
                                        name="name"
                                        value="{{ $d->name }}"
                                    >
                                </label>
                            </div>

                            <div class="mb-3">
                                <label class="form-check-label pb-2" for="kt_modal_update_role_option_0">
                                    <span class="fw-bold text-gray-800">Role Position</span><br>
                                </label>
                                <select name="roleUpdate" class="form-select" data-control="select2"
                                        data-placeholder="Select Level" data-hide-search="true">
                                    <option></option>
                                    <option value="1" {{ $d->role == 1 ? 'selected' : '' }}>Super Admin</option>
                                    <option value="2" {{ $d->role == 2 ? 'selected' : '' }}>Admin</option>
                                    <option value="3" {{ $d->role == 3 ? 'selected' : '' }}>Client</option>
                                    <option value="4" {{ $d->role == 4 ? 'selected' : '' }}>Support Staff</option>
                                </select>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


</x-default-layout>


<script>
    function submitPostForm(actionUrl) {
        const form = document.getElementById('postForm');
        form.action = actionUrl;
        form.submit();
    }
</script>

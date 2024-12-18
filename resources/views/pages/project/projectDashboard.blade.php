<?php

use App\Constants\WebRouteName;
use App\Constants\Permission;

$filterSelectInput = [
    [
        'input_type' => 'input',
        'name' => 'name',
        'id' => 'name',
        'value' => request()->query('name'),
        'clearable' => true,
        'placeholder' => 'Project Name',
    ],

    [
        'input_type' => 'input',
        'name' => 'project_name',
        'id' => 'project_name',
        'value' => request()->query('project_name'),
        'clearable' => true,
        'placeholder' => 'Company Name',
    ],
]


?>

<x-default-layout>

    @section('title')
        Project
    @endsection

    <form action="{{ route(WebRouteName::WEB_ROUTE_PROJECT_INDEX) }}">
        <x-filter-container :selectOptions="$filterSelectInput"
                            redirectUrl="{{ route(WebRouteName::WEB_ROUTE_PROJECT_INDEX) }}">
            @can(Permission::PROJECT_CREATE)
                <div class="w-100 w-sm-auto">
                    <a href="{{ route(WebRouteName::WEB_ROUTE_PROJECT_CREATE)  }}"
                       class="btn btn-primary w-100 w-sm-auto">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Create Project
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
                        <th>Assign To Company</th>
                        <th>Assign To Staff</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->company_relationship->name }}</td>
                            <td>{{ $d->staff_user->name ?? 'N/A' }}</td>
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
                                            @can(Permission::PROJECT_UPDATE)
                                                <div class="menu-item">
                                                    <a href="#" class="menu-link" data-bs-toggle="modal"
                                                       data-bs-target="#editProjectModal-{{ $d->id }}">
                                                        <span class="menu-icon">
                                                            <i class="bi bi-pencil-fill fs-3"></i>
                                                        </span>
                                                        <span class="menu-title">Edit</span>
                                                    </a>
                                                </div>
                                            @endcan

                                            @can(Permission::PROJECT_DELETE)
                                                <div class="menu-item">
                                                    <form action="{{ route(WebRouteName::WEB_ROUTE_PROJECT_DELETE) }}"
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
                            <td colspan="9" class="text-gray-400 fst-italic fs-4 mt-5 text-center">No Project</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{--            <div class="mt-2">--}}
            {{--                @if($data->isNotEmpty())--}}
            {{--                    {{ $data->appends(request()->except(['_token']))->links() }}--}}
            {{--                @endif--}}
            {{--            </div>--}}
        </div>
    </div>

        @foreach ($data as $index => $d)
            <div class="modal fade" id="editProjectModal-{{ $d->id }}" tabindex="-1"
                 aria-labelledby="editUserLabel-{{ $d->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route(WebRouteName::WEB_ROUTE_PROJECT_UPDATE) }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUserLabel-{{ $d->id }}">Edit Company
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
                                        <span class="fw-bold text-gray-800">Company</span>
                                    </label>
                                    <select name="companySelection" class="form-select" data-control="select2"
                                            data-placeholder="Select Level">
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}"
                                                {{ $company->id == $d->company_relationship->id ? 'selected' : '' }}>
                                                {{ $company->name }}
                                            </option>
                                        @endforeach
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

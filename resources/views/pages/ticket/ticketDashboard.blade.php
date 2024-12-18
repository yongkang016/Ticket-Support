<?php

use App\Constants\WebRouteName;
use App\Constants\Permission;
use App\Models\User;

/**
 * @var User $model_User
 */

$status_Options = \App\Models\TicketSupport::statusOptions();
$priority_Options = \App\Models\TicketSupport::priorityOptions();

//dd($errors);

$filterSelectInput = [
    [
        'input_type' => 'input',
        'name' => 'title',
        'id' => 'title',
        'value' => request()->query('title'),
        'clearable' => true,
        'placeholder' => 'Ticket Name',
    ],

    [
        'input_type' => 'input',
        'name' => 'project_name',
        'id' => 'project_name',
        'value' => request()->query('project_name'),
        'clearable' => true,
        'placeholder' => 'Project Name',
    ],

    [
        'input_type' => 'select',
        'name' => 'status',
        'id' => 'status',
        'options' => $status_Options,
        'value' => request()->query('status'),
        'clearable' => true,
        'placeholder' => 'Select Status',
        'hideSearch' => 'true',
    ],


    [
        'input_type' => 'select',
        'name' => 'priority',
        'id' => 'priority',
        'options' => $priority_Options,
        'value' => request()->query('priority'),
        'clearable' => true,
        'placeholder' => 'Select Priority',
        'hideSearch' => 'true',
    ],


]

?>

<x-default-layout>
    @section('title')
        Ticket
    @endsection


    <form action="{{ route(WebRouteName::WEB_ROUTE_TICKET_INDEX) }}">
        <x-filter-container :selectOptions="$filterSelectInput"
                            redirectUrl="{{ route(WebRouteName::WEB_ROUTE_TICKET_INDEX) }}">
            @can(Permission::TICKET_CREATE)
                <div class="w-100 w-sm-auto">
                    <a href="{{ route(WebRouteName::WEB_ROUTE_TICKET_CREATE)  }}"
                       class="btn btn-primary w-100 w-sm-auto">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Submit Ticket
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
                        <th>Ticket Problem</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Project By</th>
                        <th>Submit By</th>
                        <th>Updated At</th>
                        <th>Action</th>


                        {{--                                                @canany([Permission::USER_UPDATE, Permission::USER_DELETE, Permission::USER_RESTORE])--}}
                        {{--                                                    <th>Action</th>--}}
                        {{--                                                @endcanany--}}
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $index => $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->title }}</td>
                            <td>@if($d->status == 1)
                                    Open
                                @elseif($d->status == 2)
                                    In Progress
                                @elseif($d->status == 3)
                                    Resolved
                                @elseif($d->status == 4)
                                    Closed
                                @endif</td>
                            <td>@if($d->priority == 1)
                                    Low
                                @elseif($d->priority == 2)
                                    Medium
                                @elseif($d->priority == 3)
                                    High
                                @elseif($d->priority == 4)
                                    Critical
                                @else
                                    Pending
                                @endif</td>
                            <td>{{ $d->projectName?->name}}</td>
                            <td>{{ $d->createdByUser->name }}</td>
                            <td>{{ $d->updated_at}}</td>


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


                                            @can(Permission::TICKET_ACCEPT_TASK)
                                                <div class="menu-item">
                                                    <a href="#" class="menu-link" data-bs-toggle="modal"
                                                       data-bs-target="#acceptTaskModal-{{ $d->id }}">
                                                        <span class="menu-icon">
                                                            <i class="bi bi-pencil-fill fs-3"></i>
                                                        </span>
                                                        <span class="menu-title">Accept Task</span>
                                                    </a>
                                                </div>
                                            @endcan

                                            @can(Permission::TICKET_UPDATE_TASK)
                                                <div class="menu-item">
                                                    <a href="#" class="menu-link" data-bs-toggle="modal"
                                                       data-bs-target="#editTaskModal-{{ $d->id }}">
                                                        <span class="menu-icon">
                                                            <i class="bi bi-pencil-fill fs-3"></i>
                                                        </span>
                                                        <span class="menu-title">Update Task</span>
                                                    </a>
                                                </div>
                                            @endcan



                                            <div class="menu-item">
                                                <div class="menu-link"
                                                     onclick="fetchMessages('{{ route(WebRouteName::WEB_ROUTE_TICKET_GET_MESSAGE, $d->id) }}',{{ json_encode($d) }})"
                                                     id="kt_drawer_chat_toggle_{{ $d->id }}"
                                                     data-kt-drawer-toggle="#kt_drawer_chat_{{ $d->id }}">
                                                    <span class="menu-icon">
                                                        <i class="bi bi-pencil-fill fs-3"></i>
                                                    </span>
                                                    <span class="menu-title">Support Chat</span>
                                                </div>
                                            </div>
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
            {{--                        <div class="mt-2">--}}
            {{--                            @if($data->isNotEmpty())--}}
            {{--                                {{ $data->appends(request()->except(['_token']))->links() }}--}}
            {{--                            @endif--}}
            {{--                        </div>--}}


        </div>
    </div>

    @foreach ($data as $index => $d)
        <div class="modal fade" id="acceptTaskModal-{{ $d->id }}" tabindex="-1"
             aria-labelledby="acceptTaskLabel-{{ $d->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route(WebRouteName::WEB_ROUTE_TICKET_UPDATE) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="acceptTaskLabel-{{ $d->id }}">Accept Task for Ticket
                                ID: {{ $d->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" name="id" value="{{ $d->id }}">

                            <div class="mb-3">
                                <label class="form-check-label" for="kt_modal_update_role_option_0">
                                    <span class="fw-bold text-gray-800">Ticket Problem</span><br>
                                    <span class="text-gray-600">{{ $d->title }}</span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <label class="form-check-label" for="kt_modal_update_role_option_0">
                                    <span class="fw-bold text-gray-800">Ticket Description</span><br>
                                    <span class="text-gray-600">{{ $d->description }}</span>
                                </label>
                            </div>

                            {{--                            <div class="mb-3">--}}
                            {{--                                <label for="staff-{{ $d->id }}" class="form-label">Select Staff</label>--}}
                            {{--                                <select class="form-select" id="staff-{{ $d->id }}" name="staff_id">--}}
                            {{--                                    @foreach ($users as $userdata)--}}
                            {{--                                        <option value="{{ $userdata->id }}">{{ $userdata->name }}</option>--}}
                            {{--                                    @endforeach--}}
                            {{--                                </select>--}}


                            {{--                            </div>--}}

                            <div class="mb-3">
                                <label class="form-check-label pb-2" for="kt_modal_update_role_option_0">
                                    <span class="fw-bold text-gray-800">Priority Level</span><br>
                                </label>
                                {{--                                <x-select--}}
                                {{--                                    name="staff_id"--}}
                                {{--                                    placeholder="Select Staff"--}}
                                {{--                                    id="staff_id_{{ $index }}"--}}
                                {{--                                    class="form-select form-select-solid"--}}
                                {{--                                    :options="$staff_Options"--}}
                                {{--                                    hideSearch="false"--}}
                                {{--                                />--}}
                                <select name="priority" class="form-select" data-control="select2"
                                        data-placeholder="Select Level" data-hide-search="true">
                                    <option></option>
                                    <option value="1">Low</option>
                                    <option value="2">Medium</option>
                                    <option value="3">High</option>
                                    <option value="4">Critical</option>
                                </select>

                            </div>


                            {{--                            <input type="hidden" name="ticket_id" value="{{ $d->id }}">--}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            {{--                            <a href="{{ route(WebRouteName::WEB_ROUTE_TICKET_INDEX)  }}">--}}
                            {{--                                <button type="submit" class="btn btn-primary">Assign</button>--}}
                            {{--                            </a>--}}
                            <button type="submit" class="btn btn-primary">Assign</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    @foreach ($data as $index => $d)
        <div class="modal fade" id="editTaskModal-{{ $d->id }}" tabindex="-1"
             aria-labelledby="editTaskLabel-{{ $d->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route(WebRouteName::WEB_ROUTE_TICKET_UPDATE_PROGRESS) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTaskLabel-{{ $d->id }}">Edit Task for Ticket
                                ID: {{ $d->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" name="id" value="{{ $d->id }}">

                            <div class="mb-3">
                                <label class="form-check-label" for="kt_modal_update_role_option_0">
                                    <span class="fw-bold text-gray-800">Ticket Problem</span><br>
                                    <span class="text-gray-600">{{ $d->title }}</span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <label class="form-check-label" for="kt_modal_update_role_option_0">
                                    <span class="fw-bold text-gray-800">Ticket Description</span><br>
                                    <span class="text-gray-600">{{ $d->description }}</span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <label class="form-check-label pb-2" for="kt_modal_update_role_option_0">
                                    <span class="fw-bold text-gray-800">Priority Level</span><br>
                                </label>
                                <select name="priority" class="form-select" data-control="select2"
                                        data-placeholder="Select Level" data-hide-search="true">
                                    <option></option>
                                    <option value="1" {{ $d->priority == 1 ? 'selected' : '' }}>Low</option>
                                    <option value="2" {{ $d->priority == 2 ? 'selected' : '' }}>Medium</option>
                                    <option value="3" {{ $d->priority == 3 ? 'selected' : '' }}>High</option>
                                    <option value="4" {{ $d->priority == 4 ? 'selected' : '' }}>Critical</option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label class="form-check-label pb-2" for="kt_modal_update_role_option_0">
                                    <span class="fw-bold text-gray-800">Problem Solved</span><br>
                                </label>
                                <select name="status" class="form-select" data-control="select2"
                                        data-placeholder="Select Level" data-hide-search="true">
                                    <option></option>
                                    <option value="2" {{ $d->status == 2 ? 'selected' : '' }}>In Progress</option>
                                    <option value="3" {{ $d->status == 3 ? 'selected' : '' }}>Resolved</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach



    @foreach ($data as $index => $d)
        <!--begin::Chat drawer-->
        <div id="kt_drawer_chat_{{ $d->id }}" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="chat"
             data-kt-drawer-activate="true" data-kt-drawer-overlay="true"
             data-kt-drawer-width="{default:'300px', 'md': '500px'}" data-kt-drawer-direction="end"
             data-kt-drawer-toggle="#kt_drawer_chat_toggle_{{ $d->id }}"
             data-kt-drawer-close="#kt_drawer_chat_close_{{ $d->id }}">
            <!--begin::Messenger-->
            <div class="card w-100 border-0 rounded-0" id="kt_drawer_chat_messenger">
                <!--begin::Card header-->
                <div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
                    <!--begin::Title-->
                    <div class="card-title">
                        <!--begin::User-->
                        <div class="d-flex justify-content-center flex-column me-3"
                             id="kt_drawer_chat_messenger_header_{{ $d->id }}">
                            <div class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">
                                @if($d->createdByUser->id === auth()->id())
                                    {{$d->staffProject->user_id}}
                                @else
                                    {{$d->createdByUser->name}}
                                @endif
                            </div>

                            <!--begin::Info-->
                            {{--                            <div class="mb-0 lh-1">--}}
                            {{--                                <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>--}}
                            {{--                                <span class="fs-7 fw-semibold text-muted">Active</span>--}}
                            {{--                            </div>--}}
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary"
                             id="kt_drawer_chat_close_{{ $d->id }}">{!! getIcon('cross-square', 'fs-2') !!}</div>
                        <!--end::Close-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body" id="kt_drawer_chat_messenger_body_{{ $d->id }}">
                    {{--  Here will be show the message  --}}
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->
                <div class="card-footer pt-4" id="kt_drawer_chat_messenger_footer">
                    <form action="{{ route(WebRouteName::WEB_ROUTE_TICKET_STORE_MESSAGE) }}" method="POST">
                        @csrf
                        <!--begin::Input-->
                        <input type="hidden" name="ticket_id" value="{{ $d->id }}">

                        <textarea class="form-control form-control-flush mb-3"
                                  rows="1"
                                  data-kt-element="input"
                                  placeholder="Type a message"
                                  id="description"
                                  name="description"></textarea>
                        <!--end::Input-->
                        <!--begin:Toolbar-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Send-->
                            <button class="btn btn-primary" type="submit" data-kt-element="send">Send</button>
                            <!--end::Send-->
                        </div>
                        <!--end::Toolbar-->
                    </form>
                </div>
                <!--end::Card footer-->
            </div>
            <!--end::Messenger-->
        </div>
        <!--end::Chat drawer-->
    @endforeach


</x-default-layout>
<script>
    function fetchMessages(route, ticketData) {
        fetch(route, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ensure CSRF token is included for security
            }
        })
            .then(response => response.json())
            .then(data => {
                const messagesContainer = document.getElementById('kt_drawer_chat_messenger_body_' + ticketData.id);
                messagesContainer.innerHTML = ''; // Clear the current chat messages

                // Loop through the messages and display them
                data.forEach(message => {
                    console.log('Message:', message); // Log the entire message object to the console
                    let messageHtml = '';

                    // Check if the user_id matches the logged-in user id
                    if (message.user_id === {{ auth()->id() }}) {
                        // Outgoing message (sent by logged-in user)
                        messageHtml = `
                    <div class="d-flex justify-content-end mb-10">
                        <div class="d-flex flex-column align-items-end">
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-3">
                                    <span class="text-muted fs-7 mb-1">${formatTime(message.created_at)}</span>
                                    <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>
                                </div>
                                <div class="symbol symbol-35px symbol-circle">
{{--                                    <img src="{{ \Auth::user()->profile_photo_url }}" alt="user"/>--}}
                        </div>
                    </div>
                    <div class="p-5 rounded bg-light-primary text-white fw-semibold mw-lg-400px text-end">
                                ${message.description}
                            </div>
                        </div>
                    </div>`;
                    } else {
                        // Incoming message (sent by another user)
                        messageHtml = `
                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="symbol symbol-35px symbol-circle">
{{--                                    <img src="{{ \Auth::user()->profile_photo_url }}" alt="user"/>--}}
                        </div>
                        <div class="ms-3">
                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">${message.user_name}</a>
                                    <span class="text-muted fs-7 mb-1">${formatTime(message.created_at)}</span>
                                </div>
                            </div>
                            <div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-400px text-start">
                                ${message.description}
                            </div>
                        </div>
                    </div>`;
                    }


                    // Append the message to the chat container
                    messagesContainer.innerHTML += messageHtml;
                });
            })

            .catch(error => console.error('Error fetching messages:', error));
    }

    function formatTime(timestamp) {
        const date = new Date(timestamp);
        const now = new Date();
        const diff = Math.floor((now - date) / 60000); // Time difference in minutes
        if (diff < 1) return 'Just now';
        if (diff === 1) return '1 min ago';
        return `${diff} mins ago`;
    }


    document.addEventListener("DOMContentLoaded", function () {
        var KTDrawer = {
            init: function () {
                [].slice.call(document.querySelectorAll('[data-kt-drawer="true"]')).forEach(function (element) {
                    new KTDrawer(element);
                });
            }
        };
        KTDrawer.init();
    });
</script>



<?php

use App\Constants\WebRouteName;

?>


<x-default-layout>
    <div class="mx-2 my-4">
        <div class="card shadow-sm">
            <div class="card-body p-sm-8 py-6 px-4">

                <form method="{{ $method ?? 'POST' }}" id="create-user-form" action="{{ $action }}">
                    @csrf
                    <div class="px-5 pt-5 pb-3 fs-5 fw-bold text-gray-800">User Information</div>
                    <div class="separator mx-5"></div>


                    <div class="px-5 pt-2 pb-2">
                        <div class="row fs-6 py-2">
                            <div class="col-12 col-sm-3 text-start required">
                                <label class="form-label">Name</label>
                            </div>
                            <div class="col-12 col-sm-8">
                                <x-input type="text"
                                         placeholder="Enter Name"
                                         value=""
                                         class="form-control bg-transparent"
                                         id="name"
                                         name="name"/>
                            </div>
                        </div>

                    </div>

                    <div class="px-5 pt-2 pb-2">
                        <div class="row fs-6 py-2">
                            <div class="col-12 col-sm-3 text-start required">
                                <label class="form-label">Email</label>
                            </div>
                            <div class="col-12 col-sm-8">
                                <x-input type="text"
                                         placeholder="Enter Email"
                                         value="{{ old('email') }}"
                                         class="form-control"
                                         id="email"
                                         name="email"/>
                            </div>
                        </div>
                    </div>

                    <div class="px-5 pt-2 pb-2">
                        <div class="row fs-6 py-2">
                            <div class="col-12 col-sm-3 text-start required">
                                <label class="form-label">Password</label>
                            </div>
                            <div class="col-12 col-sm-8" data-kt-password-meter="true">
                                <x-input
                                    type="password"
                                    value=""
                                    class="form-control bg-transparent"
                                    placeholder="Enter Password"
                                    autocomplete="off"
                                    id="password"
                                    name="password"/>
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                                <div class="text-muted">
                                    Use 8 or more characters with a mix of letters, numbers & symbols.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-5 pt-2 pb-2">
                        <div class="row fs-6 py-2">
                            <div class="col-12 col-sm-3 text-start required">
                                <label class="form-label">Repeat Password</label>
                            </div>
                            <div class="col-12 col-sm-8" data-kt-password-meter="true">
                                <x-input
                                    type="password"
                                    value=""
                                    class="form-control bg-transparent"
                                    placeholder="Repeat Password"
                                    autocomplete="off"
                                    id="repeat_password"
                                    name="repeat_password"/>
                            </div>
                        </div>
                    </div>

                    <div class="px-5 pt-2 pb-2">
                        <div class="row fs-6 py-2">
                            <div class="col-12 col-sm-3 text-start required">
                                <label class="form-label">Roles</label>
                            </div>
                            <div class="col-12 col-sm-8">
                                <select name="role" class="form-select" data-control="select2" data-placeholder="Select an Role">
                                    <option></option>
                                    <option value="2">Admin</option>
                                    <option value="3">Client</option>
                                    <option value="4">Support Staff</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="mt-10">
                        <div class="col-12 text-end ">
                            <a href="{{ route(WebRouteName::WEB_ROUTE_DASHBOARD) }}"
                               class="btn btn-secondary me-2">Back</a>
                            <x-indicator-submit formId="create-user-form"/>
                            {{--                                components --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-default-layout>

<?php

use App\Constants\WebRouteName;
use App\Models\company_industry;


/**
 * @var company_industry $model_company
 */


$company_Options = \App\Models\company_industry::companyOptions(old('company_id', $model_company->id));
$staff_Options = \App\Models\User::staffOptions();
?>

`
<x-default-layout>
    <div class="mx-2 my-4">
        <div class="card shadow-sm">
            <div class="card-body p-sm-8 py-6 px-4">

                <form method="{{ $method ?? 'POST' }}" id="project-form" action="{{ $action }}">
                    @csrf
                    <div class="px-5 pt-5 pb-3 fs-5 fw-bold text-gray-800">Project Information</div>
                    <div class="separator mx-5"></div>
                    <div class="px-5 pt-2 pb-5">
                        <div class="row fs-6 py-2">
                            <div class="col-12 col-sm-3 text-start required">
                                <label class="form-label">Project Name</label>
                            </div>
                            <div class="col-12 col-sm-8">
                                <x-input
                                    class="form-control form-control-solid"
                                    placeholder="Enter Project Name"
                                    name="name"
                                    id="name"
                                    type="text"/>
                            </div>
                        </div>

                    </div>

                    <div class="px-5 pt-2 pb-2">
                        <div class="row fs-6 py-2">
                            <div class="col-12 col-sm-3 text-start required">
                                <label class="form-label">Description</label>
                            </div>
                            <div class="col-12 col-sm-8">

                                <div class="col-12">
                                    <textarea
                                        class="form-control form-control-solid w-100"
                                        placeholder="Enter Project Name"
                                        name="description"
                                        id="description"
                                        rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-5 pt-2 pb-2">
                        <div class="row fs-6 py-2">
                            <div class="col-12 col-sm-3 text-start required">
                                <label class="form-label">Assign To Company</label>
                            </div>

                            <div class="col-12 col-sm-8">
                                <x-select
                                    name="company_id"
                                    placeholder="Select Company"
                                    id="company_id"
                                    class="form-select form-select-solid"
                                    :options="$company_Options"
                                    hideSearch="false"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="px-5 pt-2 pb-2">
                        <div class="row fs-6 py-2">
                            <div class="col-12 col-sm-3 text-start required">
                                <label class="form-label">Assign To Staff</label>
                            </div>
                            <div class="col-12 col-sm-8">
                                <x-select
                                    name="role"
                                    placeholder="Select Staff"
                                    id="role"
                                    class="form-select form-select-solid"
                                    :options="$staff_Options"
                                    hideSearch="false"
                                />


                            </div>
                        </div>
                    </div>


                    <div class="mt-10">
                        <div class="col-12 text-end ">
                            <a href="{{ route(WebRouteName::WEB_ROUTE_DASHBOARD) }}"
                               class="btn btn-secondary me-2">Back</a>
                            <x-indicator-submit formId="project-form"/>
                            {{--                                components --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-default-layout>

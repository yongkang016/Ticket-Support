<?php

use App\Constants\WebRouteName;

/**
 * @var User $model_user
 */

$project_Options = \App\Models\company_project::projectOptions();
?>


<x-default-layout>
    <div class="mx-2 my-4">
        <div class="card shadow-sm">
            <div class="card-body p-sm-8 py-6 px-4">

                <form method="{{ $method ?? 'POST' }}" id="ticket-form" action="{{ $action }}">
                    @csrf
                    <div class="px-5 pt-5 pb-3 fs-5 fw-bold text-gray-800">Ticket Submission</div>
                    <div class="separator mx-5"></div>

                    <div class="px-5 pt-2 pb-2">
                        <div class="row fs-6 py-2">
                            <div class="col-12 col-sm-3 text-start required">
                                <label class="form-label">Under Project</label>
                            </div>
                            <div class="col-12 col-sm-8">
                                <x-select
                                    name="project_id"
                                    placeholder="Select Project"
                                    id="project_id"
                                    class="form-select form-select-solid"
                                    :options="$project_Options"
                                    hideSearch="false"
                                />

                            </div>
                        </div>
                    </div>

                    <div class="px-5 pt-2 pb-2">
                        <div class="row fs-6 py-2">
                            <div class="col-12 col-sm-3 text-start required">
                                <label class="form-label">Ticket Problem</label>
                            </div>
                            <div class="col-12 col-sm-8">
                                <x-input
                                    class="form-control form-control-solid"
                                    placeholder="Enter Ticket Problem"
                                    name="title"
                                    id="title"
                                    type="text"/>
                            </div>
                        </div>

                    </div>

                    <div class="px-5 pt-2 pb-2">
                        <div class="row fs-6 py-2">
                            <div class="col-12 col-sm-3 text-start required">
                                <label class="form-label">Ticket Description</label>
                            </div>
                            <div class="col-12 col-sm-8">

                                <div class="col-12">
                                    <textarea
                                        class="form-control form-control-solid w-100"
                                        placeholder="Enter Ticket Description"
                                        name="description"
                                        id="description"
                                        rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <div class="col-12 text-end ">
                            <a href="{{ route(WebRouteName::WEB_ROUTE_DASHBOARD) }}"
                               class="btn btn-secondary me-2">Back</a>
                            <x-indicator-submit formId="ticket-form"/>
                            {{--                                components --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-default-layout>

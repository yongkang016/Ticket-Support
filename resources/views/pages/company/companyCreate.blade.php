<?php

use App\Constants\WebRouteName;

/** @var string $action */
/** @var string $method */

//dd($action, $method);

?>



<x-default-layout>
    <div class="mx-2 my-4">
        <div class="card shadow-sm">
            <div class="card-body p-sm-8 py-6 px-4">

                <form method="{{ $method ?? 'POST' }}" id="user-form" action="{{ $action }}">
                    @csrf
                    <div class="px-5 pt-5 pb-3 fs-5 fw-bold text-gray-800">Company Information</div>
                    <div class="separator mx-5"></div>
                    <div class="px-5 pt-8 pb-5">
                        <div class="row fs-6 py-2">
                            <div class="col-12 col-sm-3 text-start required">
                                <label class="form-label">Company Name</label>
                            </div>
                            <div class="col-12 col-sm-8">
                                <x-input
                                    class="form-control form-control-solid"
                                    placeholder="Enter Company Name"
                                    name="name"
                                    id="name"
{{--                                    value="{{ old('username', $model->username) }}"--}}
                                    type="text"/>
                            </div>
                        </div>

                    </div>


                    <div class="mt-10">
                        <div class="col-12 text-end ">
                            <a href="{{ route(WebRouteName::WEB_ROUTE_DASHBOARD) }}" class="btn btn-secondary me-2">Back</a>
                                <x-indicator-submit formId="user-form"/>
{{--                                components --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-default-layout>



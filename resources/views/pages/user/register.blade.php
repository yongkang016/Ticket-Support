<?php

use App\Constants\WebRouteName;

?>

<x-auth-layout>
    <!--begin::Form-->
    <form id="register-form" class="form w-100" method="post" action="{{ route(WebRouteName::WEB_ROUTE_REGISTER)  }}">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">
                Sign Up
            </h1>
            <!--end::Title-->

            <!--begin::Subtitle-->
            {{--            <div class="text-gray-500 fw-semibold fs-6">--}}
            {{--                Your Social Campaigns--}}
            {{--            </div>--}}
            <!--end::Subtitle--->
        </div>
        <!--begin::Heading-->


        <!--begin::Input group--->
        <div class="fv-row mb-8">
            <!--begin::Name-->
            <x-input type="text"
                     label="Name"
                     placeholder="Enter Name"
                     value=""
                     class="form-control bg-transparent"
                     id="name"
                     name="name"/>
            <!--end::Name-->
        </div>

        <!--begin::Input group--->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <x-input type="text"
                     label="Email"
                     placeholder="Enter Email"
                     value="{{ old('email') }}"
                     class="form-control"
                     id="email"
                     name="email"/>
            <!--end::Email-->
        </div>

        <!--begin::Input group-->
        <div class="fv-row mb-8" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">

                    <x-input
                        type="password"
                        label="Password"
                        value=""
                        class="form-control bg-transparent"
                        placeholder="Enter Password"
                        autocomplete="off"
                        id="password"
                        name="password"/>

{{--                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"--}}
{{--                          data-kt-password-meter-control="visibility">--}}
{{--                        <i class="bi bi-eye-slash fs-2"></i>--}}
{{--                        <i class="bi bi-eye fs-2 d-none"></i>--}}
{{--                    </span>--}}
                </div>
                <!--end::Input wrapper-->

                <!--begin::Meter-->
                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                </div>
                <!--end::Meter-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Hint-->
            <div class="text-muted">
                Use 8 or more characters with a mix of letters, numbers & symbols.
            </div>
            <!--end::Hint-->
        </div>
        <!--end::Input group--->

{{--        <div class="fv-row mb-8">--}}
{{--            <x-input--}}
{{--                type="password"--}}
{{--                label="Repeat Password"--}}
{{--                value=""--}}
{{--                class="form-control bg-transparent"--}}
{{--                placeholder="Enter Password"--}}
{{--                autocomplete="off"--}}
{{--                id="repeat_password"--}}
{{--                name="repeat_password"/>--}}
{{--        </div>--}}


        <div class="fv-row mb-8" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">

                    <x-input
                        type="password"
                        label="Repeat Password"
                        value=""
                        class="form-control bg-transparent"
                        placeholder="Enter Repeat Password"
                        autocomplete="off"
                        id="repeat_password"
                        name="repeat_password"/>

                    {{--                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"--}}
                    {{--                          data-kt-password-meter-control="visibility">--}}
                    {{--                        <i class="bi bi-eye-slash fs-2"></i>--}}
                    {{--                        <i class="bi bi-eye fs-2 d-none"></i>--}}
                    {{--                    </span>--}}
                </div>
                <!--end::Input wrapper-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Input group--->

        {{--        <!--begin::Input group--->--}}
        {{--        <div class="fv-row mb-10">--}}
        {{--            <div class="form-check form-check-custom form-check-solid form-check-inline">--}}
        {{--                <input class="form-check-input" type="checkbox" name="toc" value="1"/>--}}

        {{--                <label class="form-check-label fw-semibold text-gray-700 fs-6">--}}
        {{--                    I Agree &--}}

        {{--                    <a href="#" class="ms-1 link-primary">Terms and conditions</a>.--}}
        {{--                </label>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <!--end::Input group--->--}}

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            {{--            <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">--}}
            {{--                @include('partials/general/_button-indicator', ['label' => 'Sign Up'])--}}
            {{--            </button>--}}

            <x-indicator-submit formId="register-form" class="w-100"/>

        </div>
        <!--end::Submit button-->

        <!--begin::Sign up-->
        <div class="text-gray-500 text-center fw-semibold fs-6">
            Already have an Account?

            <a href="/login" class="link-primary fw-semibold">
                Sign in
            </a>
        </div>
        <!--end::Sign up-->
    </form>
    <!--end::Form-->
</x-auth-layout>


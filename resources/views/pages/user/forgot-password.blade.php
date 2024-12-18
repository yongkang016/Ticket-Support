<?php

use App\Constants\WebRouteName;

$isProduction = Illuminate\Support\Facades\App::isProduction();

?>

<x-auth-layout>
    <form class="form w-100 pt-3 pt-md-10" novalidate="novalidate" id="kt_password_reset_form"
          data-kt-redirect-url="{{ route(WebRouteName::WEB_ROUTE_HOME) }}"
          action="{{ route(WebRouteName::WEB_ROUTE_FORGET_PASSWORD) }}" method="post">
        @csrf
        @method('POST')
        <div class="text-center mb-10">
            <h1 class="text-gray-900 fw-bolder mb-3">Forgot Password ?</h1>
            <div class="text-gray-500 fw-semibold fs-6">
                Enter your email to reset your password.
            </div>
        </div>

        <div class="fv-row mb-8">
            <x-input
                name="email"
                id="email"
                placeholder="Enter Your Email Here"
                class="form-control bg-transparent"
                type="email"
            />
        </div>

{{--        @if($isProduction)--}}
{{--            <div class="fv-row mb-8">--}}
{{--                <x-recaptcha/>--}}
{{--            </div>--}}
{{--        @endif--}}

        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <a href="{{ route(WebRouteName::WEB_ROUTE_HOME) }}" class="btn btn-light me-4">Cancel</a>
            <x-indicator-submit class="recaptcha-submit-btn" formId="kt_password_reset_form" disabled="{{ $isProduction }}"/>
        </div>
    </form>
</x-auth-layout>

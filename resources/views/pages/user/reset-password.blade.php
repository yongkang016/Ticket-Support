<?php

use App\Constants\WebRouteName;

?>
<x-auth-layout>
    <form class="form w-100" novalidate="novalidate" id="kt_new_password_form"
          data-kt-redirect-url="{{ route(WebRouteName::WEB_ROUTE_LOGIN_INDEX) }}" action="{{ route(WebRouteName::WEB_ROUTE_RESET_PASSWORD) }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ old('token', $token) }}">
        <input type="hidden" name="email" value="{{ old('email', $email) }}">

        <div class="text-center mb-10">
            <h1 class="text-gray-900 fw-bolder mb-3">New Password</h1>
            <div class="text-gray-500 fw-semibold fs-6">Enter your new password.</div>
        </div>
        <div class="fv-row mb-8" data-kt-password-meter="true">
            <x-input
                type="password"
                name="password"
                id="password"
                placeholder="New Password"
            />
        </div>
        <div class="fv-row mb-8" data-kt-password-meter="true">
            <x-input
                type="password"
                name="confirm_password"
                id="confirm_password"
                placeholder="Confirm New Password"
            />
        </div>
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <a href="{{ route(WebRouteName::WEB_ROUTE_LOGIN_INDEX) }}" class="btn btn-light me-4">Cancel</a>
            <x-indicator-submit formId="kt_new_password_form"/>
        </div>
    </form>
</x-auth-layout>

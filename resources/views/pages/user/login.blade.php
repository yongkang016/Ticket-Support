<?php

use App\Constants\WebRouteName;

?>

<x-auth-layout>
    <div class="text-center mb-11">
        <h1 class="text-gray-900 fw-bolder mb-3 pt-3 pt-md-10">Sign In</h1>
    </div>
    <form id="login-form" class="form w-100" method="post" action="{{ route(WebRouteName::WEB_ROUTE_LOGIN) }}">
        @csrf
        <div class="mb-3">
            <x-input type="text"
                     label="Email"
                     placeholder="Enter Email"
                     value="{{ old('email') }}"
                     class="form-control"
                     id="email"
                     name="email"/>
        </div>
        <div class="mb-6" data-kt-password-meter="true">
            <x-input
                type="password"
                label="Password"
                value=""
                class="form-control"
                placeholder="Enter Password"
                id="password"
                name="password"/>
        </div>
{{--        <div class="row">--}}
{{--            <div class="col-12 col-sm-6 text-center text-sm-start">--}}
{{--                <a href="{{ route(WebRouteName::WEB_ROUTE_REGISTER_INDEX) }}"--}}
{{--                   class="text-muted text-hover-primary">Don't have an account?</a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="mt-5">
            <x-indicator-submit formId="login-form" class="w-100"/>
        </div>
    </form>
</x-auth-layout>

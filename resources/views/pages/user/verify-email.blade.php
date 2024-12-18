<?php
use App\Constants\WebRouteName;

?>

<x-auth-layout>
    <div class="w-100">
        <div class="text-center mb-11">
            <h1 class="text-gray-900 fw-bolder my-6 pt-5">Verify Email</h1>
            <div class="text-gray-500 fw-semibold fs-6">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-center pb-lg-0 w-100">
            <form method="POST" class="w-100 w-sm-auto" action="{{ route(WebRouteName::WEB_ROUTE_LOGOUT) }}">
                @csrf
                <button type="submit" class="btn btn-lg btn-secondary fw-bolder me-0 me-sm-4 w-100 w-sm-auto">Cancel</button>
            </form>
            <form method="POST" id="resend-email-verification-form" class="w-100 w-sm-auto" action="{{ route(WebRouteName::WEB_ROUTE_REQUEST_VERIFY_EMAIL) }}">
                @csrf
                <x-indicator-submit formId="resend-email-verification-form" submitText="Resend Email Verification"/>
            </form>
        </div>
    </div>
</x-auth-layout>

<?php

use App\Constants\{Permission, WebRouteName};
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/** @var User $user */
$user = Auth::user();

?>

<div
    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
    data-kt-menu="true">
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            <div class="symbol symbol-50px me-5">
                @if(Auth::user()->profile_photo_url)
                    <img alt="Logo" src="{{ Auth::user()->profile_photo_url }}"/>
                @else
                    <div
                        class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', Auth::user()->name) }}">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                @endif
            </div>
            <div class="d-flex flex-column custom-text-overflow-ellipsis">
                <div class="fw-bold align-items-center fs-5 custom-text-overflow-ellipsis">
                    {{ Auth::user()->name}}
                </div>
                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
            </div>
        </div>
    </div>
    <div class="separator my-2"></div>
{{--    <div class="menu-item px-5 {{ request()->routeIs(WebRouteName::WEB_ROUTE_USER_PROFILE) ? 'show here' : '' }}">--}}
{{--        <a href="{{ route(WebRouteName::WEB_ROUTE_USER_PROFILE_INDEX) }}" class="menu-link px-5">My Profile</a>--}}
{{--    </div>--}}
{{--    <div class="separator my-2"></div>--}}
{{--    <div class="menu-item px-5">--}}
{{--        <form action="{{ route(WebRouteName::WEB_ROUTE_LOGOUT) }}" method="post">--}}
{{--            @csrf--}}
{{--            <button class="menu-link px-5 btn w-100" type="submit">--}}
{{--                Sign Out--}}
{{--            </button>--}}
{{--        </form>--}}
{{--    </div>--}}
</div>

<?php

use App\Constants\{Permission, WebRouteName};
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/** @var User $user */
$user = Auth::user();

?>

<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true"
         data-kt-scroll-activate="true" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
         data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu"
             data-kt-menu="true" data-kt-menu-expand="false">
            {{--            <div--}}
            {{--                class="menu-item {{ request()->routeIs(WebRouteName::WEB_ROUTE_DASHBOARD) ? 'here show' : '' }}">--}}
            {{--                <span class="menu-link">--}}
            {{--					<span class="menu-icon">--}}
            {{--                        {!! getIcon('element-11', 'fs-2') !!}--}}
            {{--                    </span>--}}
            {{--                    <a class="menu-title" href="{{ route(WebRouteName::WEB_ROUTE_DASHBOARD) }}">--}}
            {{--                        <span class="menu-title">Dashboard</span>--}}
            {{--                    </a>--}}
            {{--				</span>--}}
            {{--            </div>--}}

            @can(Permission::TICKET_LIST)
                <div class="menu-item">
                <span class="menu-link {{ request()->routeIs(WebRouteName::WEB_ROUTE_TICKET) ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-bandage fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <a class="menu-title" href="{{ route(WebRouteName::WEB_ROUTE_TICKET_INDEX) }}">
                        <span class="menu-title">Ticket</span>
                    </a>
                </span>
                </div>
            @endcan

            @can(Permission::USER_LIST)
                <div class="menu-item">
                <span class="menu-link {{ request()->routeIs(WebRouteName::WEB_ROUTE_USER) ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-user fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <a class="menu-title" href="{{ route(WebRouteName::WEB_ROUTE_USER_INDEX) }}">
                        <span class="menu-title">User</span>
                    </a>
                </span>
                </div>
            @endcan


            @can(Permission::USER_LIST)
                <div class="menu-item">
                <span class="menu-link {{ request()->routeIs(WebRouteName::WEB_ROUTE_COMPANY) ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-briefcase fs-2">
                             <span class="path1"></span>
                             <span class="path2"></span>
                        </i>
                    </span>
                    <a class="menu-title" href="{{ route(WebRouteName::WEB_ROUTE_COMPANY_INDEX) }}">
                        <span class="menu-title">Company</span>
                    </a>
                </span>
                </div>
            @endcan


            @can(Permission::USER_LIST)
                <div class="menu-item">
                <span class="menu-link {{ request()->routeIs(WebRouteName::WEB_ROUTE_PROJECT) ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-tablet-book fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <a class="menu-title" href="{{ route(WebRouteName::WEB_ROUTE_PROJECT_INDEX) }}">
                        <span class="menu-title">Project</span>
                    </a>
                </span>
                </div>
            @endcan


        </div>
    </div>
</div>

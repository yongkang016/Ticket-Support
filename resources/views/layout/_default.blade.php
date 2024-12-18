@extends('layout.master')
@section('content')
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            @include(config('theme-settings.KT_THEME_LAYOUT_DIR').'/partials/sidebar-layout/_header')
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                @include(config('theme-settings.KT_THEME_LAYOUT_DIR').'/partials/sidebar-layout/_sidebar')
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">
                        @include(config('theme-settings.KT_THEME_LAYOUT_DIR').'/partials/sidebar-layout/_toolbar')
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                <x-success-messages/>
                                <x-error-messages/>
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials/_scrolltop')
@endsection

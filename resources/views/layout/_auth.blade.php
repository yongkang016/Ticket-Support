<?php

use App\Constants\WebRouteName;
use App\Helpers\CouncilHelper;

?>

@extends('layout.master')
@section('content')
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-lg-500px w-sm-500px w-100 py-3 py-md-10">
                        <x-success-messages/>
                        <x-error-messages/>
                        {{ $slot }}
                    </div>
                </div>
                <div class="d-flex flex-center flex-wrap pt-15 pt-md-5">
{{--                    <div class="d-flex fw-semibold text-primary fs-base">--}}
{{--                        <a href="#" class="px-5" target="_blank">Terms & Conditions</a>--}}
{{--                        <a href="#" class="px-5" target="_blank">Privacy Policy</a>--}}
{{--                    </div>--}}
                </div>
            </div>
{{--            <div--}}
{{--                class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2 bg-primary">--}}
{{--                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">--}}
{{--                    <img alt="Logo" src="{{ CouncilHelper::getLogo() }}" class="h-60px h-lg-175px"/>--}}
{{--                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mt-7 mb-7">--}}
{{--                        {{ CouncilHelper::getName() }}--}}
{{--                    </h1>--}}
{{--                    <h2 class="text-white text-center">--}}
{{--                        ASET LESEN--}}
{{--                    </h2>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection

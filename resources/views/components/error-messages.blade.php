<div class="error-message-container">
    @error('custom_errors')
    <!--begin::Alert-->
    <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-6">
        <!--begin::Wrapper-->
        <div class="text-danger">
            <!--begin::Title-->
            @foreach($errors->get('custom_errors') as $error)
                {{ $error }}<br/>
            @endforeach
            <!--end::Title-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Close-->
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto h-auto" data-bs-dismiss="alert">
            <i class="ki-duotone ki-cross fs-1 text-danger">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </button>
        <!--end::Close-->
    </div>
    <!--end::Alert-->
    @enderror

    <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-3 error-msg" style="display: none !important;">
        <div class="text-danger error-msg-txt"></div>
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto h-auto" data-bs-dismiss="alert">
            <i class="ki-duotone ki-cross fs-1 text-danger">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </button>
    </div>
</div>

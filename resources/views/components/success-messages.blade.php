<div class="success-message-container">
    @if(session('success'))
        <!--begin::Alert-->
        <div
            class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row p-5 mb-6">
            <!--begin::Wrapper-->
            <div class="text-success">
                <!--begin::Title-->
                {{ session('success') }}
                <!--end::Title-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Close-->
            <button type="button"
                    class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto h-auto"
                    data-bs-dismiss="alert">
                <i class="ki-duotone ki-cross fs-1 text-success"><span class="path1"></span><span
                        class="path2"></span></i>
            </button>
            <!--end::Close-->
        </div>
        <!--end::Alert-->
    @endif

    <div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row p-5 mb-3 success-msg" style="display: none !important;">
        <div class="text-success success-msg-txt"></div>
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto h-auto"
                data-bs-dismiss="alert">
            <i class="ki-duotone ki-cross fs-1 text-success">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </button>
    </div>
</div>

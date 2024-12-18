<div class="modal fade" tabindex="-1" id="{{ $id }}">
    <div class="modal-dialog {{ $modalClass ?? null }}">
        <div class="modal-content">
            <form action="{{ $action ?? null }}" id="modal-form-{{ $id }}" method="POST">
                @method($method ?? 'POST')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 modal-close-btn" data-bs-dismiss="modal"
                         aria-label="Close">
                        {!! getIcon('cross', 'fs-2', '', 'i') !!}
                    </div>
                </div>
                <div class="modal-body">
                    <div class="mb-10">
                        {{ $slot }}
                        <input type="hidden" name="modal_form_id" value="{{ $id }}">
                    </div>
                </div>
                @can($permission)
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light modal-close-btn" data-bs-dismiss="modal">Close</button>
                        <x-indicator-submit id="{{ $id }}-submit-btn" formId="modal-form-{{ $id }}"/>
                    </div>
                @endcan
            </form>
        </div>
    </div>
</div>

@pushonce('scripts')
    <script>
        let modalErrorMsg = @json($errors->toArray() ?? []);

        function handleModalRoute(route, modalId) {
            // set local storage to store the route
            localStorage.setItem(`${modalId}-route`, route);
            $(`#${modalId}`).find('form').attr('action', route);
        }

        $(document).ready(function () {
            if (!_.isEmpty(modalErrorMsg)) {
                let modalId = _.get(modalErrorMsg, 'modal_form_id')[0];

                $(`#${modalId}`).modal('show');
                let route = localStorage.getItem(`${modalId}-route`);
                if (!_.isEmpty(route)) {
                    handleModalRoute(route, modalId);
                }

                $('.modal-close-btn').one('click', function () {
                    Object.keys(modalErrorMsg).map((key) => {
                        $(`[data-field="${key}"]`).html(null);
                    });
                });
            }
        });
    </script>
@endpushonce

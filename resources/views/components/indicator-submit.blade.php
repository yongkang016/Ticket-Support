<button type="button"
        @disabled($disabled ?? false)
        class="btn {{ (isset($isBtnLink) && filter_var($isBtnLink, FILTER_VALIDATE_BOOLEAN)) ? 'btn-link btn-text-primary bg-transparent' : 'btn-primary' }} me-2 document-submit-btn submit-btn {{ $class ?? null }}"
        id="{{ $id ?? 'kt_button_1'}}"
        data-form-id="{{ $formId }}"
        onclick="handleIndicatorSubmit(this)"
>
    <span class="indicator-label">
        {{ $submitText ?? 'Submit' }}
    </span>
    <span class="indicator-progress">
        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
    </span>
</button>

@pushonce('scripts')
    <script>
        function handleIndicatorSubmit(self) {
            $(self).attr('data-kt-indicator', 'on');
            $(self).attr('disabled', true);

            document.querySelectorAll('.submit-btn').forEach((item) => {
                $(item).attr('disabled', true);
            });

            let form = $(`#${$(self).attr('data-form-id')}`);
            form.submit();
        }
    </script>
@endpushonce

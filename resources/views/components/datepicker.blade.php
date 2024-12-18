@php
    $isTimePicker = isset($isTimePicker) ? filter_var($isTimePicker, FILTER_VALIDATE_BOOLEAN) : false;
@endphp

@if (isset($isLabelFloating) && filter_var($isLabelFloating, FILTER_VALIDATE_BOOLEAN))
    <div class="form-floating">
        @endif
        <input class="form-control form-control-solid {{ $class ?? null }}"
               name="{{ $name }}"
               id="{{ $id }}"
               value="{{ $value ?? null }}"
               onkeydown="return false"
            @disabled($disabled ?? false)
        />
        @if (isset($isLabelFloating) && filter_var($isLabelFloating, FILTER_VALIDATE_BOOLEAN))
            <label>{{ $label }}</label>
    </div>
@endif

@error($name)
<div class="fv-plugins-message-container">
    <div data-field="{{ $name }}" data-validator="notEmpty" class="fv-help-block">{{ $message }}</div>
</div>
@enderror

@push('scripts')
    <script>
        $(document).ready(function () {
            var disabledDays = @json($disabledDays ?? []);
            var minDate = '{{ $minDate ?? null }}';
            var maxDate = '{{ $maxDate ?? null }}';

            var config = {
                singleDatePicker: true,
                autoUpdateInput: false,
                showDropdowns: true,
                timePicker: @json($isTimePicker),
                isInvalidDate: function (arg) {
                    var thisMonth = arg._d.getMonth() + 1;
                    if (thisMonth < 10) {
                        thisMonth = "0" + thisMonth;
                    }

                    var thisDate = arg._d.getDate();
                    if (thisDate < 10) {
                        thisDate = "0" + thisDate;
                    }

                    var thisYear = arg._d.getYear() + 1900;

                    var thisCompare = thisMonth + "/" + thisDate + "/" + thisYear;

                    if (disabledDays.includes(thisCompare)) {
                        return true;
                    }
                },
                locale: {
                    cancelLabel: 'Clear'
                }
            };

            if (!_.isEmpty(minDate)) {
                config.minDate = minDate;
            }

            if (!_.isEmpty(maxDate)) {
                config.maxDate = maxDate;
            }

            $("#{{ $id }}").daterangepicker(config);

            $("#{{ $id }}").on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format(@json($isTimePicker ? 'MM/DD/YYYY HH:mm' : 'MM/DD/YYYY')));
            });

            $("#{{ $id }}").on('cancel.daterangepicker', function () {
                $(this).val(null);
            });
        });
    </script>
@endpush

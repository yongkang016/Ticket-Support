<div class="w-100 position-relative">
    @if($type == 'password')
        @if(isset($label))
            <label for="{{ $id }}" class="form-label position-relative">{{ $label }}</label>
        @endif
        <div class="position-relative mb-3">
            <input type="{{ $type }}" id="{{ $id ?? null }}" name="{{ $name }}" class="form-control {{ $class ?? '' }}"
                   placeholder="{{ $placeholder ?? null }}" value="{{ $value ?? null }}"
                   maxlength="{{ $maxlength ?? '' }}"/>
            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                  data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
            </span>
        </div>
    @elseif (isset($isFloat) && filter_var($isFloat, FILTER_VALIDATE_BOOLEAN))
        <div class="form-floating">
            <input type="{{ $type }}"
                   class="form-control form-control-solid {{ $class ?? '' }}"
                   id="{{ $id ?? null }}"
                   name="{{ $name }}"
                   placeholder="{{ $placeholder ?? null }}"
                   value="{{ $value ?? null }}"
                   min="{{ $min ?? null }}"
                   max="{{ $max ?? null }}"
            />
            <label class="{{ $labelClass ?? '' }}" for="{{ $name }}">{{ $label }}</label>
        </div>
    @else
        @if(isset($label))
            <label for="{{ $id }}" class="form-label position-relative">{{ $label }}</label>
        @endif
        <input type="{{ $type }}" id="{{ $id ?? null }}" name="{{ $name }}" class="form-control {{ $class ?? '' }}"
               @disabled($disabled ?? false) placeholder="{{ $placeholder ?? null }}"
               value="{{ $value ?? null }}" maxlength="{{ $maxlength ?? '' }}" @readonly(isset($readOnly)) />
    @endif

    @error($name)
    <div class="fv-plugins-message-container">
        <div data-field="{{ $name }}" data-validator="notEmpty" class="fv-help-block">{{ $message }}</div>
    </div>
    @enderror
</div>

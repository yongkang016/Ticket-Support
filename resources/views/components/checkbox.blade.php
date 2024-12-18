<div
    class="form-check form-check-sm form-check-solid position-relative mb-sm-3 mb-5 d-flex justify-content-start align-items-center {{ $wrapperClass ?? null }}">
    @if(isset($label))
        <input type="checkbox" class="form-check-input {{ $class ?? null }}" id="checkbox-{{ $id ?? null }}"
               name="{{ $name }}" value="{{ $value ?? true }}"
            {{ $checked ?? false ? 'checked' : '' }}
            @disabled($disabled ?? false)
        />

        <label for="checkbox-{{ $id }}" class="form-check ps-4">
            <span>{{ $label }}</span>
        </label>
    @else
        <input type="checkbox" class="form-check-input {{ $class ?? null }}" id="checkbox-{{ $id ?? null }}"
               name="{{ $name }}" value="{{ $value ?? true }}"
            {{ $checked ?? false ? 'checked' : '' }}
            @disabled($disabled ?? false)
        />
    @endif

    @error($name)
    <div class="fv-plugins-message-container">
        <div data-field="{{ $name }}" data-validator="notEmpty" class="fv-help-block">{{ $message }}</div>
    </div>
    @enderror
</div>

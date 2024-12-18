<div class="form-floating">
    <input type="{{ $type }}" class="form-control form-control-solid {{ $class }}" id="{{ $name }}" placeholder="{{ $expValue ?? null }}" value="{{ $value ?? null }}" name="{{ $name }}"
    min="{{ $min ?? null }}" max="{{ $max ?? null }}"
    />
    <label class="{{ $class }}" for="{{ $name }}">{{ $label }}</label>

    @error($name)
    <div class="fv-plugins-message-container">
        <div data-field="{{ $name }}" data-validator="notEmpty" class="fv-help-block">{{ $message }}</div>
    </div>
    @enderror
</div>

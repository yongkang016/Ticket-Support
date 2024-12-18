<div class="row fs-6 py-2">
    @if(isset($label))
        <div class="col-12 col-sm-3 text-start text-gray-700 {{ $class ?? null }}">{{ $label }}</div>
    @endif
    <div class="col-12 col-sm-8 {{ $class ?? null }}">
        <textarea name="{{ $name }}" id="{{ $name }}"
                  class="form-control form-control-solid {{ $textareaClass ?? null }}"
                  rows="{{ $rows ?? 3 }}"
                  placeholder="{{ $placeholder ?? null }}"
                  data-kt-autosize="true"
                  @disabled($disabled ?? false)
        >{{ old($name, $value) }}</textarea>
    </div>
    @error($name)
    <div class="fv-plugins-message-container">
        <div data-field="{{ $name }}" data-validator="notEmpty" class="fv-help-block">{{ $message }}</div>
    </div>
    @enderror
</div>

<?php

use \Illuminate\Support\Arr;
use App\Constants\{WebRouteName};

?>

@aware(['unitOptions', 'roomOptions'])

@if (isset($isLabelFloating) && filter_var($isLabelFloating, FILTER_VALIDATE_BOOLEAN))
    <div class="form-floating">
        <select class="form-select {{ $class ?? '' }}"
                id="{{ $id ?? null }}"
                name="{{ $name }}"
                {{ isset($repeater) ? 'data-kt-repeater=select2' : 'data-control=select2'}}
                {{ $repeater ?? 'data-kt-select2=true'}}
                data-hide-search="{{ $hideSearch ?? 'false' }}"
                data-allow-clear="{{ $clearable ?? 'false' }}"
                data-placeholder="{{ $placeholder ?? 'Select an option' }}"
            {{ $multiple ?? null }}
            {{ $closeOnSelect ?? null }}
            @disabled($disabled ?? false)
        >
            @foreach($options as $option)
                @if(isset($value))
                    <option value="{{ $option['value'] }}"
                            @selected($option['value'] == $value) data-kt-select2-image="{{ $option['image_url'] ?? null }}">
                        {{ $option['name'] }}
                    </option>
                @else
                    <option value="{{ $option['value'] }}"
                            @selected($option['selected']) data-kt-select2-image="{{ $option['image_url'] ?? null }}">
                        {{ $option['name'] }}
                    </option>
                @endif
            @endforeach
        </select>
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    </div>
@else
    <div class="w-100 w-sm-auto">
        @if(!empty($label))
            <label for="{{ $id }}" class="form-label">{{ $label }}</label>
        @endif
        <select class="form-select {{ $class ?? '' }}"
                id="{{ $id ?? null }}"
                name="{{ $name }}"
                {{ isset($repeater) ? 'data-kt-repeater=select2' : 'data-control=select2'}}
                {{ $repeater ?? 'data-kt-select2=true'}}
                data-hide-search="{{ $hideSearch ?? 'false' }}"
                data-allow-clear="{{ $clearable ?? 'false' }}"
                data-placeholder="{{ $placeholder ?? 'Select an option' }}"
            {{ $multiple ?? null }}
            {{ $closeOnSelect ?? null }}
            @disabled($disabled ?? false)
        >
            @foreach($options as $option)
                @if(isset($value))
                    <option value="{{ $option['value'] }}"
                            @selected($option['value'] == $value) data-kt-select2-image="{{ $option['image_url'] ?? null }}">
                        {{ $option['name'] }}
                    </option>
                @elseif(isset($multiple))
                    <option value="{{ $option['value'] }}" @selected(in_array($option['value'] , $multiSelectValues ?? []))>
                        {{ $option['name'] }}
                    </option>
                @else
                    <option value="{{ $option['value'] }}"
                            @selected($option['selected']) data-kt-select2-image="{{ $option['image_url'] ?? null }}">
                        {{ $option['name'] }}
                    </option>
                @endif
            @endforeach
        </select>
    </div>
@endif
@error($name)
<div class="fv-plugins-message-container">
    <div data-field="{{ $name }}" data-validator="notEmpty" class="fv-help-block">{{ $message }}</div>
</div>
@enderror

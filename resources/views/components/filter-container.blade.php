<div class="row mt-3 justify-content-between">
    <div class="col-12 col-sm-6">
        {{ $slot ?? null }}
    </div>
    <div class="col-12 col-sm-5 col-lg-4 col-xxl-2 d-flex flex-end mt-3 mt-sm-0">
        <div class="w-100 w-sm-auto">
            {{--            <x-select class="form-select form-select-solid bg-white shadow-sm" id="type"--}}
            {{--                      name="type" :options="$propertyTypeOptions" clearable />--}}
        </div>
        <div class="ms-3 filter-button cursor-pointer d-flex justify-content-end">
            <div
                class="w-40px h-40px w-lg-45px h-lg-45px border-1 pt-3 pb-4 px-4 p-lg-4 rounded-2 bg-white shadow-sm">
                <img class="w-100" src="{{ asset('storage/icons8-filter-48.png') }}" alt="filter">
            </div>
        </div>
    </div>
</div>
<div class="row mb-6">
    <div class="col-12 filter-container overflow-hidden">
        <div class="row rounded-3 shadow-sm mt-5 bg-white p-8 m-0">
            @foreach($selectOptions as $select)
                @php
                    $options = $select['options'] ?? [];
                @endphp

                <div class="col-12 col-sm-4 col-lg-3 mb-7">
                    @if($select['input_type'] == 'select')
                        <x-select
                            name="{{ $select['name'] ?? '' }}"
                            id="{{ $select['id'] ?? '' }}"
                            :options="$options"
                            class="form-select form-select-solid h-100 {{ $select['class'] ?? '' }}"
                            value="{{ $select['value'] ?? '' }}"
                            clearable="{{ $select['clearable'] ?? false }}"
                            placeholder="{{ $select['placeholder'] ?? null }}"
                            isLabelFloating="{{ $select['is_label_floating'] ?? false }}"
                            label="{{ $select['label'] ?? null }}"
                            hideSearch="{{ $select['hideSearch'] ?? false }}"
                        />
                    @elseif($select['input_type'] == 'input')
                        <x-search-input type="text" label="{{ $select['placeholder'] ?? null }}"
                                        name="{{ $select['name'] ?? '' }}" class="text-gray-600"
                                        id="{{ $select['id'] ?? '' }}" value="{{ $select['value'] ?? '' }}"/>
                    @elseif($select['input_type'] == 'number')
                        <x-search-input type="number" label="{{ $select['placeholder'] ?? null }}"
                                        min="{{ $select['min'] ?? null }}"
                                        max="{{ $select['max'] ?? null }}"
                                        name="{{ $select['name'] ?? '' }}" class="text-gray-600"
                                        id="{{ $select['id'] ?? '' }}" value="{{ $select['value'] ?? '' }}"/>

                    @elseif($select['input_type'] == 'date')
                        <x-datepicker
                            id="{{ $select['id'] ?? '' }}"
                            name="{{ $select['name'] ?? '' }}"
                            value="{{ $select['value'] ?? '' }}"
                            label="{{ $select['placeholder'] ?? null }}"
                            class="text-gray-600"
                            isLabelFloating="true"
                        />
                    @elseif($select['input_type'] == 'multi-select')
                        <x-select
                            name="{{ $select['name'] ?? '' }}"
                            id="{{ $select['id'] ?? '' }}"
                            :options="$options"
                            class="form-select form-select-solid h-100 {{ $select['class'] ?? '' }}"
                            :multiSelectValues="$select['value'] ?? []"
                            clearable="{{ $select['clearable'] ?? false }}"
                            placeholder="{{ $select['placeholder'] ?? null }}"
                            multiple="multiple"
                        />
                    @endif
                </div>
            @endforeach
            <div
                class="col-12 d-flex justify-content-end justify-content-sm-end mt-3">
                <div class="me-2">
                    <a href="{{ $redirectUrl ?? '#' }}"
                       class="btn btn-light ms-0 ms-lg-3 w-100">Clear</a>
                </div>
                <div class="d-flex justify-content-end col-5 col-sm-auto">
                    <button type="submit" class="btn btn-primary ms-0 ms-lg-3 w-100" id="search-btn">
                        <span class="indicator-label">Search</span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
                @if($isExportable ?? false)
                    <div class="d-flex justify-content-end col-5 col-sm-auto">
                        <a href="{{ $exportUrl ?? '#' }}"
                           class="btn btn-light-primary ms-0 ms-sm-1 ms-lg-3 w-100">Export</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<?php

use App\Constants\ApiRouteName;

/**
 * @var int|null $maxFiles
 * @var string|null $id
 * @var string|null $inputName
 * @var string|null $inputId
 * @var string|null $disk
 * @var string $type
 * @var string|null $value
 * @var bool $disabled
 *
 */

$maxFiles = $maxFiles ?? 5;
$isDisabled = isset($disabled) && filter_var($disabled, FILTER_VALIDATE_BOOLEAN) ? 'true' : 'false';

// $disk only has 's3', 'local' or 'public' options
$disk = $disk ?? config('filesystems.default');
$isLocalStorage = isset($disk) && $disk !== 's3' && ($disk === 'local' || $disk === 'public');
?>

<div class="dropzone" id="{{ $id ?? 'kt_dropzonejs' }}">
    <div class="dz-message needsclick">
        <i class="ki-duotone ki-file-up fs-3x text-primary">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>

        <div class="ms-4">
            <h3 class="fs-6 fw-bold text-gray-900">Drop files here or click to upload.
                Maximum {{ $maxFiles }} {{ $maxFiles > 1 ? 'files' : 'file' }} is
                allowed.</h3>
        </div>

        <input type="hidden" name="{{ $inputName ?? 'files' }}" id="{{ $inputId ?? 'files' }}">
    </div>
</div>
<div class="fv-plugins-message-container d-none {{ $id ?? null }}-file-error-container">
    <div data-validator="notEmpty" class="fv-help-block {{ $id ?? null }}-file-error-message">
        files error
    </div>
</div>
@error($inputName ?? 'files')
<div class="fv-plugins-message-container">
    <div data-field="{{ $inputName ?? 'files' }}" data-validator="notEmpty" class="fv-help-block">{{ $message }}</div>
</div>
@enderror
{{--@if (!empty($inputName))--}}
{{--    @error($inputName)--}}
{{--    <div class="fv-plugins-message-container">--}}
{{--        <div data-field="{{ $inputName }}" data-validator="notEmpty" class="fv-help-block">{{ $message }}</div>--}}
{{--    </div>--}}
{{--    @enderror--}}
{{--@else--}}
{{--    @if ($errors->any())--}}
{{--        @if (collect($errors->all())->contains(function ($value, $key) {--}}
{{--                return str_contains($value,  $inputName ?? 'files');--}}
{{--        }))--}}
{{--            <div class="fv-plugins-message-container">--}}
{{--                <div data-field="{{ $inputName ?? 'files' }}" data-validator="notEmpty" class="fv-help-block">--}}
{{--                    @if (empty(old($inputName ?? 'files')))--}}
{{--                        File is required.--}}
{{--                    @else--}}
{{--                        File upload failed. Please try again.--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    @endif--}}
{{--@endif--}}
@push('scripts')
    <script>
        var myDropzone = new Dropzone("#{{ $id ?? 'kt_dropzonejs' }}", {
            init: function () {
                var dropzone = this;

                this.on("removedfile", function (file) {
                    dropzone.enable();

                    if (this.files.length >= 1) {
                        $('#{{ $id ?? 'kt_dropzonejs' }}').css('border', '1px dashed var(--bs-success)');
                    } else {
                        $('#{{ $id ?? 'kt_dropzonejs' }}').css('border', '1px dashed #0d6efd');
                    }
                    $('.{{ $id ?? null }}-file-error-container').addClass('d-none');

                    const files = document.getElementById('{{ $inputId ?? 'files' }}');
                    if (files.value) {
                        let fileParams = JSON.parse(files.value);
                        fileParams = fileParams.filter(function (f) {
                            return f.name !== file.name;
                        });

                        if (fileParams.length !== 0) {
                            files.value = JSON.stringify(fileParams);
                        } else {
                            files.value = null;
                        }
                    }

                    if (_.has(file, 'id')) {
                        var fileId = file.id;
                        if (!_.isEmpty(fileId.toString())) {
                            axios.delete(`${window.location.origin}/api/document/${fileId}/delete`);
                        }
                    }
                });

                this.on('maxfilesexceeded', function (file) {
                    this.removeFile(file);
                    $('#{{ $id ?? 'kt_dropzonejs' }}').css('border', '1px dashed var(--bs-primary)');
                    $('.{{ $id ?? null }}-file-error-container').removeClass('d-none');
                    $('.{{ $id ?? null }}-file-error-message').css('color', 'var(--bs-primary)');
                    $('.{{ $id ?? null }}-file-error-message').html('Maximum {{ $maxFiles }} {{ $maxFiles > 1 ? 'files' : 'file' }} is allowed.');
                });

                var existFile = @json($value ?? null);
                const files = document.getElementById('{{ $inputId ?? 'files' }}');

                if (!_.isEmpty(existFile)) {
                    if (!_.isArray(existFile)) {
                        existFile = [existFile];
                    }

                    existFile.map(function (file) {
                        var currentFile = {name: file.name, id: file.id}
                        dropzone.emit('addedfile', currentFile);
                        dropzone.emit('thumbnail', currentFile, file.image_url);
                        dropzone.emit('complete', currentFile);
                        dropzone.files.push(currentFile);

                        let fileParams = [
                            {
                                type: file.type,
                                name: file.name,
                                mime_type: file.mime_type,
                                extension: file.extension,
                                path: file.path,
                            },
                        ];
                        if (files.value) {
                            let uploadedFile = JSON.parse(files.value);
                            fileParams = [
                                ...fileParams,
                                ...uploadedFile
                            ];
                        }
                        files.value = JSON.stringify(fileParams);
                    })
                }

                if (_.isEqual(dropzone.files.length, dropzone.options.maxFiles)) {
                    dropzone.disable();
                }

                if ('{{ isset($disabled) && filter_var($disabled, FILTER_VALIDATE_BOOLEAN) ? 'true' :'false' }}' === 'true') {
                    dropzone.disable();
                }
            },
            url: '{{ $isLocalStorage ? route(ApiRouteName::API_ROUTE_DOCUMENT_GET_LOCAL_UPLOAD_LINK) : route(ApiRouteName::API_ROUTE_DOCUMENT_GET_UPLOAD_LINK) }}',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'GET',
            acceptedFiles: '{{ $acceptedFiles ?? null }}',
            previewTemplate: `\
    <div class="dz-preview dz-file-preview">
        <div class="dz-image"><img data-dz-thumbnail /></div>

        <div class="dz-details">
            <div class="dz-filename"><span data-dz-name></span></div>
        </div>

        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>

        <div class="dz-error-message"><span data-dz-errormessage></span></div>

        <div class="dz-success-mark">
            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>Check</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF"></path>
                </g>
            </svg>
        </div>

        <div class="dz-error-mark">
            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>Error</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                    <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"></path>
                    </g>
                </g>
            </svg>
        </div>
    </div>
`,
            maxFiles: {{ $maxFiles }},
            maxFilesize: 3,
            addRemoveLinks: !@json(filter_var($isDisabled, FILTER_VALIDATE_BOOLEAN)),
            accept: function (file, done) {
                done();
            },
            processing: function () {
                $('.document-submit-btn').attr('disabled', true);
            },
            success: function (file, response) {
                var dropzone = this;

                const uploadUrl = response.url;
                const path = response.path;
                const method = response.method;

                if (method === 'POST') {
                    let fileData = new FormData()
                    fileData.append('upload', file, file.name)
                    fileData.append('path', path)
                    fileData.append('disk', @json($disk))

                    axios.post(uploadUrl, fileData, {headers: {'content-type': 'multipart/form-data'}})
                        .then(function (response) {
                            if (response.status === 200) {
                                const files = document.getElementById('{{ $inputId ?? 'files' }}');
                                let fileParams = [
                                    {
                                        type: '{{ $type }}',
                                        name: file.name,
                                        mime_type: file.type,
                                        extension: file.name.split('.').pop(),
                                        path: response.data.url,
                                    },
                                ];
                                if (files.value) {
                                    let uploadedFile = JSON.parse(files.value);
                                    fileParams = [
                                        ...fileParams,
                                        ...uploadedFile
                                    ];
                                }
                                files.value = JSON.stringify(fileParams);

                                if (_.isEqual(fileParams.length, dropzone.files.length)) {
                                    $('.document-submit-btn').removeAttr('disabled');
                                }

                                $('#{{ $id ?? 'kt_dropzonejs' }}').css('border', '1px dashed var(--bs-success)');
                            }
                        })
                        .catch(function (e) {
                            $('#{{ $id ?? 'kt_dropzonejs' }}').css('border', '1px dashed var(--bs-danger)');
                            $('.{{ $id ?? null }}-file-error-container').removeClass('d-none');
                            $('.{{ $id ?? null }}-file-error-message').html('File upload failed. Please try again.');
                        })
                    return;
                }

                axios.put(uploadUrl, file, {
                    headers: {
                        'Content-Type': file.type,
                    }
                })
                    .then(function (response) {
                        if (response.status === 200) {
                            const files = document.getElementById('{{ $inputId ?? 'files' }}');
                            let fileParams = [
                                {
                                    type: '{{ $type }}',
                                    name: file.name,
                                    mime_type: file.type,
                                    extension: file.name.split('.').pop(),
                                    path: path,
                                },
                            ];
                            if (files.value) {
                                let uploadedFile = JSON.parse(files.value);
                                fileParams = [
                                    ...fileParams,
                                    ...uploadedFile
                                ];
                            }
                            files.value = JSON.stringify(fileParams);

                            if (_.isEqual(fileParams.length, dropzone.files.length)) {
                                $('.document-submit-btn').removeAttr('disabled');
                            }

                            $('#{{ $id ?? 'kt_dropzonejs' }}').css('border', '1px dashed var(--bs-success)');
                        }
                    })
                    .catch(function () {
                        $('#{{ $id ?? 'kt_dropzonejs' }}').css('border', '1px dashed var(--bs-danger)');
                        $('.{{ $id ?? null }}-file-error-container').removeClass('d-none');
                        $('.{{ $id ?? null }}-file-error-message').html('File upload failed. Please try again.');
                    })

            },
            error: function (file, response) {
                $('#{{ $id ?? 'kt_dropzonejs' }}').css('border', '1px dashed var(--bs-danger)');
                $('.{{ $id ?? null }}-file-error-container').removeClass('d-none');
                $('.{{ $id ?? null }}-file-error-message').html(response.message || response);
            }
        });
    </script>
@endpush


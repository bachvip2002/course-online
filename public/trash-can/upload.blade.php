@extends('manager.layout.app')

@section('kt_app_toolbar')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('manager.dashboard.index') }}" class="text-muted text-hover-primary">Bảng điều
                            kiển</a>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('manager.resource-management.list-page') }}"
                            class="text-muted text-hover-primary">Quản
                            lý tài
                            nguyên</a>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">
                        <a class="text-dark">Tạo tài nguyên</a>
                    </li>

                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
@endsection

@section('kt_app_content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card card-custom gutter-b example example-compact card-validate-form card-sticky">
            <div class="card-header">
                <h3 class="card-title">
                    Tạo tài nguyên
                </h3>
                <div class="card-toolbar">
                </div>
            </div>
            <!--begin::Form-->
            <form class="validate-form" id="validate-form"
                data-kt-redirect-url="{{ route('manager.resource-management.list-page') }}" method="POST"
                action="{{ route('manager.resource-management.store') }}">
                @csrf
                @method('POST')

                <div class="card-body">
                    <div class="mb-15">
                        <div class="form-group form-ajax-validate row mb-3">
                            <div class="col-lg-12">
                                <button type="button" class="add-file-container btn btn-primary">thêm vùng chọn
                                    tệp</button>
                                <button type="button" class="btn btn-danger cancel-upload">Hủy tải tất cả</button>

                                <div class="progress mt-5">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100">0%</div>
                                </div>
                            </div>

                            <span class="col-lg-12 ajax-msg-display-path form-text text-danger">
                            </span>
                        </div>

                        <div class="mt-5 row container-file-display">
                        </div>
                    </div>


                    <div class="d-flex justify-content-center mb-5">
                        <button type="submit" form="validate-form" data-kt-indicator="off"
                            class="btn btn-success mr-2 hover-elevate-up mx-2">
                            <span class="indicator-label">Gửi</span>
                            <span class="indicator-progress">
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        <a href="{{ route('manager.resource-management.list-page') }}"
                            class="back-url btn btn-secondary hover-elevate-up">
                            Quay lại
                        </a>
                    </div>
                </div>

            </form>
            <!--end::Form-->
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/form-data-ajax.js') }}"></script>
    <script>
        $(document).ready(() => {
            var ajaxCall;
            var indexFile = 0;
            $('.progress').hide();

            $('.add-file-container').on('click', () => {
                indexFile++;
                $('.container-file-display')
                    .append(
                        `<div style="height:300px" class="file-container border border-1 form-ajax-validate col-lg-5 mt-5 mx-3 position-relative p-0">` +
                        `<div class="btn-group">` +
                        `<input type="file" name="path[${indexFile}]" id="path-${indexFile}" hidden class="choose-file form-control ajax-input-css-display">` +
                        `<label for="path-${indexFile}" type="button" class="btn btn-sm btn-primary">` +
                        `Chọn tệp` +
                        `</label>` +
                        `<button type="button" class="cancel-file btn btn-sm btn-danger">` +
                        `Hủy` +
                        `</button>` +
                        `</div>` +
                        `<div class="file-display"></div>` +
                        `<span class="ajax-msg-display-path-${indexFile} form-text text-danger"></span>` +
                        `</div>`
                    );
            });

            $('.container-file-display').on('change', '.choose-file', (event) => {
                var tmppath = URL.createObjectURL(event.target.files[0]);
                var fileDisplayElement = $(event.target)
                    .closest('.file-container')
                    .find(`.file-display`)

                let isPng = event.target.files[0].type === 'image/png';
                let isJpeg = event.target.files[0].type === 'image/jpeg';
                let isVideo = event.target.files[0].type === 'video/mp4';
                let isPdf = event.target.files[0].type === 'application/pdf';

                if (isVideo) {
                    fileDisplayElement.html(`<video class="w-100 h-100" src="${tmppath}" controls><video>`);
                } else if (isPdf) {
                    fileDisplayElement.html(`<iframe  class="w-100 h-100" src="${tmppath}"></iframe>`);
                } else if (isPng || isJpeg) {
                    fileDisplayElement.html(`<img class="w-100 h-100" src="${tmppath}">`);
                }

            });

            $('.container-file-display').on('click', '.cancel-file', function(event) {
                $(event.target).closest('.file-container').remove();
            });

            $('.cancel-upload').click(() => {
                ajaxCall.abort();
            })

            $('.validate-form').submit((event) => {
                event.preventDefault();

                $('button[form="validate-form"]')
                    .attr('data-kt-indicator', 'on')
                    .attr('disabled', 'disabled');

                let formData = new FormData(event.target)

                ajaxCall = $.ajax({
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();

                        xhr.upload.addEventListener("progress", function(event) {
                            if (event.lengthComputable) {
                                var percentComplete = event.loaded / event.total;
                                percentComplete = parseInt(percentComplete * 100);

                                $('.progress').show()

                                $('.progress')
                                    .find('.progress-bar')
                                    .css({
                                        'width': percentComplete + '%',
                                    }).text(percentComplete + '%')
                                    .attr('aria-valuenow', percentComplete + '%')

                            }
                        }, false);

                        return xhr;
                    },
                    type: "POST",
                    url: $(event.target).attr('action'),
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    processData: false,
                    contentType: false,
                }).done((res) => {

                    Swal.fire({
                        text: "Bạn đã thêm thành công",
                        icon: "success",
                        buttonsStyling: false,
                        showCancelButton: true,
                        confirmButtonText: "Về trang danh sách",
                        cancelButtonText: 'Đóng',
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: 'btn btn-secondary'
                        }
                    }).then((result) => {

                        if (result.isConfirmed) {
                            window.location.href = $(event.target).data(
                                'kt-redirect-url');
                        } else {
                            $('button[form="validate-form"]')
                                .attr('data-kt-indicator', 'off')
                                .attr('disabled', false);
                            deleteMessage(event.target);
                        }
                    });

                }).fail((res) => {

                    $('button[form="validate-form"]')
                        .attr('data-kt-indicator', 'off')
                        .attr('disabled', false);

                    if (res.status == 0) {
                        Swal.fire({
                            title: res.statusText,
                            text: 'Đã hủy',
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: 'Đóng',
                            customClass: {
                                confirmButton: 'btn btn-secondary'
                            }
                        });

                        return false;
                    }

                    if (res.status == 422) {
                        Swal.fire({
                            title: 'Nhập sai',
                            text: res.responseJSON.message,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: 'Đóng',
                            customClass: {
                                confirmButton: 'btn btn-secondary'
                            }
                        });

                        failForm(res, event.target);
                        return false;
                    }

                    Swal.fire({
                        title: res.statusText,
                        text: res.responseJSON.message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: 'Đóng',
                        customClass: {
                            confirmButton: 'btn btn-secondary'
                        }
                    });

                    return false;

                }).always(function() {
                    $('.progress').hide();

                    $('.progress')
                        .find('.progress-bar')
                        .css({
                            'width': '0%',
                        })
                        .text('0%')
                        .attr('aria-valuenow', '0%');
                });
            })

        })
    </script>
@endpush

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
                        <a href="{{ route('manager.course.list-page') }}" class="text-muted text-hover-primary">Danh sách
                            khóa học</a>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('manager.course.learning-roadmap.index-page', ['course_id' => $course->id]) }}"
                            class="text-muted">Lộ trình khóa
                            học</a>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">
                        <a class="text-dark">Chỉnh sửa chương học</a>
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
                    Chỉnh sửa chương học
                </h3>
                <div class="card-toolbar">
                </div>
            </div>
            <!--begin::Form-->
            <form class="validate-form" id="validate-form"
                data-kt-redirect-url="{{ route('manager.course.learning-roadmap.index-page', ['course_id' => $course->id]) }}"
                method="POST" action="{{ route('manager.course.learning-roadmap.chapter.update') }}">
                @csrf
                @method('PUT')

                <input type="text" name="course_id" value="{{ $course->id }}" hidden>
                <input type="text" name="chapter_id" value="{{ $chapter->id }}" hidden>

                <div class="card-body">
                    <div class="mb-15">
                        <div class="form-group form-ajax-validate row mb-3">
                            <label class="col-lg-3 col-form-label required" for="name">Tên:</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" id="name"
                                    class="form-control ajax-input-css-display" value="{{ $chapter->name }}"
                                    placeholder="Nhập tên">
                                <span class="ajax-msg-display-name form-text text-danger">
                                </span>
                            </div>
                        </div>

                        <div class="form-group form-ajax-validate row mb-3">
                            <label class="col-lg-3 col-form-label" for="description">Mô tả:</label>
                            <div class="col-lg-6">
                                <textarea name="description" id="description" class="form-control ajax-input-css-display">{!! $chapter->description !!}</textarea>
                                <span class="ajax-msg-display-description form-text text-danger"></span>
                            </div>
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
                        <a href="{{ route('manager.course.learning-roadmap.index-page', ['course_id' => $course->id]) }}"
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
    <script src="{{ asset('assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/form-data-ajax.js') }}"></script>
    <script>
        $(document).ready(() => {

            tinymce.init({
                selector: 'textarea',
                statusbar: false,
            })

            $('.validate-form').submit((event) => {
                event.preventDefault()

                $('button[form="validate-form"]')
                    .attr('data-kt-indicator', 'on')
                    .attr('disabled', 'disabled')

                let formData = new FormData(event.target)

                $.ajax({
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
                        text: "Bạn đã sửa thành công",
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
                            window.location.href = $(event.target).data('kt-redirect-url')
                        } else {
                            $('button[form="validate-form"]')
                                .attr('data-kt-indicator', 'off')
                                .attr('disabled', false)
                            deleteMessage(event.target)
                        }
                    });

                }).fail((res) => {

                    $('button[form="validate-form"]')
                        .attr('data-kt-indicator', 'off')
                        .attr('disabled', false)

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
                        })

                        failForm(res, event.target)
                        return false
                    }

                    Swal.fire({
                        title: 'Lỗi',
                        text: res.responseJSON.message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: 'Đóng',
                        customClass: {
                            confirmButton: 'btn btn-secondary'
                        }
                    })
                })
            })

        })
    </script>
@endpush

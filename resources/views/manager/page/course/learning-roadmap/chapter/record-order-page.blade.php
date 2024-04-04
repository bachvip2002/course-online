@extends('manager.layout.app')

@section('kt_app_toolbar')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex  flex-wrap flex-stack">
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
                    <li class="breadcrumb-item text-dark">
                        <a href="{{ route('manager.course.list-page') }}" class="text-muted text-hover-primary">
                            Danh sách khóa học
                        </a>
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
                    <li class="breadcrumb-item text-dark">Sắp xếp chương học</li>
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
    <!--begin::Products-->
    <div class="card card-flush">

        <!--begin::Card header-->
        <div class="card-header align-items-center justify-content-start gap-md-5">
            <h1 class="fw-bold text-gray-900">Sắp xếp chương học</h1>
        </div>

        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0 p-10 p-lg-15 draggable-zone">
            <form class="validate-form" id="validate-form"
                data-kt-redirect-url="{{ route('manager.course.learning-roadmap.index-page', ['course_id' => $course->id]) }}"
                method="POST" action="{{ route('manager.course.learning-roadmap.chapter.sort-record') }}">
                @csrf
                @method('PUT')
                @php
                    $orderChapter = 1;
                @endphp

                <input type="text" name="course_id" hidden value="{{ $course->id }}">

                <div class="mb-15">
                    @foreach ($chapters as $chapter)
                        <div class="border bg-secondary p-5 mb-5 rounded draggable">
                            <input type="text" name="chapter_id[]" hidden value="{{ $chapter->id }}">

                            <!--begin::Section-->
                            <div class="m-0  draggable-handle">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center py-3  mb-0"
                                    data-bs-target="#kt_support_{{ $chapter->id }}">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center flex-wrap">
                                        <!--begin::Title-->
                                        <h3 class="text-gray-800 fw-semibold cursor-pointer me-3 mb-0">
                                            Chương {{ $orderChapter }}:
                                            {{ $chapter->name }}
                                        </h3>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Heading-->
                            </div>
                            <!--end::Body-->
                            @php
                                $orderChapter++;
                            @endphp
                        </div>
                    @endforeach
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

            </form>

        </div>
        <!--end::Card body-->
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/plugins/custom/draggable/draggable.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/form-data-ajax.js') }}"></script>

    <script>
        $(document).ready(() => {
            var containers = document.querySelectorAll(".draggable-zone");

            if (containers.length === 0) {
                return false;
            }

            var swappable = new Sortable.default(containers, {
                draggable: ".draggable",
                handle: ".draggable .draggable-handle",
                mirror: {
                    appendTo: "body",
                    constrainDimensions: true
                }
            });

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
    </script>
@endpush

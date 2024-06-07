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
                <li class="breadcrumb-item text-dark">Lộ trình khoá học</li>
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
    <form class="" action="{{ route('manager.course.learning-roadmap.index-page') }}">
        @method('GET')
        <!--begin::Card header-->
        <div class="card-header align-items-center justify-content-start gap-md-5">

            <input type="text" name="course_id" hidden value="{{ $course->id }}">

            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                <input type="text" value="{{ request()->query('name') }}" name="name" data-kt-ecommerce-product-filter="search" class="form-control w-250px ps-12" placeholder="Tên chương học" />
            </div>

            <div class="d-flex align-items-center position-relative my-1">
                <select class="form-select w-200px" name="status" data-control="select2" data-hide-search="true" data-placeholder="Sắp xếp chương học" data-kt-ecommerce-product-filter="status">
                    <option value="3" {{ request()->query('status') == 3 ? 'selected' : '' }}>Sắp xếp chương học
                    </option>
                    <option value="1" {{ request()->query('status') == 1 ? 'selected' : '' }}>Tăng dần</option>
                    <option value="2" {{ request()->query('status') == 2 ? 'selected' : '' }}>giảm dần</option>
                </select>
            </div>

            <div class="d-flex align-items-center position-relative my-1">
                <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
            </div>

        </div>
    </form>

    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0 p-10 p-lg-15">
        <!--begin::Header-->
        <div class="d-flex flex-stack mb-7">
            <!--begin::Title-->
            <h1 class="fw-bold text-gray-900">Lộ trình khoá học</h1>
            <!--end::Title-->
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('manager.course.learning-roadmap.chapter.create-page', ['course_id' => $course->id]) }}" class="btn btn-sm btn-success">
                    <i class="ki-outline ki-plus fs-2"></i>
                    Thêm chương học
                </a>
                <a href="{{ route('manager.course.learning-roadmap.chapter.record-order-page', ['course_id' => $course->id]) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-sort-down-alt fs2"></i>
                    Sắp xếp chương học
                </a>
            </div>
        </div>

        @php
        $orderChapter = 1;
        @endphp

        @foreach ($chapters as $chapter)
        <div class="border bg-secondary p-5 mb-5 rounded">
            <div class="btn-group mx-10" role="group" aria-label="Basic example">
                <a class="btn btn-sm btn-warning" href="{{ route('manager.course.learning-roadmap.chapter.edit-page', ['course_id' => $course->id, 'chapter_id' => $chapter->id]) }}">
                    Sửa chương học
                </a>

                <button class="btn btn-sm btn-danger">
                    Xóa chương học
                </button>

                <a href="{{ route('manager.course.learning-roadmap.lesson.create-page', ['course_id' => $course->id, 'chapter_id' => $chapter->id]) }}" class="btn btn-sm btn-success">
                    <i class="ki-outline ki-plus fs-2"></i>
                    Thêm bài học
                </a>

                <a href="{{ route('manager.course.learning-roadmap.lesson.record-order-page', ['course_id' => $course->id, 'chapter_id' => $chapter->id]) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-sort-down-alt fs2"></i>
                    Sắp xếp bài học
                </a>
            </div>

            <!--begin::Section-->
            <div class="m-0">
                <!--begin::Heading-->
                <div class="d-flex align-items-center collapsible py-3 toggle  mb-0" data-bs-toggle="collapse" data-bs-target="#kt_support_{{ $chapter->id }}">
                    <!--begin::Icon-->
                    <div class="ms-n1 me-5">
                        <i class="ki-duotone ki-down toggle-on text-primary fs-2"></i>
                        <i class="ki-duotone ki-right toggle-off fs-2"></i>
                    </div>
                    <!--end::Icon-->

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

                <!--begin::Body-->
                <div id="kt_support_{{ $chapter->id }}" class=" collapse show fs-6 ms-10" style="">
                    <!--begin::Block-->
                    <div class="mb-4">
                        @php
                        $orderLesson = 1;
                        @endphp
                        @forelse ($chapter->lessons as $lesson)
                        <div class="border bg-white p-5 mb-5 rounded">
                            <div class="btn-group mb-5" role="group" aria-label="Basic example">
                                <a class="btn btn-sm btn-warning" href="{{ route('manager.course.learning-roadmap.lesson.edit-page', ['course_id' => $course->id, 'chapter_id' => $chapter->id, 'lesson_id' => $lesson->id]) }}">
                                    Sửa bài học
                                </a>

                                <a class="btn btn-sm btn-primary" href="{{ route('manager.course.learning-roadmap.lesson.video-create-page', ['course_id' => $course->id, 'chapter_id' => $chapter->id, 'lesson_id' => $lesson->id]) }}">
                                    Tải video lên
                                </a>

                                <button class="btn btn-sm btn-danger">
                                    Xóa bài học
                                </button>

                                <a class="btn btn-sm btn-info" href="{{ route('manager.course.learning-roadmap.lesson.detail-page', ['course_id' => $course->id]) }}">
                                    Chi tiết
                                </a>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-play-circle fs-3 text-primary me-2"></i>
                                <span class="text-gray-500 fw-semibold fs-3">Bài {{ $orderLesson }}:
                                    {{ $lesson->name }}</span>
                                @php
                                $orderLesson++;
                                @endphp
                            </div>
                        </div>
                        @empty
                        <svg xmlns="http://www.w3.org/2000/svg" class="fs-3 text-danger me-2" width="16" height="16" fill="currentColor" class="bi bi-ban" viewBox="0 0 16 16">
                            <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />
                        </svg>
                        <span class="text-gray-500 fw-semibold fs-3">Không có bài học</span>
                        @endforelse
                    </div>
                    <!--end::Block-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Body-->
            @php
            $orderChapter++;
            @endphp
        </div>
        @endforeach

    </div>
    <!--end::Card body-->
</div>
@endsection

@push('script')
<script>
    $(document).ready(
        () => {
            $('.ajax-btn-delete').click(
                (event) => {
                    Swal.fire({
                        text: "Bạn muốn xóa bản ghi này",
                        icon: "info",
                        buttonsStyling: false,
                        showCancelButton: true,
                        confirmButtonText: "Xóa",
                        cancelButtonText: 'Đóng',
                        customClass: {
                            confirmButton: "btn btn-danger",
                            cancelButton: 'btn btn-secondary'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            ajaxDelete(event)
                        }
                    });

                }
            )

            function ajaxDelete(event) {
                $.ajax({
                    url: $(event.target).data('url_delete_record'),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    processData: false,
                    contentType: false,
                }).done((res) => {
                    $('.is-record-' + res.user.id).remove()
                    Swal.fire({
                        text: 'Xóa thành công',
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: 'Đóng',
                        customClass: {
                            confirmButton: 'btn btn-secondary'
                        }
                    })
                }).fail((res) => {

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
            }
        }
    )
</script>
@endpush
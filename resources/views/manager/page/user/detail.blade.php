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
                        <a href="{{ route('manager.user.list-page') }}" class="text-muted text-hover-primary">Danh sách
                            người
                            dùng</a>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">
                        <a class="text-dark">Sửa người dùng</a>
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
        <div class="card card-custom gutter-b example example-compact card-user-create-form card-sticky">
            <div class="card-header">
                <h3 class="card-title">
                    Tạo người dùng
                </h3>
                <div class="card-toolbar">
                </div>
            </div>
            <!--begin::Form-->
            <div class="card-body">
                <video controls class="w-100">
                    {{-- <source src="{{ asset('「Nightcore」→  做自己的光  - (Switching Vocals ) - (Lyrics).mp4') }}"> --}}
                    <source
                        src="{{ route('lesson-video', ['path' => 'lesson_video/「Nightcore」→  做自己的光  - (Switching Vocals ) - (Lyrics).mp4']) }}">
                </video>
            </div>
        </div>
    </div>
@endsection

@section('outer_app')
    <div class="form-footer-fixed">
        <div class="body">
            <button type="submit" form="user-create-form" data-kt-indicator="off"
                class="btn btn-success mr-2 hover-elevate-up mx-2">
                <span class="indicator-label">Gửi</span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
            <a href="{{ route('manager.user.list-page') }}" class="back-url btn btn-secondary hover-elevate-up">
                Quay lại
            </a>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/form-data-ajax.js') }}"></script>
@endpush

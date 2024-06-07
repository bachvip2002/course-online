@extends('manager.layout.app')

@section('kt_app_toolbar')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex  flex-wrap flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('manager.dashboard.index') }}" class="text-muted text-hover-primary">Bảng điều
                            kiển</a>
                    </li>

                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">
                        <a href="{{ route('manager.course.list-page') }}" class="text-muted text-hover-primary">
                            Danh sách khóa học
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('manager.course.learning-roadmap.index-page', ['course_id' => $course->id]) }}"
                            class="text-muted">Lộ trình khóa học</a>
                    </li>

                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">Sắp xếp bài học</li>
                </ul>
            </div>

        </div>
    </div>
@endsection

@section('kt_app_content')
    <div class="card card-flush">

        <div class="card-header align-items-center justify-content-start gap-md-5">
            <h1 class="fw-bold text-gray-900">Sắp xếp bài học</h1>
        </div>

        <div class="card-body pt-0 p-10 p-lg-15">

            @php
                $orderlesson = 1;
            @endphp

            @foreach ($lessons as $lesson)
                <div class="border bg-secondary p-5 mb-5 rounded">
                    <div class="m-0">

                        <div class="d-flex align-items-center collapsible py-3 toggle  mb-0" data-bs-toggle="collapse"
                            data-bs-target="#kt_support_{{ $lesson->id }}">

                            <div class="ms-n1 me-5">
                                <i class="ki-duotone ki-down toggle-on text-primary fs-2"></i>
                                <i class="ki-duotone ki-right toggle-off fs-2"></i>
                            </div>

                            <div class="d-flex align-items-center flex-wrap">
                                <h3 class="text-gray-800 fw-semibold cursor-pointer me-3 mb-0">
                                    Bài {{ $orderlesson }}:
                                    {{ $lesson->name }}
                                </h3>
                            </div>
                        </div>

                    </div>
                    @php
                        $orderlesson++;
                    @endphp
                </div>
            @endforeach

        </div>
    </div>
@endsection

@push('script')
@endpush

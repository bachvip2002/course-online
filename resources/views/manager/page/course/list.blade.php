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
                    <li class="breadcrumb-item text-dark">Danh sách khóa học</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->

            <!--end::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('manager.course.create-page') }}" class="btn btn-sm btn-success">
                    <i class="ki-outline ki-plus fs-2"></i>
                    Thêm khóa học
                </a>
            </div>
        </div>
        <!--end::Toolbar container-->
    </div>
@endsection

@section('kt_app_content')
    <!--begin::Products-->
    <div class="card card-flush">
        <form class="" action="{{ route('manager.course.list-page') }}">
            @method('GET')
            <!--begin::Card header-->
            <div class="card-header align-items-center justify-content-start gap-md-5">

                <!--begin::Search_full_name-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                    <input type="text" value="{{ request()->query('name') }}" name="name"
                        data-kt-ecommerce-product-filter="search" class="form-control w-250px ps-12"
                        placeholder="Tìm kiếm theo tên" />
                </div>
                <!--end::Search_full_name-->

                <!--begin::Search_phone_number-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                    <input type="text" value="{{ request()->query('code') }}" name="code"
                        data-kt-ecommerce-product-filter="search" class="form-control w-250px ps-12"
                        placeholder="Tìm kiếm theo mã" />
                </div>
                <!--end::Search_phone_number-->

                <div class="d-flex align-items-center position-relative my-1">
                    <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                </div>

            </div>
        </form>

        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <div class="kt_user_table_wrapper">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_user_table">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_user_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-50px">ID</th>
                                <th class="min-w-200px">Mã</th>
                                <th class="min-w-200px">Tên</th>
                                <th class="min-w-200px">Gía</th>
                                <th class="min-w-200px">trạng thái</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse ($courses as $course)
                                <tr class="is-record-{{ $course->id }}">
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $course->id }}</span>
                                    </td>
                                    <td>
                                        <span class="text-gray-800 text-hover-primary fs-5">{{ $course->code }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px overflow-hidden me-3">
                                                <a href="{{ asset('upload/' . $course->image_path) }}" target="_blank">
                                                    <div class="symbol-label">
                                                        <img src="{{ asset('upload/' . $course->image_path) }}"
                                                            alt="Francis Mitcham" class="w-100">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <span class="fw-bold"
                                                    data-kt-ecommerce-product-filter="name">{{ $course->name }}</span>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-gray-800 text-hover-primary fs-5">{{ $course->price }}</span>
                                    </td>
                                    <td>
                                        <span class="badge py-3 px-4 fs-7 badge-light-primary">{{ $course->status }}Không
                                            hoạt động</span>
                                    </td>
                                    <td class="d-flex justify-content-around align-items-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="button btn btn-sm btn-warning">
                                                <a class="text-white"
                                                    href="{{ route('manager.course.edit-page', ['course_id' => $course->id]) }}">
                                                    Sửa
                                                </a>
                                            </button>
                                            <button class="btn btn-sm btn-danger ajax-btn-delete"
                                                data-url_delete_record="{{ route('manager.course.delete', ['course_id' => $course->id]) }}">Xóa</button>
                                            <!--begin::Toggle-->
                                            <button type="button" class="btn btn-sm btn-primary rotate"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                                                data-kt-menu-offset="30px, 30px">
                                                Menu
                                                <i class="ki-duotone ki-down fs-3 rotate-180 ms-3 me-0"></i>
                                            </button>
                                            <!--end::Toggle-->

                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">
                                                        <a class="btn btn-sm btn-info"
                                                            href="{{ route('manager.course.learning-roadmap.index-page', ['course_id' => $course->id]) }}">
                                                            Lộ trình khóa học
                                                        </a>
                                                    </div>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('manager.course.edit-page', ['course_id' => $course->id]) }}">
                                                Chi tiết
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end::Table-->
            @include('manager.layout.paginate.basic', [
                'paginator' => $courses,
            ])
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

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
                    <li class="breadcrumb-item text-dark">Quản lý tài nguyên</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->

            <!--end::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('manager.resource-management.create-page') }}" class="btn btn-sm btn-success">
                    <i class="ki-outline ki-plus fs-2"></i>
                    Thêm tài nguyên
                </a>
            </div>
        </div>
        <!--end::Toolbar container-->
    </div>
@endsection

@section('kt_app_content')
    <!--begin::Products-->
    <div class="card card-flush">
        <form class="" action="{{ route('manager.resource-management.list-page') }}">
            @method('GET')
            <!--begin::Card header-->
            <div class="card-header align-items-center justify-content-start gap-md-5">

                <!--begin::Search_full_name-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                    <input type="text" value="{{ request()->query('full_name') }}" name="full_name"
                        data-kt-ecommerce-product-filter="search" class="form-control w-250px ps-12"
                        placeholder="Tìm kiếm đường dẫn" />
                </div>
                <!--end::Search_full_name-->

                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Select2-->
                    <select class="form-select w-200px" name="status" data-control="select2" data-hide-search="true"
                        data-placeholder="Trạng thái" data-kt-ecommerce-product-filter="status">
                        <option value="0">Tất cả</option>
                        @foreach ($resourceTypes as $resourceTypeId => $resourceType)
                            <option {{ request()->query('status') == $resourceTypeId ? 'selected' : '' }}
                                value="{{ $resourceTypeId }}">
                                {{ $resourceType }}
                            </option>
                        @endforeach
                    </select>
                    <!--end::Select2-->
                </div>

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
                                <th class="min-w-200px">Đường đẫn</th>
                                <th class="text-end min-w-100px">Kiểu</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse ($resources as $user)
                                <tr class="is-record-{{ $user->id }}">
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $user->id }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px overflow-hidden me-3">
                                                <a href="{{ asset('upload/' . $user->avatar_path) }}" target="_blank">
                                                    <div class="symbol-label">
                                                        <img src="{{ asset('upload/' . $user->avatar_path) }}"
                                                            alt="Francis Mitcham" class="w-100">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <span class="fw-bold"
                                                    data-kt-ecommerce-product-filter="full_name">{{ $user->full_name }}</span>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">{{ $user->phone_number }}</span>
                                    </td>
                                    <td class="text-end pe-0" data-order="33">
                                        <span class="fw-bold">{{ $user->address }}</span>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span>{{ $user->id_login }}</span>
                                    </td>
                                    <td class="text-end pe-0" data-order="Published">
                                        <span
                                            class="badge py-3 px-4 fs-7 badge-{{ $user->statusBgColor }}">{{ $user->statusText }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="button btn btn-sm btn-warning">
                                                <a class="text-white"
                                                    href="{{ route('manager.user.edit-page', ['user_id' => $user->id]) }}">Sửa</a>
                                            </button>
                                            <button class="btn btn-sm btn-danger ajax-btn-delete"
                                                data-url_delete_record="{{ route('manager.user.delete', ['user_id' => $user->id]) }}">Xóa</button>
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('manager.user.detail-page', ['user_id' => $user->id]) }}">
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
                'paginator' => $resources,
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

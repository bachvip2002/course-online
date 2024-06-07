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
        <div class="card card-custom gutter-b example example-compact card-validate-form card-sticky">
            <div class="card-header">
                <h3 class="card-title">
                    Tạo người dùng
                </h3>
                <div class="card-toolbar">
                </div>
            </div>
            <!--begin::Form-->
            <form class="validate-form" id="validate-form" method="PUT"
                data-kt-redirect-url="{{ route('manager.user.list-page') }}"
                action="{{ route('manager.user.update', ['user_id' => $user->id]) }}">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="mb-15">

                        <div class="form-group form-ajax-validate row mb-3">
                            <label class="col-lg-3 col-form-label required" for="full_name">Họ và tên:</label>
                            <div class="col-lg-6">
                                <input type="text" name="full_name" id="full_name"
                                    class="form-control ajax-input-css-display" placeholder="Nhập họ và tên"
                                    value="{{ $user->full_name }}">
                                <span class="ajax-msg-display-full_name form-text text-danger">
                                </span>
                            </div>
                        </div>

                        <div class="form-group form-ajax-validate row mb-3">
                            <label class="col-lg-3 col-form-label required" for="email">Địa chỉ Email:</label>
                            <div class="col-lg-6">
                                <input type="text" name="email" id="email"
                                    class="form-control ajax-input-css-display" placeholder="Nhập email"
                                    value="{{ $user->email }}">
                                <span class="ajax-msg-display-email form-text text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group form-ajax-validate row mb-3">
                            <label class="col-lg-3 col-form-label required" for="id_login">ID đăng nhập:</label>
                            <div class="col-lg-6">
                                <input type="text" name="id_login" id="id_login" value="{{ $user->id_login }}"
                                    class="form-control ajax-input-css-display" placeholder="Nhập tài khoản">
                                <span class="ajax-msg-display-id_login form-text text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group form-ajax-validate row mb-3">
                            <label class="col-lg-3 col-form-label" for="password">Mật khẩu mới:</label>
                            <div class="col-lg-6">
                                <input type="text" name="password" id="password"
                                    class="form-control ajax-input-css-display" placeholder="Nhập mật khẩu">
                                <span class="ajax-msg-display-password form-text text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group form-ajax-validate row mb-3">
                            <label class="col-lg-3 col-form-label" for="status">Trạng thái:</label>
                            <div class="col-lg-6">
                                <select name="status" id="status" class="form-control ajax-input-css-display">
                                    @foreach ($defaultStatues as $statusId => $status)
                                        <option {{ $user->status == $statusId ? 'selected' : '' }}
                                            value="{{ $statusId }}">
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="ajax-msg-display-status form-text text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group form-ajax-validate row mb-3">
                            <label class="col-lg-3 col-form-label required" for="address">Địa chỉ:</label>
                            <div class="col-lg-6">
                                <input type="text" name="address" id="address"
                                    class="form-control ajax-input-css-display" placeholder="Nhập địa chỉ"
                                    value="{{ $user->address }}">
                                <span class="ajax-msg-display-address form-text text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group form-ajax-validate row mb-3">
                            <label class="col-lg-3 col-form-label required" for="phone_number">Số điện thoại:</label>
                            <div class="col-lg-6">
                                <input type="text" name="phone_number" id="phone_number"
                                    value="{{ $user->phone_number }}" class="form-control ajax-input-css-display"
                                    placeholder="Nhập số điện thoại">
                                <span class="ajax-msg-display-phone_number form-text text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group form-ajax-validate row mb-3">
                            <label class="col-lg-3 col-form-label" for="avatar_path">Hình ảnh cá nhân:</label>
                            <div class="col-lg-6">
                                <input type="file" name="avatar_path" id="avatar_path"
                                    class="form-control ajax-input-css-display">
                                <span class="ajax-msg-display-avatar_path form-text text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group form-ajax-validate row mb-3">
                            <label class="col-lg-3 col-form-label" for="description">Mô tả:</label>
                            <div class="col-lg-6">
                                <textarea name="description" id="description" class="form-control ajax-input-css-display">{!! $user->description !!}</textarea>
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
                        <a href="{{ route('manager.user.list-page') }}"
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
                $('button[form="validate-form"]')
                    .attr('data-kt-indicator', 'on')
                    .attr('disabled', 'disabled')

                event.preventDefault()
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

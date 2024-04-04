@extends('manager.layout.authentication.app')

@section('authentication')
    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
        <div class="w-lg-500px p-10">
            <form class="w-100" id="sign_in_form" method="POST" data-kt-redirect-url="{{ route('manager.dashboard.index') }}"
                action="{{ route('manager.authentication.login') }}">
                @csrf
                @method('POST')

                <div class="text-center mb-11">
                    <h1 class="text-dark fw-bolder mb-3">Đăng nhập quản trị</h1>
                    <div class="text-gray-500 fw-semibold fs-6">Chiến dịch xã hội của bạn</div>
                </div>

                <div class="fv-row mb-8">
                    <input type="text" placeholder="ID đăng nhập" name="id_login" class="form-control" />
                </div>

                <div class="fv-row mb-8">
                    <input type="password" placeholder="Mật khẩu" name="password" class="form-control" />
                </div>

                <div class="d-grid mb-8">
                    <button type="submit" id="sign_in_submit" class="btn btn-primary">
                        <span class="indicator-label">Đăng nhập</span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection


@push('script')
    <script src="{{ asset('assets/js/form-data-ajax.js') }}"></script>
    <script>
        $('#sign_in_form').submit((event) => {
            $(event.target)
                .find('#sign_in_submit')
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
                    text: "Bạn đã đăng nhập thành công",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Đi đến bảng điều kiển",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    }
                }).then((result) => {
                    window.location.href = $(event.target).data('kt-redirect-url')
                });

            }).fail((res) => {

                $(event.target)
                    .find('#sign_in_submit')
                    .attr('data-kt-indicator', 'off')
                    .attr('disabled', false)

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

                $('input.form-control').addClass('is-invalid')
            })
        })
    </script>
@endpush

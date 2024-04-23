@extends('layout.base')
@section('title', 'Client login')
@section('screen')
    <div class="container">
        <div class="row min-vh-100 d-flex align-items-center justify-content-center">
            <div class="col-xl-5 col-lg-5 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/images/logo-vmed-text.png') }}" alt="">
                            </div>
                            <div class="user">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-user" placeholder="Điền tên đăng nhập...">
                                    <small class="text-danger pl-2 username-notification"></small>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user" placeholder="Mật khẩu">
                                    <small class="text-danger pl-2 password-notification"></small>
                                </div>
                                <div class="form-group">
                                    <select name="company" class="form-control form-control-user">
                                        <option selected disabled>Chọn công ty</option>
                                        <option value="A11">A11</option>
                                        <option value="A12">A12</option>
                                        <option value="A14">A14</option>
                                    </select>
                                    <small class="text-danger pl-2 company-notification"></small>
                                </div>
                                <button class="btn btn-primary btn-user btn-block" id="login">Đăng nhập</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/auth/client.js') }}"></script>
@endpush
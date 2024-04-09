@extends('layout.base')
@section('title', 'LOGIN')
@section('screen')
    <div class="container">
        <div class="row min-vh-100 d-flex align-items-center justify-content-center">
            <div class="col-xl-5 col-lg-5 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-gray-900 mb-4">WELCOME</h4>
                            </div>
                            <form class="user" action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-user" placeholder="Điền tên đăng nhập...">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user" placeholder="Mật khẩu">
                                </div>
                                <button class="btn btn-primary btn-user btn-block" type="submit">Đăng nhập</button>
                                @if (Session::has('error'))
                                    <span class="text-danger">{{ Session::get('error') }}</span>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
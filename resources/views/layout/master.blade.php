@extends('layout.base')
@section('screen')
    <div id="wrapper">
        @include('layout.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layout.header')
                <div class="container-fluid">
                    @yield('title-manage')
                    @yield('content')
                </div>
            </div>
            @include('layout.footer')
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng đăng xuất?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn sẵn sàng kết thúc phiên làm việc hiện tại của mình.</div>
                <div class="modal-footer">
                    <a class="btn btn-primary shadow-sm" href="{{ route('logout') }}">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade bd-example-modal-lg" id="paymentOrderModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Quy trình</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="stepper-wrapper">
                    <div class="stepper-item completed">
                      <div class="step-counter">1</div>
                      <div class="step-name">Phạm Thị Vân Ngọc</div>
                    </div>
                    <div class="stepper-item completed">
                      <div class="step-counter">2</div>
                      <div class="step-name">Đặng Thùy Linh</div>
                    </div>
                    <div class="stepper-item active">
                      <div class="step-counter">3</div>
                      <div class="step-name">Trần Thanh Tùng</div>
                    </div>
                    <div class="stepper-item">
                      <div class="step-counter">4</div>
                      <div class="step-name">Đàm Minh Hiếu</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary shadow-sm" href="#">Xác nhận</button>
            </div>
          </div>
        </div>
    </div>
@endsection

@extends('layout.master')
@section('title', 'Đề nghị thanh toán')
@section('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.responsive.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/progressbar.css') }}" rel="stylesheet">
@endsection
@section('title-manage')
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">QUẢN LÝ ĐỀ NGHỊ</h1>
    </div>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách đề nghị</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="suggestion" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã công ty</th>
                            <th>Số chứng từ</th>
                            <th>Người nhận</th>
                            <th>Người đề nghị</th>
                            <th>Tiền</th>
                            <th>Ngày</th>
                            <th>Tình trạng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <th>Mã công ty</th>
                            <th>Số chứng từ</th>
                            <th>Người nhận</th>
                            <th>Người đề nghị</th>
                            <th>Tiền</th>
                            <th>Ngày</th>
                            <th>Tình trạng</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="paymentOrderModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                      <div class="step-counter"><img src="{{ asset('assets/images/man.png') }}" alt=""></div>
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
@push('js')
     <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/datatables/dataTables.responsive.min.js') }}"></script>
     <script src="{{ asset('assets/js/suggestion/list.js') }}"></script>
     <script src="{{ asset('assets/js/suggestion/approve.js') }}"></script>
     <script src="{{ asset('assets/js/suggestion/cancel.js') }}"></script>
@endpush
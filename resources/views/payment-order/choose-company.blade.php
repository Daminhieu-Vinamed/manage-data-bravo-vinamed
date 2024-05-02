@extends('layout.master')
@section('title', 'Chọn công ty')
@section('css')

@endsection
@section('title-manage')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">QUẢN LÝ ĐỀ NGHỊ THANH TOÁN</h1>
    </div>
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="card shadow mb-4" style="width: 23rem">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary text-center">Chọn công ty để tạo mới đề nghị thanh toán</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('payment-order.create') }}" method="GET">
                    <select name="company" class="form-control">
                        <option disabled selected>chọn công ty</option>
                        <option value="A11">A11 TMVM</option>
                        <option value="A12">A12 PPVM</option>
                        <option value="A14">A14 VMPP</option>
                    </select>
                    @error('company')
                        <div class="text-center">
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                    @enderror
                    <div class="mt-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-sm btn-primary shadow-sm">Chọn</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush

@extends('layout.master')
@section('title', 'Chọn công ty')
@section('title-manage')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">QUẢN LÝ ĐỀ NGHỊ</h1>
    </div>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Chọn công ty và kiểu để tạo mới đề nghị</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('suggestion.directional-create') }}" method="GET">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <select name="company" class="custom-select">
                                    <option disabled selected>Chọn công ty</option>
                                    @foreach (config('constants.company') as $company)
                                        <option value="{{ $company }}" {{ old('company') === $company ? 'selected' : '' }}>{{ $company }}</option>
                                    @endforeach
                                </select>
                                @error('company')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <select name="DocCode" class="custom-select">
                                    <option disabled selected>Chọn kiểu đề nghị</option>
                                    <option value="TT" {{ old('DocCode') === 'TT' ? 'selected' : '' }}>Đề nghị thanh toán</option>
                                    <option value="TG" {{ old('DocCode') === 'TG' ? 'selected' : '' }}>Đề nghị tạm ứng</option>
                                    <option value="CC" {{ old('DocCode') === 'CC' ? 'selected' : '' }}>Đề nghị công tác phí</option>
                                </select>
                                @error('DocCode')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-sm btn-primary shadow-sm">Chọn</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

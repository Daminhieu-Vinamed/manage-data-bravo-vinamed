@extends('layout.master')
@section('title', 'Tạo mới')
@section('title-manage')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">QUẢN LÝ ĐỀ NGHỊ</h1>
    </div>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary text-center">Tạo mới đề nghị tạm ứng cho {{ request()->get('company') }}</h6>
            <div class="input-group input-group-sm col-md-3 p-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Ngày tạo</span>
                </div>
                <input type="date" class="form-control" id="DocDate" value="{{ date('Y-m-d') }}">
            </div>
            <div class="input-group input-group-sm col-md-3 p-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Mã chứng từ</span>
                </div>
                <input type="text" class="form-control" id="DocNo" value="{{ $data['DocNo'] }}">
            </div>
        </div>
        <input type="hidden" value="{{ request()->get('company') }}" id="company">
        <input type="hidden" value="{{ request()->get('DocCode') }}" id="DocCode">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="CustomerCode" class="form-label small">Người đề nghị</label>
                    <input list="listCustomerCode1" class="form-control" id="CustomerCode">
                    <datalist id="listCustomerCode1">
                        @foreach ($data['B20Customer'] as $item)
                            <option data-value="{{ $item->Code }}" value="{{ $item->Code . ": " . $item->Name }}" BankAccountNo="{{ $item->BankAccountNo }}" BankName="{{ $item->BankName }}" Name="{{ $item->Name }}">{{ $item->TaxRegNo }}</option>
                        @endforeach
                    </datalist>
                    <span class="text-danger small" id="CustomerCode_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="Description" class="form-label small">Nội dung</label>
                    <textarea class="form-control" id="Description"></textarea>
                    <span class="text-danger small" id="Description_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="Hinh_Thuc_TT" class="form-label small">Phương thức thanh toán</label>
                    <select class="custom-select" id="Hinh_Thuc_TT">
                        <option value="TM">Tiền mặt</option>
                        <option value="CK">Chuyển khoản</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="EmployeeCode" class="form-label small">Nhân viên</label>
                    <input list="listEmployeeCode" class="form-control" id="EmployeeCode">
                    <datalist id="listEmployeeCode">
                        @foreach ($data['B20Employee'] as $item)
                            <option department="{{ $item->DeptCode }}" data-value="{{ $item->Code }}"
                                value="{{ $item->Code }}">
                                {{ $item->Name }}
                                {{ $item->Email !== config('constants.value.empty') ? ' - ' . $item->Email : config('constants.value.empty') }}
                            </option>
                        @endforeach
                    </datalist>
                    <span class="text-danger small" id="EmployeeCode_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="CurrencyCode" class="form-label small">Loại tiền</label>
                    <select class="custom-select" id="CurrencyCode">
                        @foreach ($data['B20Currency'] as $item)
                            <option value="{{ $item->Code }}"
                                {{ $item->Code === 'VND' ? 'selected' : config('constants.value.empty') }}>
                                {{ $item->Code . ' - ' . $item->Name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger small" id="CurrencyCode_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="ExchangeRate" class="form-label small">Tỷ giá hạch toán</label>
                    <input type="number" class="form-control" id="ExchangeRate" readonly>
                    <span class="text-danger small" id="ExchangeRate_error"></span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="requests-for-advances" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nội dung</th>
                            <th>Người nhận tiền</th>
                            <th>Mục đích tạm ứng</th>
                            <th>Địa bàn</th>
                            <th id="th_OriginalAmount9">Giá trị VND</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="line-0">
                            <td>
                                <textarea class="form-control" maxlength="255" name="Description[]"></textarea>
                            </td>
                            <td>
                                <input list="listCustomerCode2" class="form-control" name="CustomerCode[]">
                                <datalist id="listCustomerCode2">
                                    @foreach ($data['B20Customer'] as $item)
                                        <option data-value="{{ $item->Code }}" value="{{ $item->Code }}" BankAccountNo="{{ $item->BankAccountNo }}" BankName="{{ $item->BankName }}" Name="{{ $item->Name }}">
                                            {{ $item->Address }}
                                            {{ $item->Person !== config('constants.value.empty') ? ' - ' . $item->Person . ' - ' : config('constants.value.empty') }}
                                            {{ $item->TaxRegNo }} {{ $item->Name2 }}</option>
                                    @endforeach
                                </datalist>
                            </td>
                            <td>
                                <input list="listTemporaryCode" class="form-control" name="TemporaryCode[]">
                                <datalist id="listTemporaryCode">
                                    @foreach ($data['vB20Temporary'] as $item)
                                        <option data-value="{{ $item->Code }}" value="{{ $item->Code }}">{{ $item->Name }}</option>
                                    @endforeach
                                </datalist>
                            </td>
                            <td>
                                <select class="custom-select" name="Area[]">
                                        <option selected disabled>Chọn</option>
                                        <option value="DN">Đà Nẵng</option>
                                        <option value="HCM">Hồ Chí Minh</option>
                                        <option value="HN">Hà Nội</option>
                                </select>
                            </td>
                            <td>
                                <input class="form-control" maxlength="255" name="OriginalAmount9[]" id="OriginalAmount9"/>
                            </td>
                            <td>
                                <textarea class="form-control" maxlength="255" name="Note[]"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="py-3 row justify-content-center">
                <button class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" type="button" id="add-row">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="row row-total-money">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4 form-group-total">
                    <label for="TotalOriginalAmount" class="form-label small">Tổng cộng</label>
                    <input type="number" class="form-control" id="TotalOriginalAmount" readonly>
                    <span class="text-danger small" id="TotalOriginalAmount_error"></span>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="py-3 row justify-content-center">
                <button type="button" id="create-requests-for-advances" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">TẠO MỚI</button>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/suggestion/func.js') }}"></script>
    <script src="{{ asset('assets/js/suggestion/requests-for-advances.js') }}"></script>
@endpush

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
            <div class="input-group input-group-sm col-md-2 p-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Ngày tạo</span>
                </div>
                <input type="date" class="form-control" name="DocDate" value="{{ date('Y-m-d') }}">
            </div>
            <div class="input-group input-group-sm col-md-2 p-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Mã chứng từ</span>
                </div>
                <input type="text" class="form-control" name="DocNo" value="{{ $data['document_number'] }}">
            </div>
        </div>
        <input type="hidden" value="{{ request()->get('company') }}" name="company">
        <input type="hidden" value="{{ request()->get('DocCode') }}" name="DocCode">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="EmployeeCode" class="form-label small">Người đề nghị</label>
                    <input list="listEmployeeCode1" class="form-control" name="EmployeeCode1" id="EmployeeCode1">
                    <datalist id="listEmployeeCode1">
                        @foreach ($data['bill_staff'] as $item)
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
                    <label for="AmountTT" class="form-label small">Nội dung</label>
                    <textarea class="form-control"></textarea>
                    <span class="text-danger small" id="AmountTT_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="Hinh_Thuc_TT" class="form-label small">Phương thức thanh toán</label>
                    <select class="custom-select" name="Hinh_Thuc_TT" id="Hinh_Thuc_TT">
                        <option value="TM">Tiền mặt</option>
                        <option value="CK">Chuyển khoản</option>
                    </select>
                    <span class="text-danger small" id="Hinh_Thuc_TT_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="EmployeeCode" class="form-label small">Nhân viên</label>
                    <input list="listEmployeeCode" class="form-control" name="EmployeeCode" id="EmployeeCode">
                    <datalist id="listEmployeeCode">
                        @foreach ($data['bill_staff'] as $item)
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
                    <select class="custom-select" name="CurrencyCode" id="CurrencyCode">
                        @foreach ($data['currency'] as $item)
                            <option value="{{ $item->Code }}"
                                {{ $item->Code === 'VND' ? 'selected' : config('constants.value.empty') }}>
                                {{ $item->Code . ' - ' . $item->Name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger small" id="CurrencyCode_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="ExchangeRate" class="form-label small">Tỷ giá hạch toán</label>
                    <input type="number" class="form-control" name="ExchangeRate" id="ExchangeRate" readonly>
                    <span class="text-danger small" id="ExchangeRate_error"></span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nội dung</th>
                            <th>Người nhận tiền</th>
                            <th>Mục đích tạm ứng</th>
                            <th>Địa bàn</th>
                            <th id="th-name-vat">Giá trị VND</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="line-0" location="0">
                            <td>
                                <textarea class="form-control" maxlength="255" name="Note1[]" id="Note1"></textarea>
                                <span class="text-danger small" id="Note_error"></span>
                            </td>
                            <td>
                                <input class="form-control" maxlength="255" name="Note2[]" id="Note2"/>
                                <span class="text-danger small" id="Note_error"></span>
                            </td>
                            <td>
                                <input class="form-control" maxlength="255" name="Note3[]" id="Note3"/>
                                <span class="text-danger small" id="Note_error"></span>
                            </td>
                            <td>
                                <input class="form-control" maxlength="255" name="Note4[]" id="Note4"/>
                                <span class="text-danger small" id="Note_error"></span>
                            </td>
                            <td>
                                <input class="form-control" maxlength="255" name="Note5[]" id="Note5"/>
                                <span class="text-danger small" id="Note_error"></span>
                            </td>
                            <td>
                                <textarea class="form-control" maxlength="255" name="Note6[]" id="Note6"></textarea>
                                <span class="text-danger small" id="Note_error"></span>
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
            <div class="row">
                <div class="form-group col-md-4 form-group-into-money">
                    <label for="into_money" class="form-label small">Thành tiền</label>
                    <input type="number" class="form-control" name="TotalOriginalAmount0" id="TotalOriginalAmount0" readonly>
                </div>
                <div class="form-group col-md-4 form-group-tax-money">
                    <label for="tax_money" class="form-label small">Tiền VAT</label>
                    <input type="number" class="form-control" name="TotalOriginalAmount3" id="TotalOriginalAmount3" readonly>
                </div>
                <div class="form-group col-md-4 form-group-total">
                    <label for="TotalOriginalAmount" class="form-label small">Tổng cộng</label>
                    <input type="number" class="form-control" name="TotalOriginalAmount" id="TotalOriginalAmount" readonly>
                </div>
            </div>
            <div class="py-3 row justify-content-center">
                <h6 class="h6 mb-0 font-weight-bold text-primary">Thông tin ngân hàng</h6>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="BankName" class="form-label small">Tên ngân hàng</label>
                    <input type="text" class="form-control" name="BankName" id="BankName">
                    <span class="text-danger small" id="BankName_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="BankAccountNo" class="form-label small">Số tài khoản</label>
                    <input type="text" class="form-control" name="BankAccountNo" id="BankAccountNo">
                    <span class="text-danger small" id="BankAccountNo_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="Ten_Chu_TK" class="form-label small">Tên chủ tài khoản</label>
                    <input type="text" class="form-control" name="Ten_Chu_TK" id="Ten_Chu_TK">
                    <span class="text-danger small" id="Ten_Chu_TK_error"></span>
                </div>
                <div class="form-group col-md-12">
                    <label for="Description1" class="form-label small">Nội dung</label>
                    <textarea class="form-control" name="Description1" id="Description1"></textarea>
                    <span class="text-danger small" id="Description1_error"></span>
                </div>
            </div>
            <div class="py-3 row justify-content-center">
                <button type="button" id="create-payment-order" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">TẠO MỚI</button>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/suggestion/func.js') }}"></script>
    <script src="{{ asset('assets/js/suggestion/requests-for-advances.js') }}"></script>
@endpush

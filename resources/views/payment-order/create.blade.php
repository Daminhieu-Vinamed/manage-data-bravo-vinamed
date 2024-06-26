@extends('layout.master')
@section('title', 'Tạo mới')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
@endsection
@section('title-manage')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">QUẢN LÝ ĐỀ NGHỊ THANH TOÁN</h1>
    </div>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary text-center">Tạo mới đề nghị thanh toán cho
                {{ request()->get('company') }}</h6>
            <div class="input-group input-group-sm col-md-2 p-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Ngày tạo</span>
                </div>
                <input type="date" class="form-control" name="DocDate" id="DocDate" value="{{ date('Y-m-d') }}">
            </div>
            <div class="input-group input-group-sm col-md-2 p-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Mã chứng từ</span>
                </div>
                <input type="date" class="form-control" name="DocCode" id="DocCode" value="TT.0624.0762">
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="EmployeeCode" class="form-label small">Người đề nghị</label>
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
                </div>
                <div class="form-group col-md-4">
                    <label for="CustomerCode" class="form-label small">Nhà cung cấp/Người nhận</label>
                    <input list="listCustomerCode" class="form-control" name="CustomerCode" id="CustomerCode">
                    <datalist id="listCustomerCode">
                        @foreach ($data['bill_detailed_object'] as $item)
                            <option data-value="{{ $item->Code }}" value="{{ $item->Code }}">
                                {{ $item->Address }}
                                {{ $item->Person !== config('constants.value.empty') ? ' - ' . $item->Person . ' - ' : config('constants.value.empty') }}
                                {{ $item->TaxRegNo }} {{ $item->Name2 }}</option>
                        @endforeach
                    </datalist>
                </div>
                <div class="form-group col-md-4">
                    <label for="AmountTT" class="form-label small">Đã trả trước cho NCC</label>
                    <input type="number" class="form-control" name="AmountTT" id="AmountTT">
                </div>
                <div class="form-group col-md-4">
                    <label for="Stt_TU" class="form-label small">Đề nghị tạm ứng</label>
                    <input list="list_Stt_TU" class="form-control" name="Stt_TU" id="Stt_TU">
                    <datalist id="list_Stt_TU">
                        @foreach ($data['requests_for_advances'] as $item)
                            <option data-value="{{ $item->Stt }}" value="{{ $item->Stt }}">
                                {{ $item->DocNo . ' - ' . $item->TotalAmount0 . ' - ' . $item->CustomerName . ' - ' . $item->DocDate }}
                            </option>
                        @endforeach
                    </datalist>
                </div>
                <div class="form-group col-md-4">
                    <label for="AmountTU" class="form-label small">Đã tạm ứng</label>
                    <input type="number" class="form-control" name="AmountTU" id="AmountTU">
                </div>
                <div class="form-group col-md-4">
                    <label for="Hinh_Thuc_TT" class="form-label small">Hình thức thanh toán</label>
                    <select class="custom-select" name="Hinh_Thuc_TT" id="Hinh_Thuc_TT">
                        <option value="CK">Chuyển khoản</option>
                        <option value="TM">Tiền mặt</option>
                    </select>
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
                </div>
                <div class="form-group col-md-4">
                    <label for="ExchangeRate" class="form-label small">Tỷ giá hạch toán</label>
                    <input type="number" class="form-control" name="ExchangeRate" id="ExchangeRate" disabled>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Số hóa đơn</th>
                            <th>Ngày hóa đơn</th>
                            <th>Nội dung</th>
                            <th>Số tờ khai</th>
                            <th>Số vận đơn</th>
                            <th>Trọng lượng</th>
                            <th>Đơn vị trọng lượng</th>
                            <th>Đối tượng chi tiết</th>
                            <th>Khoản mục</th>
                            <th>Nhân viên</th>
                            <th>Bộ phận</th>
                            <th>Đơn hàng mua</th>
                            <th>Hãng cung cấp</th>
                            <th id="th-name-vat">Giá trị VND chưa VAT</th>
                            <th colspan="3" id="th-name-value-added-tax-vat">Thuế giá trị gia tăng (VAT)</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="line-0">
                            <td>
                                <input type="text" class="form-control" name="So_Hd[]" id="So_Hd">
                            </td>
                            <td>
                                <input type="date" class="form-control" name="Ngay_Hd[]" id="Ngay_Hd">
                            </td>
                            <td>
                                <textarea class="form-control" maxlength="255" name="Description[]" id="Description"></textarea>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="Invoice[]" id="Invoice">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="So_Van_Don[]" id="So_Van_Don">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="Trong_Luong[]" id="Trong_Luong">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="DV_Trong_Luong[]" id="DV_Trong_Luong">
                            </td>
                            <td>
                                <input list="list_detailed_object" class="form-control" name="bill_detailed_object[]"
                                    id="bill_detailed_object">
                                <datalist id="list_detailed_object">
                                    @foreach ($data['bill_detailed_object'] as $item)
                                        <option data-value="{{ $item->Code }}" value="{{ $item->Code }}">
                                            {{ $item->Address }}
                                            {{ $item->Person !== config('constants.value.empty') ? ' - ' . $item->Person . ' - ' : config('constants.value.empty') }}
                                            {{ $item->TaxRegNo }} {{ $item->Name2 }}</option>
                                    @endforeach
                                </datalist>
                            </td>
                            <td>
                                <input list="listExpenseCatgCode" class="form-control" name="ExpenseCatgCode[]"
                                    id="ExpenseCatgCode">
                                <datalist id="listExpenseCatgCode">
                                    @foreach ($data['base_items'] as $item)
                                        <option data-value="{{ $item->Code }}" value="{{ $item->Code }}">
                                            {{ $item->Name }}</option>
                                    @endforeach
                            </td>
                            <td>
                                <input list="listEmployeeCode1" class="form-control" name="EmployeeCode1[]"
                                    id="EmployeeCode1">
                                <datalist id="listEmployeeCode1">
                                    @foreach ($data['bill_staff'] as $item)
                                        <option department="{{ $item->DeptCode }}" data-value="{{ $item->Code }}"
                                            value="{{ $item->Code }}">
                                            {{ $item->Name }}
                                            {{ $item->Email !== config('constants.value.empty') ? ' - ' . $item->Email : config('constants.value.empty') }}
                                        </option>
                                    @endforeach
                                </datalist>
                            </td>
                            <td>
                                <input list="listDeptCode" class="form-control" name="DeptCode[]" id="DeptCode">
                                <datalist id="listDeptCode">
                                    @foreach ($data['bill_part'] as $item)
                                        <option data-value="{{ $item->Code }}" value="{{ $item->Code }}">
                                            {{ $item->Name2 }}</option>
                                    @endforeach
                                </datalist>
                            </td>
                            <td>
                                <input list="list_BizDocId_PO" class="form-control" name="BizDocId_PO[]"
                                    id="BizDocId_PO">
                                <datalist id="list_BizDocId_PO">
                                    @foreach ($data['bill_purchase_order'] as $item)
                                        <option data-value="{{ $item->BizDocId }}" value="{{ $item->BizDocId }}">
                                            {{ $item->DocInfo . ' - ' . date('d-m-Y', strtotime($item->DocDate)) . ' - ' . $item->EmployeeName }}
                                        </option>
                                    @endforeach
                                </datalist>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="Hang_SX[]" id="Hang_SX">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="OriginalAmount9[]"
                                    id="OriginalAmount9">
                            </td>
                            <td>
                                <label for="TaxCode" class="form-label small">Loại</label>
                                <input list="listTaxCode" class="form-control" name="TaxCode[]" id="TaxCode">
                                <datalist id="listTaxCode">
                                    @foreach ($data['bill_tax_category'] as $item)
                                        <option percent="{{ $item->Rate }}" data-value="{{ $item->Code }}"
                                            value="{{ $item->Code }}">
                                            {{ $item->Name . ' - ' . $item->Name2 . ' - ' . $item->Account }}</option>
                                    @endforeach
                                </datalist>
                            </td>
                            <td>
                                <label for="TaxRate" class="form-label small">%</label>
                                <input type="number" class="form-control" name="TaxRate[]" id="TaxRate" disabled>
                            </td>
                            <td>
                                <label for="Amount3" class="form-label small">Tiền VND</label>
                                <input type="number" class="form-control" name="Amount3[]" id="Amount3" disabled>
                            </td>
                            <td>
                                <textarea class="form-control" maxlength="255" name="Note[]" id="Note"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="py-3 row justify-content-center">
                <button class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" id="add-row">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="row">
                <div class="form-group col-md-4 form-group-into-money">
                    <label for="into_money" class="form-label small">Thành tiền</label>
                    <input type="number" class="form-control" name="TotalOriginalAmount0" id="TotalOriginalAmount0"
                        disabled>
                </div>
                <div class="form-group col-md-4 form-group-tax-money">
                    <label for="tax_money" class="form-label small">Tiền VAT</label>
                    <input type="number" class="form-control" name="TotalOriginalAmount3" id="TotalOriginalAmount3"
                        disabled>
                </div>
                <div class="form-group col-md-4 form-group-total">
                    <label for="TotalOriginalAmount" class="form-label small">Tổng cộng</label>
                    <input type="number" class="form-control" name="TotalOriginalAmount" id="TotalOriginalAmount"
                        disabled>
                </div>
            </div>
            <div class="py-3 row justify-content-center">
                <h6 class="h6 mb-0 font-weight-bold text-primary">Thông tin ngân hàng</h6>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="BankName" class="form-label small">Tên ngân hàng</label>
                    <input type="text" class="form-control" name="BankName" id="BankName">
                </div>
                <div class="form-group col-md-4">
                    <label for="BankAccountNo" class="form-label small">Số tài khoản</label>
                    <input type="text" class="form-control" name="BankAccountNo" id="BankAccountNo">
                </div>
                <div class="form-group col-md-4">
                    <label for="Ten_Chu_TK" class="form-label small">Tên chủ tài khoản</label>
                    <input type="text" class="form-control" name="Ten_Chu_TK" id="Ten_Chu_TK">
                </div>
                <div class="form-group col-md-12">
                    <label for="Description1" class="form-label small">Nội dung</label>
                    <textarea class="form-control" name="Description1" id="Description1"></textarea>
                </div>
            </div>
            <div class="py-3 row justify-content-center">
                <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="add-row">TẠO MỚI</button>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
    <script src="{{ asset('assets/js/payment-order/func.js') }}"></script>
    <script src="{{ asset('assets/js/payment-order/create.js') }}"></script>
@endpush

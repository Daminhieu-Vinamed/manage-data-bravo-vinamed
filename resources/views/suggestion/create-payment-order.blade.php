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
            <h6 class="m-0 font-weight-bold text-primary text-center">Tạo mới đề nghị thanh toán cho {{ request()->get('company') }}</h6>
            <div class="input-group input-group-sm col-md-3 p-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Ngày tạo</span>
                </div>
                <input type="date" class="form-control" id="DocDate" value="{{ date('Y-m-d') }}">
            </div>
            <div class="input-group input-group-sm col-md-3 p-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Số chứng từ</span>
                </div>
                <input type="text" class="form-control" id="DocNo" value="{{ $data['document_number'] }}" readonly>
            </div>
        </div>
        <input type="hidden" value="{{ request()->get('company') }}" id="company">
        <input type="hidden" value="{{ request()->get('DocCode') }}" id="DocCode">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="EmployeeCode" class="form-label small">Người đề nghị</label>
                    <input list="listEmployeeCode" class="form-control" id="EmployeeCode">
                    <datalist id="listEmployeeCode">
                        @foreach ($data['bill_staff'] as $item)
                            <option data-value="{{ $item->Code }}" value="{{ $item->Code . ": " . $item->Name }}">{{ $item->Email }}</option>
                        @endforeach
                    </datalist>
                    <span class="text-danger small" id="EmployeeCode_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="CustomerCode1" class="form-label small">Nhà cung cấp/Người nhận</label>
                    <input list="listCustomerCode1" class="form-control" id="CustomerCode1">
                    <datalist id="listCustomerCode1">
                        @foreach ($data['bill_detailed_object'] as $item)
                            <option data-value="{{ $item->Code }}" value="{{ $item->Code . ": " . $item->Name }}" 
                                BankAccountNo="{{ $item->BankAccountNo }}" BankName="{{ $item->BankName }}" Name="{{ $item->Name }}">{{ $item->TaxRegNo }}
                            </option>
                        @endforeach
                    </datalist>
                    <span class="text-danger small" id="CustomerCode1_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="AmountTT" class="form-label small">Đã trả trước cho NCC</label>
                    <input type="number" class="form-control" id="AmountTT">
                    <span class="text-danger small" id="AmountTT_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="Stt_TU" class="form-label small">Đề nghị tạm ứng</label>
                    <input list="list_Stt_TU" class="form-control" id="Stt_TU">
                    <datalist id="list_Stt_TU">
                        @foreach ($data['requests_for_advances'] as $item)
                            <option data-value="{{ $item->Stt }}" value="{{ $item->DocNo }}" TotalAmount0="{{ $item->TotalAmount0 }}">
                                {{ $item->Stt . ' - ' . $item->CustomerName }}
                            </option>
                        @endforeach
                    </datalist>
                    <span class="text-danger small" id="Stt_TU_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="AmountTU" class="form-label small">Đã tạm ứng</label>
                    <input type="number" class="form-control" id="AmountTU">
                    <span class="text-danger small" id="AmountTU_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="Hinh_Thuc_TT" class="form-label small">Hình thức thanh toán</label>
                    <select class="custom-select" id="Hinh_Thuc_TT">
                        <option value="TM">Tiền mặt</option>
                        <option value="CK">Chuyển khoản</option>
                    </select>
                    <span class="text-danger small" id="Hinh_Thuc_TT_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="CurrencyCode" class="form-label small">Loại tiền</label>
                    <select class="custom-select" id="CurrencyCode">
                        @foreach ($data['currency'] as $item)
                            <option value="{{ $item->Code }}"{{ $item->Code === 'VND' ? 'selected' : config('constants.value.empty') }}>{{ $item->Name }}</option>
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
                <table class="table table-bordered" id="table-payment-order" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Số hóa đơn</th>
                            <th>Ngày hóa đơn</th>
                            <th>Nội dung</th>
                            <th>Số tờ khai</th>
                            <th>Số vận đơn</th>
                            {{-- <th>Trọng lượng</th>
                            <th>Đơn vị trọng lượng</th> --}}
                            <th>Đối tượng chi tiết</th>
                            <th>Khoản mục</th>
                            <th>Nhân viên</th>
                            <th>Bộ phận</th>
                            <th>Đơn hàng mua</th>
                            <th>Hãng cung cấp</th>
                            <th id="th_OriginalAmount9">Giá trị VND chưa VAT</th>
                            <th colspan="3" id="th_value_added_tax_vat">Thuế giá trị gia tăng (VAT)</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="line-0">
                            <td>
                                <input type="text" class="form-control" name="So_Hd[]" id="So_Hd">
                                <span class="text-danger small" id="So_Hd_error"></span>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="Ngay_Hd[]" id="Ngay_Hd">
                                <span class="text-danger small" id="Ngay_Hd_error"></span>
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
                            {{-- <td>
                                <input type="number" class="form-control" name="Trong_Luong[]" id="Trong_Luong" value="0">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="DV_Trong_Luong[]" id="DV_Trong_Luong">
                            </td> --}}
                            <td>
                                <input list="listCustomerCode2" class="form-control" name="CustomerCode2[]" id="CustomerCode2">
                                <datalist id="listCustomerCode2">
                                    @foreach ($data['bill_detailed_object'] as $item)
                                        <option data-value="{{ $item->Code }}" value="{{ $item->Code }}">
                                            {{ $item->Address }}
                                            {{ $item->Person !== config('constants.value.empty') ? ' - ' . $item->Person . ' - ' : config('constants.value.empty') }}
                                            {{ $item->TaxRegNo }} {{ $item->Name2 }}</option>
                                    @endforeach
                                </datalist>
                            </td>
                            <td>
                                <input list="listExpenseCatgCode" class="form-control" name="ExpenseCatgCode[]" id="ExpenseCatgCode">
                                <datalist id="listExpenseCatgCode">
                                    @foreach ($data['base_items'] as $item)
                                        <option data-value="{{ $item->Code }}" value="{{ $item->Code }}">
                                            {{ $item->Name }}</option>
                                    @endforeach
                                </datalist>
                            </td>
                            <td>
                                <input list="listEmployeeCode1" class="form-control" name="EmployeeCode1[]" id="EmployeeCode1">
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
                                <input list="list_BizDocId_PO" class="form-control" name="BizDocId_PO[]" id="BizDocId_PO">
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
                                <input type="number" class="form-control" name="OriginalAmount9[]" id="OriginalAmount9" value="0">
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
                                <input type="number" class="form-control" name="TaxRate[]" id="TaxRate" readonly>
                            </td>
                            <td>
                                <label for="OriginalAmount3" class="form-label small">Tiền VND</label>
                                <input type="number" class="form-control" name="OriginalAmount3[]" id="OriginalAmount3" value="0" readonly>
                            </td>
                            <td>
                                <textarea class="form-control" maxlength="255" name="Note[]" id="Note"></textarea>
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
                <div class="col-md-4 form-group-into-money">
                    <div class="form-group">
                        <label for="into_money" class="form-label small">Thành tiền</label>
                        <input type="number" class="form-control" id="TotalOriginalAmount0" value="0" readonly>
                        <span class="text-danger small" id="TotalOriginalAmount0_error"></span>
                    </div>
                </div>
                <div class="col-md-4 form-group-tax-money">
                    <div class="form-group">
                        <label for="tax_money" class="form-label small">Tiền VAT</label>
                        <input type="number" class="form-control" id="TotalOriginalAmount3" value="0" readonly>
                        <span class="text-danger small" id="TotalOriginalAmount3_error"></span>
                    </div>
                </div>
                <div class="col-md-4 form-group-total">
                    <div class="form-group">
                        <label for="TotalOriginalAmount" class="form-label small">Tổng cộng</label>
                        <input type="number" class="form-control" id="TotalOriginalAmount" value="0" readonly>
                        <span class="text-danger small" id="TotalOriginalAmount_error"></span>
                    </div>
                </div>
            </div>
            <div class="py-3 row justify-content-center">
                <button type="button" id="create-payment-order" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Tạo mới</button>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/suggestion/func.js') }}"></script>
    <script src="{{ asset('assets/js/suggestion/payment-order.js') }}"></script>
@endpush

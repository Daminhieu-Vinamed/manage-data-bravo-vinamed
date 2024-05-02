@extends('layout.master')
@section('title', 'Tạo mới')
@section('title-manage')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">QUẢN LÝ ĐỀ NGHỊ THANH TOÁN</h1>
    </div>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary text-center">Tạo mới đề nghị thanh toán cho {{ request()->get('company') }}</h6>
            <div class="input-group input-group-sm col-md-2 p-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Ngày tạo</span>
                </div>
                <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="prepaid_to_ncc" class="form-label small">Đã trả trước cho NCC</label>
                    <input type="number" class="form-control" name="prepaid_to_ncc" id="prepaid_to_ncc">
                </div>
                <div class="form-group col-md-4">
                    <label for="requests_for_advances" class="form-label small">Đề nghị tạm ứng</label>
                    <input list="list_requests_for_advances" class="form-control" name="requests_for_advances"
                        id="requests_for_advances">
                    <datalist id="list_requests_for_advances">
                        @foreach ($data['requests_for_advances'] as $item)
                            <option data-value="{{ $item->Stt }}" value="{{ $item->Stt }}">
                                {{ $item->DocNo . ' - ' . $item->TotalAmount0 . ' - ' . $item->CustomerName . ' - ' . $item->DocDate }}
                            </option>
                        @endforeach
                    </datalist>
                </div>
                <div class="form-group col-md-4">
                    <label for="advance_has_been_made" class="form-label small">Đã tạm ứng</label>
                    <input type="number" class="form-control" name="advance_has_been_made" id="advance_has_been_made">
                </div>
                <div class="form-group col-md-4">
                    <label for="payments" class="form-label small">Hình thức thanh toán</label>
                    <select class="custom-select" name="payments" id="payments">
                        <option value="CK">Chuyển khoản</option>
                        <option value="TM">Tiền mặt</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="currency" class="form-label small">Loại tiền</label>
                    <select class="custom-select" name="currency" id="currency">
                        @foreach ($data['currency'] as $item)
                            <option value="{{ $item->Code }}"
                                {{ $item->Code === 'VND' ? 'selected' : config('constants.value.empty') }}>
                                {{ $item->Code . ' - ' . $item->Name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="accounting_exchange_rate" class="form-label small">Tỷ giá hạch toán</label>
                    <input type="number" class="form-control" name="accounting_exchange_rate" id="accounting_exchange_rate"
                        disabled>
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
                                <input type="text" class="form-control" name="bill_number[]" id="bill_number">
                            </td>
                            <td>
                                <input type="date" class="form-control" name="bill_date[]" id="bill_date">
                            </td>
                            <td>
                                <textarea class="form-control" maxlength="255" name="bill_description[]" id="bill_description"></textarea>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="bill_some_declarations[]"
                                    id="bill_some_declarations">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="bill_waybill_number[]"
                                    id="bill_waybill_number">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="bill_weight[]" id="bill_weight">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="bill_weight_unit[]" id="bill_weight_unit">
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
                                <input list="list_base_items" class="form-control" name="base_items[]" id="base_items">
                                <datalist id="list_base_items">
                                    @foreach ($data['base_items'] as $item)
                                        <option data-value="{{ $item->Code }}" value="{{ $item->Code }}">
                                            {{ $item->Name }}</option>
                                    @endforeach
                            </td>
                            <td>
                                <input list="list_bill_staff" class="form-control" name="bill_staff[]" id="bill_staff">
                                <datalist id="list_bill_staff">
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
                                <input list="list_bill_part" class="form-control" name="bill_part[]" id="bill_part">
                                <datalist id="list_bill_part">
                                    @foreach ($data['bill_part'] as $item)
                                        <option data-value="{{ $item->Code }}" value="{{ $item->Code }}">
                                            {{ $item->Name2 }}</option>
                                    @endforeach
                                </datalist>
                            </td>
                            <td>
                                <input list="list_bill_purchase_order" class="form-control" name="bill_purchase_order[]"
                                    id="bill_purchase_order">
                                <datalist id="list_bill_purchase_order">
                                    @foreach ($data['bill_purchase_order'] as $item)
                                        <option data-value="{{ $item->BizDocId }}" value="{{ $item->BizDocId }}">
                                            {{ $item->DocInfo . ' - ' . date('d-m-Y', strtotime($item->DocDate)) . ' - ' . $item->EmployeeName }}
                                        </option>
                                    @endforeach
                                </datalist>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="bill_distributor[]"
                                    id="bill_distributor">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="bill_tax_money_multi1[]"
                                    id="bill_tax_money_multi1">
                            </td>
                            <td>
                                <label for="bill_tax_category" class="form-label small">Loại</label>
                                <input list="list_bill_tax_category" class="form-control" name="bill_tax_category[]"
                                    id="bill_tax_category">
                                <datalist id="list_bill_tax_category">
                                    @foreach ($data['bill_tax_category'] as $item)
                                        <option percent="{{ $item->Rate }}" data-value="{{ $item->Code }}"
                                            value="{{ $item->Code }}">
                                            {{ $item->Name . ' - ' . $item->Name2 . ' - ' . $item->Account }}</option>
                                    @endforeach
                                </datalist>
                            </td>
                            <td>
                                <label for="bill_tax_percent" class="form-label small">%</label>
                                <input type="number" class="form-control" name="bill_tax_percent[]" disabled
                                    id="bill_tax_percent">
                            </td>
                            <td>
                                <label for="bill_tax_money_vnd" class="form-label small">Tiền VND</label>
                                <input type="number" class="form-control" name="bill_tax_money_vnd[]"
                                    id="bill_tax_money_vnd" disabled>
                            </td>
                            <td>
                                <textarea class="form-control" maxlength="255" name="bill_note[]" id="bill_note"></textarea>
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
                    <input type="number" class="form-control" name="into_money1" id="into_money1" disabled>
                </div>
                <div class="form-group col-md-4 form-group-tax-money">
                    <label for="tax_money" class="form-label small">Tiền VAT</label>
                    <input type="number" class="form-control" name="tax_money1" id="tax_money1" disabled>
                </div>
                <div class="form-group col-md-4 form-group-total">
                    <label for="total_money1" class="form-label small">Tổng cộng</label>
                    <input type="number" class="form-control" name="total_money1" id="total_money1" disabled>
                </div>
            </div>
            <div class="py-3 row justify-content-center">
                <h6 class="h6 mb-0 font-weight-bold text-primary">Thông tin ngân hàng</h6>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="bank_name" class="form-label small">Tên ngân hàng</label>
                    <input type="text" class="form-control" name="bank_name" id="bank_name">
                </div>
                <div class="form-group col-md-4">
                    <label for="bank_number" class="form-label small">Số tài khoản</label>
                    <input type="text" class="form-control" name="bank_number" id="bank_number">
                </div>
                <div class="form-group col-md-4">
                    <label for="bank_person_name" class="form-label small">Tên chủ tài khoản</label>
                    <input type="text" class="form-control" name="bank_person_name" id="bank_person_name">
                </div>
                <div class="form-group col-md-12">
                    <label for="bank_description" class="form-label small">Nội dung</label>
                    <textarea class="form-control" name="bank_description" id="bank_description"></textarea>
                </div>
            </div>
            <div class="py-3 row justify-content-center">
                <button class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" id="add-row">TẠO MỚI</button>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/payment-order/func.js') }}"></script>
    <script src="{{ asset('assets/js/payment-order/create.js') }}"></script>
@endpush

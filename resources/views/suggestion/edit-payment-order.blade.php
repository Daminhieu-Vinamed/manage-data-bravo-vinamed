@extends('layout.master')
@section('title', 'Chỉnh sửa')
@section('title-manage')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">QUẢN LÝ ĐỀ NGHỊ</h1>
    </div>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary text-center">Chỉnh sửa đề nghị thanh toán cho {{ request()->get('company') }}</h6>
            <div class="input-group input-group-sm col-md-3 p-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Ngày tạo</span>
                </div>
                <input type="date" class="form-control" id="DocDate" value="{{ date('Y-m-d', strtotime($data['payment_order']->DocDate)) }}">
            </div>
            <div class="input-group input-group-sm col-md-3 p-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Số chứng từ</span>
                </div>
                <input type="text" class="form-control" id="DocNo" value="{{ $data['payment_order']->DocNo }}" readonly>
            </div>
        </div>
        <input type="hidden" value="{{ request()->get('company') }}" id="company">
        <input type="hidden" value="{{ request()->get('DocCode') }}" id="DocCode">
        <input type="hidden" value="{{ $data['payment_order']->Id }}" id="IdPO">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="EmployeeCode" class="form-label small">Người đề nghị</label>
                    <input list="listEmployeeCode" class="form-control" id="EmployeeCode" data-value="{{ $data['payment_order_detail'][config('constants.number.zero')]->EmployeeCode }}">
                    <datalist id="listEmployeeCode">
                        @foreach ($data['bill_staff'] as $item)
                            <option data-value="{{ $item->Code }}" value="{{ $item->Code . ": " . $item->Name }}">{{ $item->Email }}</option>
                        @endforeach
                    </datalist>
                    <span class="text-danger small" id="EmployeeCode_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="CustomerCode1" class="form-label small">Nhà cung cấp/Người nhận</label>
                    <input list="listCustomerCode1" class="form-control" id="CustomerCode1" data-value="{{ $data['payment_order']->CustomerCode }}">
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
                    <input type="number" class="form-control" id="AmountTT" value="{{ number_format($data['payment_order']->AmountTT, config('constants.number.zero'), '.', '') }}">
                    <span class="text-danger small" id="AmountTT_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="Stt_TU" class="form-label small">Đề nghị tạm ứng</label>
                    <input list="list_Stt_TU" class="form-control" id="Stt_TU" data-value="{{ $data['payment_order']->Stt_TU }}">
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
                    <input type="number" class="form-control" id="AmountTU" value="{{ number_format($data['payment_order']->AmountTU, config('constants.number.zero'), '.', '') }}">
                    <span class="text-danger small" id="AmountTU_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="Hinh_Thuc_TT" class="form-label small">Hình thức thanh toán</label>
                    <select class="custom-select" id="Hinh_Thuc_TT">
                        <option value="TM" {{ $data['payment_order']->Hinh_Thuc_TT == "TM" ? 'selected' : config('constants.value.empty') }}>Tiền mặt</option>
                        <option value="CK" {{ $data['payment_order']->Hinh_Thuc_TT == "CK" ? 'selected' : config('constants.value.empty') }}>Chuyển khoản</option>
                    </select>
                    <span class="text-danger small" id="Hinh_Thuc_TT_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="CurrencyCode" class="form-label small">Loại tiền</label>
                    <select class="custom-select" id="CurrencyCode">
                        @foreach ($data['currency'] as $item)
                            <option value="{{ $item->Code }}"{{ $data['payment_order']->CurrencyCode === $item->Code ? 'selected' : config('constants.value.empty') }}>{{ $item->Name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger small" id="CurrencyCode_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="ExchangeRate" class="form-label small">Tỷ giá hạch toán</label>
                    <input type="number" class="form-control" id="ExchangeRate" value="{{ number_format($data['payment_order']->ExchangeRate, config('constants.number.zero'), '.', '') }}" readonly>
                    <span class="text-danger small" id="ExchangeRate_error"></span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="table-payment-order" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            @if ($data['payment_order_detail']->count() > config('constants.number.one'))
                                <th id="th-action">Hành động</th>
                            @endif
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
                            <th id="th_OriginalAmount9">Giá trị {{ $data['payment_order']->CurrencyCode }} chưa VAT</th>
                            @if ($data['payment_order']->CurrencyCode != 'VND')
                                <th id="th_Amount9">Tiền VND</th>
                            @endif
                            <th colspan="{{ $data['payment_order']->CurrencyCode == 'VND' ? config('constants.number.three') : config('constants.number.four') }}" id="th_value_added_tax_vat">Thuế giá trị gia tăng (VAT)</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['payment_order_detail'] as $key => $value)
                            <tr id="line-{{$key}}">
                                <input type="hidden" name="IdPODetail[]" value="{{ $value->Id }}">
                                @if (isset($data['payment_order_detail_VAT'][$key]))
                                    <input type="hidden" name="IdPODetailVAT[]" value="{{ $data['payment_order_detail_VAT'][$key]->Id }}">
                                @endif
                                @if ($data['payment_order_detail']->count() > config('constants.number.one'))
                                    @if ($key == config('constants.number.zero'))
                                        <td></td>
                                    @else
                                        <td>
                                            <button class="btn btn-danger btn-circle" id="delete-line" type="button">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>
                                    @endif
                                @endif
                                <td>
                                    <input type="text" class="form-control So_Hd" name="So_Hd[]" value="{{ $value->So_Hd }}">
                                    <span class="text-danger small" id="So_Hd_error"></span>
                                </td>
                                <td>
                                    <input type="date" class="form-control Ngay_Hd" name="Ngay_Hd[]" value="{{ empty($value->Ngay_Hd) ? config('constants.value.null') : date('Y-m-d', strtotime($value->Ngay_Hd)) }}">
                                    <span class="text-danger small" id="Ngay_Hd_error"></span>
                                </td>
                                <td>
                                    <textarea class="form-control Description" maxlength="255" name="Description[]">{{ $value->Description }}</textarea>
                                </td>
                                <td>
                                    <input type="text" class="form-control Invoice" name="Invoice[]" value="{{ $value->Invoice }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control So_Van_Don" name="So_Van_Don[]" value="{{ $value->So_Van_Don }}">
                                </td>
                                {{-- <td>
                                    <input type="number" class="form-control" name="Trong_Luong[]" id="Trong_Luong" value="0">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="DV_Trong_Luong[]" id="DV_Trong_Luong">
                                </td> --}}
                                <td>
                                    <input list="listCustomerCode2" class="form-control CustomerCode2" name="CustomerCode2[]" value="{{ $value->CustomerCode }}">
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
                                    <input list="listExpenseCatgCode" class="form-control ExpenseCatgCode" name="ExpenseCatgCode[]" value="{{ $value->ExpenseCatgCode }}">
                                    <datalist id="listExpenseCatgCode">
                                        @foreach ($data['base_items'] as $item)
                                            <option data-value="{{ $item->Code }}" value="{{ $item->Code }}">
                                                {{ $item->Name }}</option>
                                        @endforeach
                                    </datalist>
                                </td>
                                <td>
                                    <input list="listEmployeeCode1" class="form-control EmployeeCode1" name="EmployeeCode1[]" value="{{ $value->EmployeeCode1 }}">
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
                                    <input list="listDeptCode" class="form-control DeptCode" name="DeptCode[]" value="{{ $value->DeptCode }}">
                                    <datalist id="listDeptCode">
                                        @foreach ($data['bill_part'] as $item)
                                            <option data-value="{{ $item->Code }}" value="{{ $item->Code }}">
                                                {{ $item->Name2 }}</option>
                                        @endforeach
                                    </datalist>
                                </td>
                                <td>
                                    <input list="list_BizDocId_PO" class="form-control BizDocId_PO" name="BizDocId_PO[]" value="{{ $value->BizDocId_PO }}">
                                    <datalist id="list_BizDocId_PO">
                                        @foreach ($data['bill_purchase_order'] as $item)
                                            <option data-value="{{ $item->BizDocId }}" value="{{ $item->BizDocId }}">
                                                {{ $item->DocInfo . ' - ' . date('d-m-Y', strtotime($item->DocDate)) . ' - ' . $item->EmployeeName }}
                                            </option>
                                        @endforeach
                                    </datalist>
                                </td>
                                <td>
                                    <input type="text" class="form-control Hang_SX" name="Hang_SX[]" value="{{ $value->Hang_SX }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="OriginalAmount9[]" id="OriginalAmount9" value="{{ number_format($value->OriginalAmount9, config('constants.number.zero'), '.', '') }}">
                                </td>
                                @if ($data['payment_order']->CurrencyCode != 'VND')
                                    <td id="td_Amount9">
                                        <input type="number" class="form-control" name="Amount9[]" id="Amount9" value="{{ number_format($value->Amount9, config('constants.number.zero'), '.', '') }}" readonly>
                                    </td>
                                @endif
                                <td>
                                    <label for="TaxCode" class="form-label small">Loại</label>
                                    <input list="listTaxCode" class="form-control TaxCode" name="TaxCode[]" value="{{ isset($data['payment_order_detail_VAT'][$key]) ? $data['payment_order_detail_VAT'][$key]->TaxCode : config('constants.value.empty') }}">
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
                                    <input type="number" class="form-control" name="TaxRate[]" id="TaxRate" percent="{{ isset($data['payment_order_detail_VAT'][$key]) ? $data['payment_order_detail_VAT'][$key]->TaxRate : config('constants.value.empty') }}" value="{{ isset($data['payment_order_detail_VAT'][$key]) ? number_format($data['payment_order_detail_VAT'][$key]->TaxRate * config('constants.number.one_hundred'), config('constants.number.zero')) : config('constants.value.empty') }}" readonly>
                                </td>
                                <td>
                                    <label for="OriginalAmount3" class="form-label small">Tiền {{ $data['payment_order']->CurrencyCode }}</label>
                                    <input type="text" class="form-control" name="OriginalAmount3[]" id="OriginalAmount3" value="{{ isset($data['payment_order_detail_VAT'][$key]) ? number_format($data['payment_order_detail_VAT'][$key]->OriginalAmount, config('constants.number.zero'), '.', '') : config('constants.value.empty') }}" readonly>
                                </td>
                                @if ($data['payment_order']->CurrencyCode != 'VND')
                                    <td id="td_Amount3">
                                        <label for="Amount3" class="form-label small">Tiền VND</label>
                                        <input type="number" class="form-control" name="Amount3[]" id="Amount3" value="{{ isset($data['payment_order_detail_VAT'][$key]) ? number_format($data['payment_order_detail_VAT'][$key]->Amount, config('constants.number.zero'), '.', '') : config('constants.value.empty') }}" readonly>
                                    </td>
                                @endif
                                <td>
                                    <textarea class="form-control" maxlength="255" name="Note[]" id="Note">{{ $value->Note }}</textarea>
                                </td>
                            </tr>                       
                        @endforeach
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
                        <input type="text" class="form-control" id="TotalOriginalAmount0" value="{{ number_format($data['payment_order']->TotalOriginalAmount0, config('constants.number.zero'), '.', '') }}" readonly>
                        <span class="text-danger small" id="TotalOriginalAmount0_error"></span>
                    </div>
                    @if ($data['payment_order']->CurrencyCode != 'VND')
                        <div class="form-group">
                            <input type="text" class="form-control mt-2" id="TotalAmount0" value="{{ number_format($data['payment_order']->TotalAmount0, config('constants.number.zero'), '.', '') }}" readonly>
                            <span class="text-danger small" id="TotalAmount0_error"></span>
                        </div>
                    @endif
                </div>
                <div class="col-md-4 form-group-tax-money">
                    <div class="form-group">
                        <label for="tax_money" class="form-label small">Tiền VAT</label>
                        <input type="text" class="form-control" id="TotalOriginalAmount3" value="{{ number_format($data['payment_order']->TotalOriginalAmount3, config('constants.number.zero'), '.', '') }}" readonly>
                        <span class="text-danger small" id="TotalOriginalAmount3_error"></span>
                    </div>
                    @if ($data['payment_order']->CurrencyCode != 'VND')
                        <div class="form-group">
                            <input type="text" class="form-control mt-2" id="TotalAmount3" value="{{ number_format($data['payment_order']->TotalAmount3, config('constants.number.zero'), '.', '') }}" readonly>
                            <span class="text-danger small" id="TotalAmount3_error"></span>
                        </div>
                    @endif
                </div>
                <div class="col-md-4 form-group-total">
                    <div class="form-group">
                        <label for="TotalOriginalAmount" class="form-label small">Tổng cộng</label>
                        <input type="text" class="form-control" id="TotalOriginalAmount" value="{{ number_format($data['payment_order']->TotalOriginalAmount, config('constants.number.zero'), '.', '') }}" readonly>
                        <span class="text-danger small" id="TotalOriginalAmount_error"></span>
                    </div>
                    @if ($data['payment_order']->CurrencyCode != 'VND')
                        <div class="form-group">
                            <input type="text" class="form-control mt-2" id="TotalAmount" value="{{ number_format($data['payment_order']->TotalAmount, config('constants.number.zero'), '.', '') }}" readonly>
                            <span class="text-danger small" id="TotalAmount_error"></span>
                        </div>
                    @endif
                </div>
            </div>
            @if ($data['payment_order']->Hinh_Thuc_TT == "CK")
                <div class="py-3 row justify-content-center text-info-bank">
                    <h6 class="h6 mb-0 font-weight-bold text-primary">Thông tin ngân hàng</h6>
                </div>
                <div class="row row-info-bank">
                    <div class="form-group col-md-4">
                        <label for="BankName" class="form-label small">Tên ngân hàng</label>
                        <input type="text" class="form-control" id="BankName" value="{{ $data['payment_order']->BankName }}">
                        <span class="text-danger small" id="BankName_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="BankAccountNo" class="form-label small">Số tài khoản</label>
                        <input type="text" class="form-control" id="BankAccountNo" value="{{ $data['payment_order']->BankAccountNo }}">
                        <span class="text-danger small" id="BankAccountNo_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="Ten_Chu_TK" class="form-label small">Tên chủ tài khoản</label>
                        <input type="text" class="form-control" id="Ten_Chu_TK" value="{{ $data['payment_order']->Ten_Chu_TK }}">
                        <span class="text-danger small" id="Ten_Chu_TK_error"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="Description1" class="form-label small">Nội dung</label>
                        <textarea class="form-control" id="Description1">{{ $data['payment_order']->Description1 }}</textarea>
                        <span class="text-danger small" id="Description1_error"></span>
                    </div>
                </div>
            @endif
            <div class="py-3 row justify-content-center">
                <button type="button" id="update-payment-order" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">CẬP NHẬT</button>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/suggestion/func.js') }}"></script>
    <script src="{{ asset('assets/js/suggestion/edit-payment-order.js') }}"></script>
@endpush

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
            <h6 class="m-0 font-weight-bold text-primary text-center">Chỉnh sửa đề nghị tạm ứng cho {{ request()->get('company') }}</h6>
            <div class="input-group input-group-sm col-md-3 p-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Ngày tạo</span>
                </div>
                <input type="date" class="form-control" id="DocDate" value="{{ date('Y-m-d', strtotime($data['request_for_advances']->DocDate)) }}">
            </div>
            <div class="input-group input-group-sm col-md-3 p-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Số chứng từ</span>
                </div>
                <input type="text" class="form-control" id="DocNo" value="{{ $data['request_for_advances']->DocNo }}" readonly>
            </div>
        </div>
        <input type="hidden" value="{{ request()->get('company') }}" id="company">
        <input type="hidden" value="{{ request()->get('DocCode') }}" id="DocCode">
        <input type="hidden" value="{{ $data['request_for_advances']->Id }}" id="IdRFA">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="CustomerCode" class="form-label small">Người đề nghị</label>
                    <input list="listCustomerCode1" class="form-control" id="CustomerCode" data-value="{{ $data['request_for_advances']->CustomerCode }}">
                    <datalist id="listCustomerCode1">
                        @foreach ($data['B20Customer'] as $item)
                            <option data-value="{{ $item->Code }}" 
                                value="{{ $item->Code . ": " . $item->Name }}" 
                                BankAccountNo="{{ $item->BankAccountNo }}" 
                                BankName="{{ $item->BankName }}" 
                                Name="{{ $item->Name }}">
                                {{ $item->TaxRegNo }}
                            </option>
                        @endforeach
                    </datalist>
                    <span class="text-danger small" id="CustomerCode_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="Description" class="form-label small">Nội dung</label>
                    <textarea class="form-control" id="Description">{{ $data['request_for_advances']->Description }}</textarea>
                </div>
                <div class="form-group col-md-4">
                    <label for="Hinh_Thuc_TT" class="form-label small">Hình thức thanh toán</label>
                    <select class="custom-select" id="Hinh_Thuc_TT">
                        <option value="TM" {{ $data['request_for_advances']->Hinh_Thuc_TT == "TM" ? 'selected' : config('constants.value.empty') }}>Tiền mặt</option>
                        <option value="CK" {{ $data['request_for_advances']->Hinh_Thuc_TT == "CK" ? 'selected' : config('constants.value.empty') }}>Chuyển khoản</option>
                    </select>
                    <span class="text-danger small" id="Hinh_Thuc_TT_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="EmployeeCode" class="form-label small">Nhân viên</label>
                    <input list="listEmployeeCode" class="form-control" id="EmployeeCode" data-value="{{ $data['request_for_advances_detail'][config('constants.number.zero')]->EmployeeCode }}">
                    <datalist id="listEmployeeCode">
                        @foreach ($data['B20Employee'] as $item)
                            <option data-value="{{ $item->Code }}" value="{{ $item->Code . ": " . $item->Name }}">{{ $item->Email }}</option>
                        @endforeach
                    </datalist>
                    <span class="text-danger small" id="EmployeeCode_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="CurrencyCode" class="form-label small">Loại tiền</label>
                    <select class="custom-select" id="CurrencyCode">
                        @foreach ($data['B20Currency'] as $item)
                            <option value="{{ $item->Code }}" {{ $data['request_for_advances']->CurrencyCode === $item->Code ? 'selected' : config('constants.value.empty') }}>{{ $item->Code . ' - ' . $item->Name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger small" id="CurrencyCode_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="ExchangeRate" class="form-label small">Tỷ giá hạch toán</label>
                    <input type="number" class="form-control" id="ExchangeRate" value="{{ number_format($data['request_for_advances']->ExchangeRate, config('constants.number.zero'), '.', '') }}" readonly>
                    <span class="text-danger small" id="ExchangeRate_error"></span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="requests-for-advances" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            @if ($data['request_for_advances_detail']->count() > config('constants.number.one'))
                                <th id="th-action">Hành động</th>
                            @endif
                            <th>Nội dung</th>
                            <th>Người nhận tiền</th>
                            <th>Mục đích tạm ứng</th>
                            <th>Địa bàn</th>
                            <th id="th_OriginalAmount9">Giá trị {{ $data['request_for_advances']->CurrencyCode }}</th>
                            @if ($data['request_for_advances']->CurrencyCode != 'VND')
                                <th id="th_Amount9">Tiền VND</th>
                            @endif
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['request_for_advances_detail'] as $key => $value)
                            <tr id="line-{{$key}}">
                                <input type="hidden" name="IdRFADetail[]" value="{{ $value->Id }}">
                                @if ($data['request_for_advances_detail']->count() > config('constants.number.one'))
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
                                    <textarea class="form-control" maxlength="255" name="Description[]">{{ $value->Description }}</textarea>
                                </td>
                                <td>
                                    <input list="listCustomerCode2" class="form-control" name="CustomerCode[]" value="{{ $value->CustomerCode }}">
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
                                    <input list="listTemporaryCode" class="form-control" name="TemporaryCode[]" value="{{ $value->TemporaryCode }}">
                                    <datalist id="listTemporaryCode">
                                        @foreach ($data['vB20Temporary'] as $item)
                                            <option data-value="{{ $item->Code }}" value="{{ $item->Code }}">{{ $item->Name }}</option>
                                        @endforeach
                                    </datalist>
                                </td>
                                <td>
                                    <select class="custom-select" name="Area[]">
                                            <option selected disabled>Chọn</option>
                                            <option value="DN" {{ $value->Area == "DN" ? "selected" : config('constants.value.empty') }}>Đà Nẵng</option>
                                            <option value="HCM" {{ $value->Area == "HCM" ? "selected" : config('constants.value.empty') }}>Hồ Chí Minh</option>
                                            <option value="HN" {{ $value->Area == "HN" ? "selected" : config('constants.value.empty') }}>Hà Nội</option>
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control" maxlength="255" name="OriginalAmount9[]" value="{{ number_format($value->OriginalAmount9, config('constants.number.zero'), '.', '') }}"/>
                                </td>
                                @if ($data['request_for_advances']->CurrencyCode != 'VND')
                                    <td id="td_Amount9">
                                        <input type="number" class="form-control" name="Amount9[]" value="{{ number_format($value->Amount9, config('constants.number.zero'), '.', '') }}" readonly>
                                    </td>
                                @endif
                                <td>
                                    <textarea class="form-control" maxlength="255" name="Note[]">{{ $value->Note }}</textarea>
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
                <div class="col-md-4"></div>
                <div class="col-md-4 form-group-total">
                    <div class="form-group">
                        <label for="TotalOriginalAmount" class="form-label small">Tổng cộng</label>
                        <input type="number" class="form-control" id="TotalOriginalAmount" value="{{ number_format($data['request_for_advances']->TotalOriginalAmount, config('constants.number.zero'), '.', '') }}" readonly>
                        <span class="text-danger small" id="TotalOriginalAmount_error"></span>
                    </div>
                    @if ($data['request_for_advances']->CurrencyCode != 'VND')
                        <div class="form-group">
                            <input type="text" class="form-control mt-2" id="TotalAmount" value="{{ number_format($data['request_for_advances']->TotalAmount, config('constants.number.zero'), '.', '') }}" readonly>
                            <span class="text-danger small" id="TotalAmount_error"></span>
                        </div>
                    @endif
                </div>
                <div class="col-md-4"></div>
            </div>
            @if ($data['request_for_advances']->Hinh_Thuc_TT == "CK")
            <div class="py-3 row justify-content-center text-info-bank">
                <h6 class="h6 mb-0 font-weight-bold text-primary">Thông tin ngân hàng</h6>
            </div>
            <div class="row row-info-bank">
                <div class="form-group col-md-4">
                    <label for="BankName" class="form-label small">Tên ngân hàng</label>
                    <input type="text" class="form-control" id="BankName" value="{{ $data['request_for_advances']->BankName }}">
                    <span class="text-danger small" id="BankName_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="BankAccountNo" class="form-label small">Số tài khoản</label>
                    <input type="text" class="form-control" id="BankAccountNo" value="{{ $data['request_for_advances']->BankAccountNo }}">
                    <span class="text-danger small" id="BankAccountNo_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="Ten_Chu_TK" class="form-label small">Tên chủ tài khoản</label>
                    <input type="text" class="form-control" id="Ten_Chu_TK" value="{{ $data['request_for_advances']->Ten_Chu_TK }}">
                    <span class="text-danger small" id="Ten_Chu_TK_error"></span>
                </div>
                <div class="form-group col-md-12">
                    <label for="Description1" class="form-label small">Nội dung</label>
                    <textarea class="form-control" id="Description1">{{ $data['request_for_advances']->Description1 }}</textarea>
                    <span class="text-danger small" id="Description1_error"></span>
                </div>
            </div>
        @endif
            <div class="py-3 row justify-content-center">
                <button type="button" id="edit-requests-for-advances" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">CẬP NHẬT</button>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/suggestion/func.js') }}"></script>
    <script src="{{ asset('assets/js/suggestion/edit-requests-for-advances.js') }}"></script>
@endpush

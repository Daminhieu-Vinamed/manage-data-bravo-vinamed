$(document).ready(function () {
    $("#ExchangeRate").val(oneConst);
    const docNo = $("#DocNo").val();
    const numberLastBefore = parseInt(docNo.slice(docNo.lastIndexOf(".") + oneConst));
    const lengthDocNoBefore = docNo.slice(docNo.lastIndexOf(".") + oneConst).length;
    var numberLastAfter = (numberLastBefore + oneConst).toString();
    for (let index = zeroConst; index < lengthDocNoBefore; index++) {    
        if (numberLastAfter.length < lengthDocNoBefore) {
            numberLastAfter = "0" + numberLastAfter
        }
    }
    let firstDotIndex = docNo.indexOf(".");
    if (firstDotIndex !== -oneConst) {
        let secondDotIndex = docNo.indexOf(".", firstDotIndex + oneConst);
        if (secondDotIndex !== -oneConst) {
            const sliced2 = docNo.substring(zeroConst, secondDotIndex);
            const docNoNew = sliced2 + "." + numberLastAfter;
            $("#DocNo").val(docNoNew);
        }
    }

    $(document).on("change", "#CurrencyCode", function () {
        const valueCurrency = $(this).val();
        $("#th_OriginalAmount9").text("Giá trị " + valueCurrency);
        if (valueCurrency !== "VND") {
            $("#ExchangeRate").val(zeroConst).removeAttr("readonly");
            $("thead tr #th_OriginalAmount9").after(
                '<th id="th_Amount9">Tiền VND</th>'
            );
            $("tbody tr #OriginalAmount9").parent().after(`<td id="td_Amount9">
                <input type="number" class="form-control" name="Amount9[]" readonly/>
            </td>`);
            $(".form-group-total #TotalOriginalAmount").after('<input type="number" class="form-control mt-2" id="TotalAmount" readonly>');
        } else if (valueCurrency === "VND") {
            $("#ExchangeRate").val(oneConst).attr("readonly", trueValue);
            $("thead tr #th_Amount9, tbody tr #td_Amount9, .form-group-total #TotalAmount").remove();
        }
    });

    $(document).on("change keyup paste", "#OriginalAmount9, #ExchangeRate", function () {
        total_requests_for_advances();
    });

    $(document).on("blur", "#CustomerCode1", function () {
        const valueSelected = $(this).val();
        var CustomerCode = $(this).val(nullValue);
        $(this)
            .next("#listCustomerCode1")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    if ($('#Ten_Chu_TK').length) {
                        $('#Ten_Chu_TK').val($($(this)[zeroConst]).attr("name"));
                    }
                    if ($('#BankName').length) {
                        $('#BankName').val($($(this)[zeroConst]).attr("BankName"));
                    }
                    if ($('#BankAccountNo').length) {
                        $('#BankAccountNo').val($($(this)[zeroConst]).attr("BankAccountNo"));
                    }
                    return CustomerCode.val(valueSelected);
                }
            });
    });

    $(document).on("change", "#Hinh_Thuc_TT", function () {
        const value_Hinh_Thuc_TT = $(this).val();
        const row_total_money = $('.row-total-money');
        if (value_Hinh_Thuc_TT === "CK") {
            row_total_money.after(`<div class="py-3 row justify-content-center text-info-bank">
                <h6 class="h6 mb-0 font-weight-bold text-primary">Thông tin ngân hàng</h6>
            </div>
            <div class="row row-info-bank">
                <div class="form-group col-md-4">
                    <label for="BankName" class="form-label small">Tên ngân hàng</label>
                    <input type="text" class="form-control" id="BankName">
                    <span class="text-danger small" id="BankName_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="BankAccountNo" class="form-label small">Số tài khoản</label>
                    <input type="text" class="form-control" id="BankAccountNo">
                    <span class="text-danger small" id="BankAccountNo_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="Ten_Chu_TK" class="form-label small">Tên chủ tài khoản</label>
                    <input type="text" class="form-control" id="Ten_Chu_TK">
                    <span class="text-danger small" id="Ten_Chu_TK_error"></span>
                </div>
                <div class="form-group col-md-12">
                    <label for="Description1" class="form-label small">Nội dung</label>
                    <textarea class="form-control" id="Description1"></textarea>
                    <span class="text-danger small" id="Description1_error"></span>
                </div>
            </div>`);
        }else{
            $('.text-info-bank').remove();
            $('.row-info-bank').remove();
        }
    });

    $(document).on("click", "#add-row", function () {
        $trClone = $("tbody tr:last").clone();
        const rowCount = $('tbody tr').length;
        $trNew = $trClone.attr("id", "line-" + rowCount);
        if (!$("#th-action").length) {
            $("tbody tr:first").children("td:first").before("<td></td>");
            $trNew.children("td:first").before(`<td>
                <button class="btn btn-danger btn-circle" id="delete-line" type="button">
                    <i class="fas fa-times"></i>
                </button>
            </td>`);
            $("thead tr th:first").before('<th id="th-action">Hành động</th>');
        }
        $trNew.appendTo("tbody");
        total_requests_for_advances();
    });

    $(document).on("click", "#delete-line", function () {
        $(this).parents("tr").remove();
        const rowCount = $('tbody tr').length;
        for (let index = zeroConst; index <= rowCount; index++) {
            $('tbody tr:eq('+ index +')').removeAttr('id').attr('id', "line-" + index);
            
        }
        if (!$("#delete-line").length) {
            $("tbody tr:first").children("td:first").remove();
            $("#th-action").remove();
        }
        total_requests_for_advances();
    });

    $(document).on("click", "#create-requests-for-advances", function () {
        const CountRow = $('#requests-for-advances > tbody > tr').length;
        const DocDate = $("#DocDate").val();
        const DocNo = $("#DocNo").val();
        const BranchCode = $("#company").val();
        const DocCode = $("#DocCode").val();
        const DocStatus = 40;
        const CustomerCode = $("#CustomerCode").val();
        const Description = $("#Description").val();
        const Hinh_Thuc_TT = $("#Hinh_Thuc_TT").val();
        const EmployeeCode = $("#EmployeeCode").val();
        const CurrencyCode = $("#CurrencyCode").val();
        const ExchangeRate = $("#ExchangeRate").val();

        const DescriptionDetail = $("textarea[name='Description[]']").map(function () { return $(this).val() }).get();
        const CustomerCodeDetail = $("input[name='CustomerCode[]']").map(function () { return $(this).val() }).get();
        const TemporaryCode = $("input[name='TemporaryCode[]']").map(function () { return $(this).val() }).get();
        const Area = $("select[name='Area[]']").map(function () { return $(this).val() }).get();
        const OriginalAmount9 = $("input[name='OriginalAmount9[]']").map(function () { return $(this).val() }).get();
        const Amount9 = $("input[name='Amount9[]']").map(function () { return $(this).val() }).get();
        const Note = $("textarea[name='Note[]']").map(function () { return $(this).val() }).get();

        const TotalOriginalAmount = $("#TotalOriginalAmount").val();
        const TotalAmount = $("#TotalAmount").val();
        const BankName = $("#BankName").val();
        const BankAccountNo = $("#BankAccountNo").val();
        const Ten_Chu_TK = $("#Ten_Chu_TK").val();
        const Description1 = $("#Description1").val();
        $.ajax({
            url: linkSuggestion + "create-requests-for-advances",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                CountRow: CountRow,
                DocDate: DocDate,
                DocNo: DocNo,
                BranchCode: BranchCode,
                DocStatus: DocStatus,
                DocCode: DocCode,
                CustomerCode: CustomerCode,
                Description: Description,
                Hinh_Thuc_TT: Hinh_Thuc_TT,
                EmployeeCode: EmployeeCode,
                CurrencyCode: CurrencyCode,
                ExchangeRate: ExchangeRate,
                DescriptionDetail: DescriptionDetail,
                CustomerCodeDetail: CustomerCodeDetail,
                TemporaryCode: TemporaryCode,
                Area: Area,
                OriginalAmount9: OriginalAmount9,
                Amount9: Amount9,
                Note: Note,
                TotalOriginalAmount: TotalOriginalAmount,
                TotalAmount: TotalAmount,
                BankName: BankName,
                BankAccountNo: BankAccountNo,
                Ten_Chu_TK: Ten_Chu_TK,
                Description1: Description1,
            },
            success: function (success) {
                console.log(success);
                // ToastSuccessCenterTime.fire({
                //     icon: success.status,
                //     title: success.msg,
                // }).then((result) => {
                //     console.log(result);
                //     if (result.dismiss === Swal.DismissReason.timer) {
                //         location.href = window.location.origin + '/suggestion';
                //     }
                // });
            },
            error: function (error) {
                let errors = error.responseJSON?.errors;
                if (error.responseJSON.status && error.responseJSON.msg) {
                    ToastErrorCenter.fire({
                        icon: error.responseJSON.status,
                        text: error.responseJSON.msg,
                        customClass: {
                            confirmButton: "btn btn-primary shadow-sm m-2",
                        },
                    });
                }
                for (let i = zeroConst; i <= Ngay_Hd.length; i++) {
                    errors['Ngay_Hd.'+ i] 
                    ? 
                    $('#line-' + i).find('#Ngay_Hd_error').html(errors['Ngay_Hd.'+ i][zeroConst]) 
                    : 
                    $('#line-' + i).find('#Ngay_Hd_error').html('')
                }
                if (errors.DocDate) {
                    ToastTopRight.fire({
                        icon: 'error',
                        title: errors.DocDate[zeroConst],
                    });
                    $("#DocDate").removeClass('is-valid').addClass('is-invalid');
                } else {
                    $("#DocDate").removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.DocNo) {
                    ToastTopRight.fire({
                        icon: 'error',
                        title: errors.DocNo[zeroConst],
                    })
                    $("#DocNo").removeClass('is-valid').addClass('is-invalid');
                } else {
                    $("#DocNo").removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.EmployeeCode) {
                    $('#EmployeeCode_error').text(errors.EmployeeCode[zeroConst]);
                    $('#EmployeeCode').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#EmployeeCode_error').text('');
                    $('#EmployeeCode').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.CustomerCode1) {
                    $('#CustomerCode1_error').text(errors.CustomerCode1[zeroConst]);
                    $('#CustomerCode1').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#CustomerCode1_error').text('');
                    $('#CustomerCode1').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.AmountTT) {
                    $('#AmountTT_error').text(errors.AmountTT[zeroConst]);
                    $('#AmountTT').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#AmountTT_error').text('');
                    $('#AmountTT').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.Stt_TU) {
                    $('#Stt_TU_error').text(errors.Stt_TU[zeroConst]);
                    $('#Stt_TU').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#Stt_TU_error').text('');
                    $('#Stt_TU').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.AmountTU) {
                    $('#AmountTU_error').text(errors.AmountTU[zeroConst]);
                    $('#AmountTU').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#AmountTU_error').text('');
                    $('#AmountTU').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.Hinh_Thuc_TT) {
                    $('#Hinh_Thuc_TT_error').text(errors.Hinh_Thuc_TT[zeroConst]);
                    $('#Hinh_Thuc_TT').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#Hinh_Thuc_TT_error').text('');
                    $('#Hinh_Thuc_TT').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.BankName) {
                    $('#BankName_error').text(errors.BankName[zeroConst]);
                    $('#BankName').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#BankName_error').text('');
                    $('#BankName').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.BankAccountNo) {
                    $('#BankAccountNo_error').text(errors.BankAccountNo[zeroConst]);
                    $('#BankAccountNo').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#BankAccountNo_error').text('');
                    $('#BankAccountNo').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.Ten_Chu_TK) {
                    $('#Ten_Chu_TK_error').text(errors.Ten_Chu_TK[zeroConst]);
                    $('#Ten_Chu_TK').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#Ten_Chu_TK_error').text('');
                    $('#Ten_Chu_TK').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.Description1) {
                    $('#Description1_error').text(errors.Description1[zeroConst]);
                    $('#Description1').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#Description1_error').text('');
                    $('#Description1').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.TotalOriginalAmount0) {
                    $('#TotalOriginalAmount0_error').text(errors.TotalOriginalAmount0[zeroConst]);
                    $('#TotalOriginalAmount0').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#TotalOriginalAmount0_error').text('');
                    $('#TotalOriginalAmount0').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.TotalAmount0) {
                    $('#TotalOriginalAmount0_error').text(errors.TotalAmount0[zeroConst]);
                    $('#TotalAmount0').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#TotalOriginalAmount0_error').text('');
                    $('#TotalAmount0').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.TotalOriginalAmount3) {
                    $('#TotalOriginalAmount3_error').text(errors.TotalOriginalAmount3[zeroConst]);
                    $('#TotalOriginalAmount3').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#TotalOriginalAmount3_error').text('');
                    $('#TotalOriginalAmount3').removeClass('is-invalid').addClass('is-valid');
                    $('#TotalAmount3').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.TotalAmount3) {
                    $('#TotalOriginalAmount3_error').text(errors.TotalAmount3[zeroConst]);
                    $('#TotalAmount3').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#TotalOriginalAmount3_error').text('');
                    $('#TotalAmount3').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.TotalOriginalAmount) {
                    $('#TotalOriginalAmount_error').text(errors.TotalOriginalAmount[zeroConst]);
                    $('#TotalOriginalAmount').removeClass('is-valid').addClass('is-invalid');
                    $('#TotalAmount').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#TotalOriginalAmount_error').text('');
                    $('#TotalOriginalAmount').removeClass('is-invalid').addClass('is-valid');
                    $('#TotalAmount').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.TotalAmount) {
                    $('#TotalOriginalAmount_error').text(errors.TotalAmount[zeroConst]);
                    $('#TotalAmount').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#TotalOriginalAmount_error').text('');
                    $('#TotalAmount').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.CurrencyCode) {
                    $('#CurrencyCode_error').text(errors.CurrencyCode[zeroConst]);
                    $('#CurrencyCode').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#CurrencyCode_error').text('');
                    $('#CurrencyCode').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.ExchangeRate) {
                    $('#ExchangeRate_error').text(errors.ExchangeRate[zeroConst]);
                    $('#ExchangeRate').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#ExchangeRate_error').text('');
                    $('#ExchangeRate').removeClass('is-invalid').addClass('is-valid');
                }
            },
        });
    });
});
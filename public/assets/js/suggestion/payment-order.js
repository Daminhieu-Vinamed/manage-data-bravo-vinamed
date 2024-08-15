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
    $(document).on("change", "#CurrencyCode", function () {
        const valueCurrency = $(this).val();

        $("#th_OriginalAmount9").text("Giá trị " + valueCurrency + " chưa VAT");
        $('label[for="OriginalAmount3"]').text("Tiền " + valueCurrency);
        if (valueCurrency !== "VND") {
            if (!$("#th_Amount9").length) {
                $("#ExchangeRate").val(zeroConst).removeAttr("readonly");
                $("thead tr #th_OriginalAmount9").after(
                    '<th id="th_Amount9">Tiền VND</th>'
                );
                $("tbody tr #OriginalAmount9").parent().after(`<td id="td_Amount9">
                    <input type="number" class="form-control" name="Amount9[]" id="Amount9" readonly/>
                </td>`);
                $("tbody tr #OriginalAmount3").parent().after(`<td id="td_Amount3">
                    <label for="Amount3" class="form-label small">Tiền VND</label>
                    <input type="number" class="form-control" name="Amount3[]" id="Amount3" readonly/>
                </td>`);
                $("thead tr #th_value_added_tax_vat").attr("colspan", fourConst);
                $(".form-group-into-money").append(`
                    <div class="form-group">
                        <input type="number" class="form-control mt-2" id="TotalAmount0" readonly>
                        <span class="text-danger small" id="TotalAmount0_error"></span>
                    <div/>
                `);
                $(".form-group-tax-money").append(`
                    <div class="form-group">
                        <input type="number" class="form-control mt-2" id="TotalAmount3" readonly>
                        <span class="text-danger small" id="TotalAmount3_error"></span>
                    <div/>
                `);
                $(".form-group-total").append(`
                    <div class="form-group">
                        <input type="number" class="form-control mt-2" id="TotalAmount" readonly>
                        <span class="text-danger small" id="TotalAmount_error"></span>
                    <div/>
                `);
            }
        } else if (valueCurrency === "VND") {
            $("thead tr #th_value_added_tax_vat").attr("colspan", threeConst);
            $("#ExchangeRate").val(oneConst).attr("readonly", trueValue);
            $("thead tr #th_Amount9, tbody tr #td_Amount9, tbody tr #td_Amount3").remove();
            $(".form-group-into-money #TotalAmount0, .form-group-tax-money #TotalAmount3, .form-group-total #TotalAmount").remove();
        }
        total_payment_order();
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
        total_payment_order();
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
        total_payment_order();
    });

    $(document).on("blur", "#CustomerCode2", function () {
        const valueSelected = $(this).val();
        var CustomerCode2 = $(this).val(nullValue);
        $(this)
            .next("#listCustomerCode2")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    return CustomerCode2.val(valueSelected);
                }
            });
    });

    $(document).on("blur", "#EmployeeCode", function () {
        const valueSelected = $(this).val();
        var EmployeeCode = $(this).val(nullValue).removeAttr('data-value');
        $(this)
            .next("#listEmployeeCode")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    return EmployeeCode.val(valueSelected).attr("data-value", $(this).attr('data-value'));
                }
            });
    });

    $(document).on("blur", "#CustomerCode1", function () {
        const valueSelected = $(this).val();
        var CustomerCode = $(this).val(nullValue).removeAttr('data-value');
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
                    return CustomerCode.val(valueSelected).attr("data-value", $(this).attr('data-value'));
                }
            });
    });

    $(document).on("blur", "#EmployeeCode1", function () {
        const valueSelected = $(this).val();
        var EmployeeCode1 = $(this).val(nullValue);
        $(this)
            .next("#listEmployeeCode1")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    const trId = $(this).parents("tr").attr("id");
                    $("#" + trId)
                        .find("#DeptCode")
                        .val($(this).attr("department"));
                    return EmployeeCode1.val(valueSelected);
                }
            });
    });

    $(document).on("blur", "#Stt_TU", function () {
        const valueSelected = $(this).val();
        var Stt_TU = $(this).val(nullValue);
        $(this)
            .next("#list_Stt_TU")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    $('#AmountTU').val($(this).attr("TotalAmount0"));
                    return Stt_TU.val(valueSelected);
                }
            });
    });

    $(document).on("blur", "#ExpenseCatgCode", function () {
        const valueSelected = $(this).val();
        var thisExpenseCatgCode = $(this).val(nullValue);
        $(this)
            .next("#listExpenseCatgCode")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    return thisExpenseCatgCode.val(valueSelected);
                }
            });
    });

    $(document).on("blur", "#DeptCode", function () {
        const valueSelected = $(this).val();
        var DeptCode = $(this).val(nullValue);
        $(this)
            .next("#listDeptCode")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    return DeptCode.val(valueSelected);
                }
            });
    });

    $(document).on("change keyup paste", "#TaxCode", function () {
        const valueSelected = $(this).val();
        if (!valueSelected) {
            $(this).parents("tr").find("#TaxRate").val(nullValue);
            $(this).parents("tr").find("#OriginalAmount3").val(nullValue);
            $(this).parents("tr").find("#Amount3").val(nullValue)
        }
        var this_TaxCode = $(this).val(nullValue);
        $(this)
            .next("#listTaxCode")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    const percent = $(this).attr("percent");
                    const percentFormat = Math.ceil(percent * oneHundredConst);
                    const trId = $(this).parents("tr").attr("id");
                    vat_value_added_tax_calculation(percentFormat, percent, trId);
                    total_payment_order();
                    return this_TaxCode.val(valueSelected);
                }
            });
        total_payment_order();
    });

    $(document).on("blur", "#BizDocId_PO", function () {
        const valueSelected = $(this).val();
        var this_BizDocId_PO = $(this).val(nullValue);
        $(this)
            .next("#list_BizDocId_PO")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    return this_BizDocId_PO.val(valueSelected);
                }
            });
    });

    $(document).on("change keyup paste", "#OriginalAmount9", function () {
        const percentFormat = $(this).parents("tr").find("#TaxRate").val();
        const percent = $(this).parents("tr").find("#TaxRate").attr("percent");
        const trId = $(this).parents("tr").attr("id");
        vat_value_added_tax_calculation(percentFormat, percent, trId);
        total_payment_order();
    });

    $(document).on("change keyup paste", "#ExchangeRate", function () {
        if ($("#Amount9").length) {
            var TaxRate = $("input[name='TaxRate[]']")
                .map(function () {
                    return $(this).val();
                })
                .get();
            var Amount9 = $("input[name='Amount9[]']")
                .map(function () {
                    return $(this).val();
                })
                .get();
            var Amount3 = $("input[name='Amount3[]']");
            for (let i = zeroConst; i < TaxRate.length; i++) {
                Amount3[i].value = Amount9[i] * TaxRate[i];
            }
        }
        total_payment_order();
    });

    $(document).on("click", "#create-payment-order", function () {
        const CountRow = $('#table-payment-order > tbody > tr').length;
        const DocDate = $("#DocDate").val();
        const DocNo = $("#DocNo").val();
        const BranchCode = $("#company").val();
        const DocCode = $("#DocCode").val();
        const DocStatus = fortyFiveConst;
        const EmployeeCode = $("#EmployeeCode").attr('data-value');
        const CustomerCode1 = $("#CustomerCode1").attr('data-value');
        const AmountTT = $("#AmountTT").val();
        const Stt_TU = $("#Stt_TU").val();
        const AmountTU = $("#AmountTU").val();
        const Hinh_Thuc_TT = $("#Hinh_Thuc_TT").val();
        const CurrencyCode = $("#CurrencyCode").val();
        const ExchangeRate = $("#ExchangeRate").val();
        const TotalOriginalAmount0 = $("#TotalOriginalAmount0").val();
        const TotalOriginalAmount3 = $("#TotalOriginalAmount3").val();
        const TotalOriginalAmount = $("#TotalOriginalAmount").val();
        const So_Hd = $("input[name='So_Hd[]']").map(function () { return $(this).val() }).get();
        const Ngay_Hd = $("input[name='Ngay_Hd[]']").map(function () { return $(this).val() }).get();
        const Description = $("textarea[name='Description[]']").map(function () { return $(this).val() }).get();
        const Invoice = $("input[name='Invoice[]']").map(function () { return $(this).val() }).get();
        const So_Van_Don = $("input[name='So_Van_Don[]']").map(function () { return $(this).val() }).get();
        const Trong_Luong = $("input[name='Trong_Luong[]']").map(function () { return $(this).val() }).get();
        const DV_Trong_Luong = $("input[name='DV_Trong_Luong[]']").map(function () { return $(this).val() }).get();
        const CustomerCode2 = $("input[name='CustomerCode2[]']").map(function () { return $(this).val() }).get();
        const ExpenseCatgCode = $("input[name='ExpenseCatgCode[]']").map(function () { return $(this).val() }).get();
        const EmployeeCode1 = $("input[name='EmployeeCode1[]']").map(function () { return $(this).val() }).get();
        const DeptCode = $("input[name='DeptCode[]']").map(function () { return $(this).val() }).get();
        const BizDocId_PO = $("input[name='BizDocId_PO[]']").map(function () { return $(this).val() }).get();
        const Hang_SX = $("input[name='Hang_SX[]']").map(function () { return $(this).val() }).get();
        const OriginalAmount9 = $("input[name='OriginalAmount9[]']").map(function () { return $(this).val() }).get();
        const Amount9 = $("input[name='Amount9[]']").map(function () { return $(this).val() }).get();
        const TaxCode = $("input[name='TaxCode[]']").map(function () { return $(this).val() }).get();
        const TaxRate = $("input[name='TaxRate[]']").map(function () { return $(this).attr('percent') }).get();
        const Amount3 = $("input[name='Amount3[]']").map(function () { return $(this).val() }).get();
        const OriginalAmount3 = $("input[name='OriginalAmount3[]']").map(function () { return $(this).val() }).get();
        const Note = $("textarea[name='Note[]']").map(function () { return $(this).val() }).get();
        const TotalAmount0 = $("#TotalAmount0").val();
        const TotalAmount3 = $("#TotalAmount3").val();
        const TotalAmount = $("#TotalAmount").val();
        const BankName = $("#BankName").val();
        const BankAccountNo = $("#BankAccountNo").val();
        const Ten_Chu_TK = $("#Ten_Chu_TK").val();
        const Description1 = $("#Description1").val();

        $.ajax({
            url: linkSuggestion + "create-payment-order",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                CountRow: CountRow,
                DocDate: DocDate,
                DocNo: DocNo,
                BranchCode: BranchCode,
                DocCode: DocCode,
                DocStatus: DocStatus,
                EmployeeCode: EmployeeCode,
                CustomerCode1: CustomerCode1,
                AmountTT: AmountTT,
                Stt_TU: Stt_TU,
                AmountTU: AmountTU,
                Hinh_Thuc_TT: Hinh_Thuc_TT,
                CurrencyCode: CurrencyCode,
                ExchangeRate: ExchangeRate,
                So_Hd: So_Hd,
                Ngay_Hd: Ngay_Hd,
                Description: Description,
                Invoice: Invoice,
                So_Van_Don: So_Van_Don,
                Trong_Luong: Trong_Luong,
                DV_Trong_Luong: DV_Trong_Luong,
                CustomerCode2: CustomerCode2,
                ExpenseCatgCode: ExpenseCatgCode,
                EmployeeCode1: EmployeeCode1,
                DeptCode: DeptCode,
                BizDocId_PO: BizDocId_PO,
                Hang_SX: Hang_SX,
                OriginalAmount9: OriginalAmount9,
                Amount9: Amount9,
                TaxCode: TaxCode,
                TaxRate: TaxRate,
                Amount3: Amount3,
                OriginalAmount3: OriginalAmount3,
                Note: Note,
                TotalOriginalAmount0: TotalOriginalAmount0,
                TotalAmount0: TotalAmount0,
                TotalOriginalAmount3: TotalOriginalAmount3,
                TotalAmount3: TotalAmount3,
                TotalOriginalAmount: TotalOriginalAmount,
                TotalAmount: TotalAmount,
                BankName: BankName,
                BankAccountNo: BankAccountNo,
                Ten_Chu_TK: Ten_Chu_TK,
                Description1: Description1
            },
            success: function (success) {
                ToastSuccessCenterTime.fire({
                    icon: success.status,
                    title: success.msg,
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        location.href = window.location.origin + '/suggestion?DocCode=TT';
                    }
                });
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
                    if (errors['Ngay_Hd.'+ i]) {
                        $('#line-' + i).find('#Ngay_Hd_error').html(errors['Ngay_Hd.'+ i][zeroConst])
                        $('#line-' + i).find('#Ngay_Hd').addClass('is-invalid')
                    } else {
                        $('#line-' + i).find('#Ngay_Hd_error').html('')  
                        $('#line-' + i).find('#Ngay_Hd').removeClass('is-invalid')
                    } 
                    if (errors['So_Hd.'+ i]) {
                        $('#line-' + i).find('#So_Hd_error').html(errors['So_Hd.'+ i][zeroConst]) 
                        $('#line-' + i).find('#So_Hd').addClass('is-invalid')
                    } else {
                        $('#line-' + i).find('#So_Hd_error').html('')
                        $('#line-' + i).find('#So_Hd').removeClass('is-invalid')
                    }
                }
                if (errors.DocDate) {
                    ToastTopRight.fire({
                        icon: 'error',
                        title: errors.DocDate[zeroConst],
                    });
                    $("#DocDate").addClass('is-invalid');
                } else {
                    $("#DocDate").removeClass('is-invalid');
                }
                if (errors.DocNo) {
                    ToastTopRight.fire({
                        icon: 'error',
                        title: errors.DocNo[zeroConst],
                    })
                    $("#DocNo").addClass('is-invalid');
                } else {
                    $("#DocNo").removeClass('is-invalid');
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
                    $('#AmountTT').addClass('is-invalid');
                } else {
                    $('#AmountTT_error').text('');
                    $('#AmountTT').removeClass('is-invalid');
                }
                if (errors.Stt_TU) {
                    $('#Stt_TU_error').text(errors.Stt_TU[zeroConst]);
                    $('#Stt_TU').addClass('is-invalid');
                } else {
                    $('#Stt_TU_error').text('');
                    $('#Stt_TU').removeClass('is-invalid');
                }
                if (errors.AmountTU) {
                    $('#AmountTU_error').text(errors.AmountTU[zeroConst]);
                    $('#AmountTU').addClass('is-invalid');
                } else {
                    $('#AmountTU_error').text('');
                    $('#AmountTU').removeClass('is-invalid');
                }
                if (errors.Hinh_Thuc_TT) {
                    $('#Hinh_Thuc_TT_error').text(errors.Hinh_Thuc_TT[zeroConst]);
                    $('#Hinh_Thuc_TT').addClass('is-invalid');
                } else {
                    $('#Hinh_Thuc_TT_error').text('');
                    $('#Hinh_Thuc_TT').removeClass('is-invalid');
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
                    $('#TotalAmount0_error').text(errors.TotalAmount0[zeroConst]);
                    $('#TotalAmount0').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#TotalAmount0_error').text('');
                    $('#TotalAmount0').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.TotalOriginalAmount3) {
                    $('#TotalOriginalAmount3_error').text(errors.TotalOriginalAmount3[zeroConst]);
                    $('#TotalOriginalAmount3').addClass('is-invalid');
                } else {
                    $('#TotalOriginalAmount3_error').text('');
                    $('#TotalOriginalAmount3').removeClass('is-invalid');
                }
                if (errors.TotalAmount3) {
                    $('#TotalAmount3_error').text(errors.TotalAmount3[zeroConst]);
                    $('#TotalAmount3').addClass('is-invalid');
                } else {
                    $('#TotalAmount3_error').text('');
                    $('#TotalAmount3').removeClass('is-invalid');
                }
                if (errors.TotalOriginalAmount) {
                    $('#TotalAmount_error').text(errors.TotalOriginalAmount[zeroConst]);
                    $('#TotalOriginalAmount').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#TotalAmount_error').text('');
                    $('#TotalOriginalAmount').removeClass('is-invalid').addClass('is-valid');
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
                    $('#CurrencyCode').addClass('is-invalid');
                } else {
                    $('#CurrencyCode_error').text('');
                    $('#CurrencyCode').removeClass('is-invalid');
                }
                if (errors.ExchangeRate) {
                    $('#ExchangeRate_error').text(errors.ExchangeRate[zeroConst]);
                    $('#ExchangeRate').addClass('is-invalid');
                } else {
                    $('#ExchangeRate_error').text('');
                    $('#ExchangeRate').removeClass('is-invalid');
                }
            },
        });
    });
});

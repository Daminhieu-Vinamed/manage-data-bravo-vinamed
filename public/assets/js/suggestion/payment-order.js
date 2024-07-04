$(document).ready(function () {
    $("#ExchangeRate").val(oneConst);
    const docNo = $("input[name='DocNo']").val();
    const numberLastBefore = parseInt(docNo.slice(docNo.lastIndexOf(".") + oneConst));
    const lengthDocNoBefore = docNo.slice(docNo.lastIndexOf(".") + oneConst).length;
    var numberLastAfter = (numberLastBefore + oneConst).toString();
    if (numberLastAfter.length < lengthDocNoBefore) {
        for (let index = zeroConst; index < lengthDocNoBefore; index++) {
            numberLastAfter = "0" + numberLastAfter
        }
    }
    let firstDotIndex = docNo.indexOf(".");
    if (firstDotIndex !== -oneConst) {
        let secondDotIndex = docNo.indexOf(".", firstDotIndex + oneConst);
        if (secondDotIndex !== -oneConst) {
            const sliced2 = docNo.substring(zeroConst, secondDotIndex);
            const docNoNew = sliced2 + "." + numberLastAfter;
            $("input[name='DocNo']").val(docNoNew);
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
            </div>`);
        }else{
            $('.text-info-bank').remove();
            $('.row-info-bank').remove();
        }
    });
    $(document).on("change", "#CurrencyCode", function () {
        const valueCurrency = $(this).val();

        var TaxRate = $("input[name='TaxRate[]']")
            .map(function () {
                return $(this).val();
            })
            .get();

        var OriginalAmount9 = $("input[name='OriginalAmount9[]']")
            .map(function () {
                return $(this).val();
            })
            .get();

        var Amount3 = $("input[name='Amount3[]']");

        $("#th-name-vat").text("Giá trị " + valueCurrency + " chưa VAT");
        if (valueCurrency !== "VND" && !$("#th-name-money-vnd1").length) {
            $("#ExchangeRate").val(zeroConst).removeAttr("readonly");
            $("thead tr #th-name-vat").after(
                '<th id="th-name-money-vnd1">Tiền VND</th>'
            );
            $("tbody tr #OriginalAmount9").parent()
                .after(`<td id="td-name-money-vnd1">
                <input type="number" class="form-control" name="Amount9[]" id="Amount9" readonly/>
            </td>`);
            $("tbody tr #TaxRate")
                .parent()
                .after(
                    `<td id="td-name-value-added-tax-vat">
                <label for="OriginalAmount3" class="form-label small">Tiền ` +
                        valueCurrency +
                        `</label>
                <input type="number" class="form-control" name="OriginalAmount3[]" id="OriginalAmount3" readonly/>
            </td>`
                );
            $("thead tr #th-name-value-added-tax-vat").attr(
                "colspan",
                fourConst
            );
            $(".form-group-into-money #TotalOriginalAmount0").after(
                '<input type="number" class="form-control mt-2" name="TotalAmount0" id="TotalAmount0" readonly>'
            );
            $(".form-group-tax-money #TotalOriginalAmount3").after(
                '<input type="number" class="form-control mt-2" name="TotalAmount3" id="TotalAmount3" readonly>'
            );
            $(".form-group-total #TotalOriginalAmount").after(
                '<input type="number" class="form-control mt-2" name="TotalAmount" id="TotalAmount" readonly>'
            );

            var OriginalAmount3 = $("input[name='OriginalAmount3[]']");

            var Amount9 = $("input[name='Amount9[]']")
                .map(function () {
                    return $(this).val();
                })
                .get();

            for (let i = zeroConst; i < TaxRate.length; i++) {
                OriginalAmount3[i].value = OriginalAmount9[i] * TaxRate[i];
                Amount3[i].value = Amount9[i] * TaxRate[i];
            }
        } else if (valueCurrency === "VND" && $("#th-name-money-vnd1").length) {
            for (let i = zeroConst; i < TaxRate.length; i++) {
                Amount3[i].value = OriginalAmount9[i] * TaxRate[i];
            }
            $("thead tr #th-name-value-added-tax-vat").attr(
                "colspan",
                threeConst
            );
            $("#ExchangeRate").val(oneConst).attr("readonly", trueValue);
            $(
                "thead tr #th-name-money-vnd1, tbody tr #td-name-money-vnd1, tbody tr #td-name-value-added-tax-vat"
            ).remove();
            $(
                ".form-group-into-money #TotalAmount0, .form-group-tax-money #TotalAmount3, .form-group-total #TotalAmount"
            ).remove();
        }
        total_payment_order();
    });

    $(document).on("click", "#add-row", function () {
        $trClone = $("tbody tr:last").clone();
        $trNew = $trClone.attr("id", "line-" + one++);
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
        var EmployeeCode = $(this).val(nullValue);
        $(this)
            .next("#listEmployeeCode")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    return EmployeeCode.val(valueSelected);
                }
            });
    });

    $(document).on("blur", "#CustomerCode1", function () {
        const valueSelected = $(this).val();
        var CustomerCode = $(this).val(nullValue);
        $(this)
            .next("#listCustomerCode1")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    return CustomerCode.val(valueSelected);
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
        }
        var this_TaxCode = $(this).val(nullValue);
        $(this)
            .next("#listTaxCode")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    const percent = $(this).attr("percent");
                    const trId = $(this).parents("tr").attr("id");
                    vat_value_added_tax_calculation(percent, trId);
                    total_payment_order();
                    return this_TaxCode.val(valueSelected);
                }
            });
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
        const percent = $(this).parents("tr").find("#TaxRate").val();
        const trId = $(this).parents("tr").attr("id");
        vat_value_added_tax_calculation(percent, trId);
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
        formData = new FormData();
        formData.append('BranchCode', $("input[name='company']").val());
        formData.append('DocStatus', fortyFiveConst);
        formData.append('DocDate', $("input[name='DocDate']").val());
        formData.append('DocNo', $("input[name='DocNo']").val());
        formData.append('DocCode', $("input[name='DocCode']").val());
        formData.append('EmployeeCode', $("input[name='EmployeeCode']").val());
        formData.append('CustomerCode1', $("input[name='CustomerCode1']").val());
        formData.append('AmountTT', $("input[name='AmountTT']").val());
        formData.append('Stt_TU', $("input[name='Stt_TU']").val());
        formData.append('AmountTU', $("input[name='AmountTU']").val());
        formData.append('Hinh_Thuc_TT', $("select[name='Hinh_Thuc_TT']").val());
        formData.append('CurrencyCode', $("select[name='CurrencyCode']").val());
        formData.append('ExchangeRate', $("input[name='ExchangeRate']").val());
        formData.append('TotalOriginalAmount0', $("input[name='TotalOriginalAmount0']").val());
        if ($("input[name='TotalAmount0']").length) {
            formData.append('TotalAmount0', $("input[name='TotalAmount0']").val());
        }
        formData.append('TotalOriginalAmount3', $("input[name='TotalOriginalAmount3']").val());
        if ($("input[name='TotalAmount3']").length) {
            formData.append('TotalAmount3', $("input[name='TotalAmount3']").val());
        }
        formData.append('TotalOriginalAmount', $("input[name='TotalOriginalAmount']").val());
        if ($("input[name='TotalAmount']").length) {
            formData.append('TotalAmount', $("input[name='TotalAmount']").val());
        }
        if ($("input[name='BankName']").length) {
            formData.append('BankName', $("input[name='BankName']").val());
        }
        if ($("input[name='BankAccountNo']").length) {
            formData.append('BankAccountNo', $("input[name='BankAccountNo']").val());
        }
        if ($("input[name='Ten_Chu_TK']").length) {
            formData.append('Ten_Chu_TK', $("input[name='Ten_Chu_TK']").val());
        }
        if ($("textarea[name='Description1']").length) {
            formData.append('Description1', $("textarea[name='Description1']").val());
        }
        formData.append('So_Hd', $("input[name='So_Hd[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('Ngay_Hd', $("input[name='Ngay_Hd[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('Description', $("textarea[name='Description[]']")
        .map(function () {
            return $(this).val();
        })
        .get()); 
        formData.append('Invoice', $("input[name='Invoice[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('So_Van_Don', $("input[name='So_Van_Don[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('Trong_Luong', $("input[name='Trong_Luong[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('DV_Trong_Luong', $("input[name='DV_Trong_Luong[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('CustomerCode2', $("input[name='CustomerCode2[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('ExpenseCatgCode', $("input[name='ExpenseCatgCode[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('EmployeeCode1', $("input[name='EmployeeCode1[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('DeptCode', $("input[name='DeptCode[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('BizDocId_PO', $("input[name='BizDocId_PO[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('Hang_SX', $("input[name='Hang_SX[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('OriginalAmount9', $("input[name='OriginalAmount9[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('Amount9', $("input[name='Amount9[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('TaxCode', $("input[name='TaxCode[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('TaxRate', $("input[name='TaxRate[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('Amount3', $("input[name='Amount3[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('OriginalAmount3', $("input[name='OriginalAmount3[]']")
        .map(function () {
            return $(this).val();
        })
        .get());
        formData.append('Note', $("textarea[name='Note[]']")
        .map(function () {
            return $(this).val();
        })
        .get());

        $.ajax({
            url: linkSuggestion + "store",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: formData,
            processData: falseValue,
            contentType: falseValue,
            success: function (success) {
                ToastTopRight.fire({
                    icon: success.status,
                    title: success.msg,
                });
            },
            error: function (error) {
                let errors = error.responseJSON?.errors;
                errors.DocDate ? $("input[name='DocDate']").removeClass('is-valid').addClass('is-invalid'): $("input[name='DocDate']").removeClass('is-invalid').addClass('is-valid');
                errors.DocNo ? $("input[name='DocNo']").removeClass('is-valid').addClass('is-invalid'): $("input[name='DocNo']").removeClass('is-invalid').addClass('is-valid');
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
                if (errors.TotalOriginalAmount0 || errors.TotalAmount0) {
                    $('#TotalOriginalAmount0_error').text(errors.TotalOriginalAmount0[zeroConst]);
                    $('#TotalOriginalAmount0').removeClass('is-valid').addClass('is-invalid');
                    $('#TotalAmount0').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#TotalOriginalAmount0_error').text('');
                    $('#TotalOriginalAmount0').removeClass('is-invalid').addClass('is-valid');
                    $('#TotalAmount0').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.TotalOriginalAmount3 || errors.TotalAmount3) {
                    $('#TotalOriginalAmount3_error').text(errors.TotalOriginalAmount3[zeroConst]);
                    $('#TotalOriginalAmount3').removeClass('is-valid').addClass('is-invalid');
                    $('#TotalAmount3').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#TotalOriginalAmount3_error').text('');
                    $('#TotalOriginalAmount3').removeClass('is-invalid').addClass('is-valid');
                    $('#TotalAmount3').removeClass('is-invalid').addClass('is-valid');
                }
                if (errors.TotalOriginalAmount || errors.TotalAmount) {
                    $('#TotalOriginalAmount_error').text(errors.TotalOriginalAmount[zeroConst]);
                    $('#TotalOriginalAmount').removeClass('is-valid').addClass('is-invalid');
                    $('#TotalAmount').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#TotalOriginalAmount_error').text('');
                    $('#TotalOriginalAmount').removeClass('is-invalid').addClass('is-valid');
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

$(document).ready(function () {
    $("#ExchangeRate").val(oneConst);
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
            $(".form-group-into-money").append(
                '<input type="number" class="form-control mt-2" name="TotalAmount0" id="TotalAmount0" readonly>'
            );
            $(".form-group-tax-money").append(
                '<input type="number" class="form-control mt-2" name="TotalAmount3" id="TotalAmount3" readonly>'
            );
            $(".form-group-total").append(
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
                <button class="btn btn-danger btn-circle" id="delete-line">
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
        const BranchCode = $('#BranchCode').val();
        const DocStatus = $('#DocStatus').val();
        const DocDate = $('#DocDate').val();
        const DocNo = $('#DocNo').val();
        const DocCode = $('#DocCode').val();
        const EmployeeCode = $('#EmployeeCode').val();
        const CustomerCode1 = $('#CustomerCode1').val();
        const AmountTT = $('#AmountTT').val();
        const Stt_TU = $('#Stt_TU').val();
        const AmountTU = $('#AmountTU').val();
        const Hinh_Thuc_TT = $('#Hinh_Thuc_TT').val();
        const CurrencyCode = $('#CurrencyCode').val();
        const ExchangeRate = $('#ExchangeRate').val();
        const TotalOriginalAmount0 = $('#TotalOriginalAmount0').val();
        const TotalOriginalAmount3 = $('#TotalOriginalAmount3').val();
        const TotalOriginalAmount = $('#TotalOriginalAmount').val();
        const BankName = $('#BankName').val();
        const BankAccountNo = $('#BankAccountNo').val();
        const Ten_Chu_TK = $('#Ten_Chu_TK').val();
        const Description1 = $('#Description1').val();

        const So_Hd = $("input[name='So_Hd[]']").map(function(){return $(this).val();}).get();
        const Ngay_Hd = $("input[name='Ngay_Hd[]']").map(function(){return $(this).val();}).get();
        const Description = $("textarea[name='Description[]']").map(function(){return $(this).val();}).get();
        const Invoice = $("input[name='Invoice[]']").map(function(){return $(this).val();}).get();
        const So_Van_Don = $("input[name='So_Van_Don[]']").map(function(){return $(this).val();}).get();
        const Trong_Luong = $("input[name='Trong_Luong[]']").map(function(){return $(this).val();}).get();
        const DV_Trong_Luong = $("input[name='DV_Trong_Luong[]']").map(function(){return $(this).val();}).get();
        const CustomerCode2 = $("input[name='CustomerCode2[]']").map(function(){return $(this).val();}).get();
        const ExpenseCatgCode = $("input[name='ExpenseCatgCode[]']").map(function(){return $(this).val();}).get();
        const EmployeeCode1 = $("input[name='EmployeeCode1[]']").map(function(){return $(this).val();}).get();
        const DeptCode = $("input[name='DeptCode[]']").map(function(){return $(this).val();}).get();
        const BizDocId_PO = $("input[name='BizDocId_PO[]']").map(function(){return $(this).val();}).get();
        const Hang_SX = $("input[name='Hang_SX[]']").map(function(){return $(this).val();}).get();
        const OriginalAmount9 = $("input[name='OriginalAmount9[]']").map(function(){return $(this).val();}).get();
        const TaxCode = $("input[name='TaxCode[]']").map(function(){return $(this).val();}).get();
        const TaxRate = $("input[name='TaxRate[]']").map(function(){return $(this).val();}).get();
        const Amount3 = $("input[name='Amount3[]']").map(function(){return $(this).val();}).get();
        const Note = $("textarea[name='Note[]']").map(function(){return $(this).val();}).get();

        $.ajax({
            url: linkPaymentOrder + "store",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: {
                Stt: Stt,
                description: description,
                BranchCode: BranchCode,
            },
            success: function (success) {
                ToastTopRight.fire({
                    icon: success.status,
                    title: success.msg,
                });
                listPaymentOrder.ajax.reload();
            },
            error: function (error) {
                let notification = error.responseJSON;
                ToastErrorCenter.fire({
                    icon: notification.status,
                    text:
                        notification.msg !== undefinedValue
                            ? notification.msg
                            : notification.responseJSON?.errors.description,
                });
            },
        });
    });
});

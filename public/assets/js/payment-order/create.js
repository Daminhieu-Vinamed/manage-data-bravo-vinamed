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
            $("#ExchangeRate").val(zeroConst).removeAttr("disabled");
            $("thead tr #th-name-vat").after(
                '<th id="th-name-money-vnd1">Tiền VND</th>'
            );
            $("tbody tr #OriginalAmount9").parent()
                .after(`<td id="td-name-money-vnd1">
                <input type="number" class="form-control" name="Amount9[]" id="Amount9" disabled/>
            </td>`);
            $("tbody tr #TaxRate")
                .parent()
                .after(
                    `<td id="td-name-value-added-tax-vat">
                <label for="OriginalAmount3" class="form-label small">Tiền ` +
                        valueCurrency +
                        `</label>
                <input type="number" class="form-control" name="OriginalAmount3[]" id="OriginalAmount3" disabled/>
            </td>`
                );
            $("thead tr #th-name-value-added-tax-vat").attr(
                "colspan",
                fourConst
            );
            $(".form-group-into-money").append(
                '<input type="number" class="form-control mt-2" name="TotalAmount0" id="TotalAmount0" disabled>'
            );
            $(".form-group-tax-money").append(
                '<input type="number" class="form-control mt-2" name="TotalAmount3" id="TotalAmount3" disabled>'
            );
            $(".form-group-total").append(
                '<input type="number" class="form-control mt-2" name="TotalAmount" id="TotalAmount" disabled>'
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
            $("#ExchangeRate").val(oneConst).attr("disabled", trueValue);
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

    $(document).on("blur", "#bill_detailed_object", function () {
        const valueSelected = $(this).val();
        var this_bill_detailed_object = $(this).val(nullValue);
        $(this)
            .next("#list_detailed_object")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    return this_bill_detailed_object.val(valueSelected);
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

    $(document).on("blur", "#CustomerCode", function () {
        const valueSelected = $(this).val();
        var CustomerCode = $(this).val(nullValue);
        $(this)
            .next("#listCustomerCode")
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

    $(document).on("blur", "#base_items", function () {
        const valueSelected = $(this).val();
        var this_base_items = $(this).val(nullValue);
        $(this)
            .next("#list_base_items")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    return this_base_items.val(valueSelected);
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

    $(document).on("blur", "#bill_purchase_order", function () {
        const valueSelected = $(this).val();
        var this_bill_purchase_order = $(this).val(nullValue);
        $(this)
            .next("#list_bill_purchase_order")
            .children("option")
            .each(function () {
                if ($(this).val() === valueSelected) {
                    return this_bill_purchase_order.val(valueSelected);
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
});

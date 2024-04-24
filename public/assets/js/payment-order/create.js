$(document).ready(function () {
    $('#accounting_exchange_rate').val(oneConst);
    $(document).on("change", "#currency", function () {
        const valueCurrency = $(this).val();

        var bill_tax_percent = $("input[name='bill_tax_percent[]']").map(function () {
            return $(this).val();
        }).get();

        var bill_tax_money_multi1 = $("input[name='bill_tax_money_multi1[]']").map(function () {
            return $(this).val();
        }).get();

        var bill_tax_money_vnd = $("input[name='bill_tax_money_vnd[]']");

        $('#th-name-vat').text('Giá trị ' + valueCurrency + ' chưa VAT');
        if (valueCurrency !== 'VND' && !$("#th-name-money-vnd1").length) {
            $('#accounting_exchange_rate').val(zeroConst).removeAttr('disabled');
            $('thead tr #th-name-vat').after('<th id="th-name-money-vnd1">Tiền VND</th>');
            $('tbody tr #bill_tax_money_multi1').parent().after(`<td id="td-name-money-vnd1">
                <input type="number" class="form-control" name="bill_money_vnd[]" id="bill_money_vnd" disabled/>
            </td>`);
            $('tbody tr #bill_tax_percent').parent().after(`<td id="td-name-value-added-tax-vat">
                <label for="bill_tax_money_multi2" class="form-label small">Tiền ` + valueCurrency + `</label>
                <input type="number" class="form-control" name="bill_tax_money_multi2[]" id="bill_tax_money_multi2" disabled/>
            </td>`);
            $('thead tr #th-name-value-added-tax-vat').attr('colspan', fourConst);
            $('.form-group-into-money').append('<input type="number" class="form-control mt-2" name="into_money2" id="into_money2" disabled>');
            $('.form-group-tax-money').append('<input type="number" class="form-control mt-2" name="tax_money2" id="tax_money2" disabled>');
            $('.form-group-total').append('<input type="number" class="form-control mt-2" name="total_money2" id="total_money2" disabled>');

            var bill_tax_money_multi2 = $("input[name='bill_tax_money_multi2[]']");

            var bill_money_vnd = $("input[name='bill_money_vnd[]']").map(function () {
                return $(this).val();
            }).get();

            for (let i = zeroConst; i < bill_tax_percent.length; i++) {
                bill_tax_money_multi2[i].value = bill_tax_money_multi1[i] * bill_tax_percent[i];
                bill_tax_money_vnd[i].value = bill_money_vnd[i] * bill_tax_percent[i];
            }
        }else if(valueCurrency === 'VND' && $("#th-name-money-vnd1").length){
            for (let i = zeroConst; i < bill_tax_percent.length; i++) {
                bill_tax_money_vnd[i].value = bill_tax_money_multi1[i] * bill_tax_percent[i];
            }
            $('thead tr #th-name-value-added-tax-vat').attr('colspan', threeConst);
            $('#accounting_exchange_rate').val(oneConst).attr('disabled', trueValue);
            $('thead tr #th-name-money-vnd1, tbody tr #td-name-money-vnd1, tbody tr #td-name-value-added-tax-vat').remove();
            $('.form-group-into-money #into_money2, .form-group-tax-money #tax_money2, .form-group-total #total_money2').remove();
        }
        total_payment_order();
    });

    $(document).on("click", "#add-row", function () {
        $trClone = $('tbody tr:last').clone();
        $trNew = $trClone.attr('id', 'line-' + one++)
        if (!$('#th-action').length) {
            $('tbody tr:first').children('td:first').before('<td></td>');
            $trNew.children('td:first').before(`<td>
                <button class="btn btn-danger btn-circle" id="delete-line">
                    <i class="fas fa-times"></i>
                </button>
            </td>`);
            $('thead tr th:first').before('<th id="th-action">Hành động</th>');
        }
        $trNew.appendTo('tbody');
        total_payment_order();
    });

    $(document).on("click", "#delete-line", function () {
        $(this).parents('tr').remove();
        if (!$('#delete-line').length) {
            $('tbody tr:first').children('td:first').remove();
            $('#th-action').remove();
        }
    });

    $(document).on("blur", "#bill_detailed_object", function () {
        const valueSelected = $(this).val();
        var this_bill_detailed_object = $(this).val(nullValue)
        $(this).next('#list_detailed_object').children('option').each(function () {
            if ($(this).val() === valueSelected) {
                return this_bill_detailed_object.val(valueSelected);
            }
        })
    });

    $(document).on("blur", "#bill_staff", function () {
        const valueSelected = $(this).val();
        var this_bill_staff = $(this).val(nullValue)
        $(this).next('#list_bill_staff').children('option').each(function () {
            if ($(this).val() === valueSelected) {
                const trId = $(this).parents('tr').attr('id');
                $('#'+ trId).find('#bill_part').val($(this).attr('department'));
                return this_bill_staff.val(valueSelected);
            }
        })
    });

    $(document).on("blur", "#base_items", function () {
        const valueSelected = $(this).val();
        var this_base_items = $(this).val(nullValue)
        $(this).next('#list_base_items').children('option').each(function () {
            if ($(this).val() === valueSelected) {
                return this_base_items.val(valueSelected);
            }
        })
    });

    $(document).on("blur", "#bill_part", function () {
        const valueSelected = $(this).val();
        var this_bill_part = $(this).val(nullValue)
        $(this).next('#list_bill_part').children('option').each(function () {
            if ($(this).val() === valueSelected) {
                return this_bill_part.val(valueSelected);
            }
        })
    });

    $(document).on("change keyup paste", "#bill_tax_category", function () {
        const valueSelected = $(this).val();
        if (!valueSelected) {
            $(this).parents('tr').find('#bill_tax_percent').val(nullValue);
        }
        var this_bill_tax_category = $(this).val(nullValue);
        $(this).next('#list_bill_tax_category').children('option').each(function () {
            if ($(this).val() === valueSelected) {
                const percent = $(this).attr('percent');
                const trId = $(this).parents('tr').attr('id');
                vat_value_added_tax_calculation(percent, trId);
                total_payment_order();
                return this_bill_tax_category.val(valueSelected);
            }
        })
    });

    $(document).on("blur", "#bill_purchase_order", function () {
        const valueSelected = $(this).val();
        var this_bill_purchase_order = $(this).val(nullValue)
        $(this).next('#list_bill_purchase_order').children('option').each(function () {
            if ($(this).val() === valueSelected) {
                return this_bill_purchase_order.val(valueSelected);
            }
        })
    });

    $(document).on("change keyup paste", "#bill_tax_money_multi1", function () {
        const percent = $(this).parents('tr').find('#bill_tax_percent').val();
        const trId = $(this).parents('tr').attr('id');
        vat_value_added_tax_calculation(percent, trId);
        total_payment_order();
    });

    $(document).on("change keyup paste","#accounting_exchange_rate", function () {
        if ($('#bill_money_vnd').length) {
            var bill_tax_percent = $("input[name='bill_tax_percent[]']").map(function () {
                return $(this).val();
            }).get();
            var bill_money_vnd = $("input[name='bill_money_vnd[]']").map(function () {
                return $(this).val();
            }).get();
            var bill_tax_money_vnd = $("input[name='bill_tax_money_vnd[]']");
            for (let i = zeroConst; i < bill_tax_percent.length; i++) {
                bill_tax_money_vnd[i].value = bill_money_vnd[i] * bill_tax_percent[i];
            }
        }
        total_payment_order();
    });
});
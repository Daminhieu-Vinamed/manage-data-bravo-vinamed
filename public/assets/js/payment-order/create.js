$(document).ready(function () {
    $('#accounting_exchange_rate').val(one);
    $(document).on("change", "#currency", function () {
        const valueCurrency = $(this).val();
        $('#th-name-vat').text('Giá trị ' + valueCurrency + ' chưa VAT');
        if (valueCurrency !== 'VND' && !$("#th-name-money-vnd1").length) {
            $('#accounting_exchange_rate').val(zero).removeAttr('disabled');
            $('thead tr #th-name-vat').after('<th id="th-name-money-vnd1">Tiền VND</th>');
            $('tbody tr #bill_tax_money_multi1').parent().after(`<td id="td-name-money-vnd1">
                                                                    <input type="number" class="form-control" name="bill_tax_money_vnd1[]" id="bill_tax_money_vnd1"/>
                                                                </td>`);
            $('tbody tr #bill_tax_percent').parent().after(`<td id="td-name-value-added-tax-vat">
                                                                <label for="bill_tax_money_multi2" class="form-label small">Tiền ` + valueCurrency + `</label>
                                                                <input class="form-control" name="bill_tax_money_multi2[]" id="bill_tax_money_multi2"/>
                                                            </td>`);
            $('thead tr #th-name-value-added-tax-vat').attr('colspan', four);
            $('.form-group-into-money').append('<input type="number" class="form-control mt-2" name="into_money2" id="into_money2" disabled>');
            $('.form-group-tax-money').append('<input type="number" class="form-control mt-2" name="tax_money_money_vnd" id="tax_money_money_vnd" disabled>');
            $('.form-group-total').append('<input type="number" class="form-control mt-2" name="total_money_vnd" id="total_money_vnd" disabled>');
        }else if(valueCurrency === 'VND' && $("#th-name-money-vnd1").length){
            $('#accounting_exchange_rate').val(one).attr('disabled', trueValue);
            $('thead tr #th-name-money-vnd1, tbody tr #td-name-money-vnd1, tbody tr #td-name-value-added-tax-vat').remove();
            $('.form-group-into-money #into_money2, .form-group-tax-money #tax_money_money_vnd, .form-group-total #total_money_vnd').remove();
        }
        calculated_into_the_amount_requested_for_payment()
    });

    $(document).on("click", "#add-row", function () {
        $('tbody tr:first').clone().appendTo('tbody');
        calculated_into_the_amount_requested_for_payment();
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
                $(this).parent().parent().next().children('#bill_part').val($(this).attr('department'))
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

    $(document).on("blur", "#bill_tax_category", function () {
        const valueSelected = $(this).val();
        var this_bill_tax_category = $(this).val(nullValue);
        $(this).next('#list_bill_tax_category').children('option').each(function () {
            if ($(this).val() === valueSelected) {
                $(this).parent().parent().next().children('#bill_tax_percent').val($(this).attr('percent'))
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

    $(document).on("blur", "#bill_tax_money_multi1", function () {
        calculated_into_the_amount_requested_for_payment();
    });

    $(document).on("blur", "#accounting_exchange_rate", function () {
        calculated_into_the_amount_requested_for_payment();
    });
});
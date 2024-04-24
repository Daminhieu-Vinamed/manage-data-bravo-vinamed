function total_payment_order() {
    var bill_tax_money_multi1 = $("input[name='bill_tax_money_multi1[]']").map(function () {
            return $(this).val();
    }).get();
    bill_tax_money_multi1 = bill_tax_money_multi1.map(Number);
    let intoMoney1 = bill_tax_money_multi1.reduce(function(a,b){  return a+b }, zeroConst)
    $("#into_money1").val(intoMoney1);

    var bill_tax_money_vnd = $("input[name='bill_tax_money_vnd[]']").map(function () {
        return $(this).val();
    }).get();
    bill_tax_money_vnd = bill_tax_money_vnd.map(Number);
    let taxMoneyVnd = bill_tax_money_vnd.reduce(function(a,b){  return a+b }, zeroConst)

    if ($("input[name='bill_money_vnd[]']").length) {
        let intoMoney2 = zeroConst;
        for (let i = zeroConst; i < bill_tax_money_multi1.length; i++) {
            const moneyVnd = bill_tax_money_multi1[i] * $("#accounting_exchange_rate").val();
            $("input[name='bill_money_vnd[]']")[i].value = moneyVnd;
            intoMoney2 += moneyVnd;
        }
        $("#into_money2").val(intoMoney2);

        var bill_tax_money_multi2 = $("input[name='bill_tax_money_multi2[]']").map(function () {
            return $(this).val();
        }).get();
        bill_tax_money_multi2 = bill_tax_money_multi2.map(Number);
        let taxMoneyMulti = bill_tax_money_multi2.reduce(function(a,b){  return a+b }, zeroConst)
        $("#tax_money1").val(taxMoneyMulti);
        $("#tax_money2").val(taxMoneyVnd);
        $("#total_money1").val(taxMoneyMulti + intoMoney1);
        $("#total_money2").val(taxMoneyVnd + intoMoney2);
    }else{
        $("#tax_money1").val(taxMoneyVnd);
        $("#total_money1").val(taxMoneyVnd + intoMoney1);
    }
}

function vat_value_added_tax_calculation(percent, trId) {
    if ($('#bill_money_vnd').length) {
        let value_bill_tax_money_multi1 = $('#'+ trId).find('#bill_tax_money_multi1').val();
        $('#'+ trId).find('#bill_tax_money_multi2').val(value_bill_tax_money_multi1 * percent);
        let value_bill_money_vnd = $('#'+ trId).find('#bill_money_vnd').val();
        $('#'+ trId).find('#bill_tax_money_vnd').val(value_bill_money_vnd * percent);
    }else{
        let value_bill_tax_money_multi1 = $('#'+ trId).find('#bill_tax_money_multi1').val();
        $('#'+ trId).find('#bill_tax_money_vnd').val(value_bill_tax_money_multi1 * percent);
    }
    $('#'+ trId).find('#bill_tax_percent').val(percent)
}
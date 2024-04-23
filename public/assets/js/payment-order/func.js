function calculated_into_the_amount_requested_for_payment() {
    var bill_tax_money_multi1 = $("input[name='bill_tax_money_multi1[]']").map(function () {
            return $(this).val();
    }).get();

    bill_tax_money_multi1 = bill_tax_money_multi1.map(Number);
    let intoMoney1 = bill_tax_money_multi1.reduce(function(a,b){  return a+b }, zero)
    $("#into_money1").val(intoMoney1);

    if ($("input[name='bill_tax_money_vnd1[]']").length) {
        let intoMoney2 = zero;
        for (let i = zero; i < bill_tax_money_multi1.length; i++) {
            const moneyVnd = bill_tax_money_multi1[i] * $("#accounting_exchange_rate").val();
            $("input[name='bill_tax_money_vnd1[]']")[i].value = moneyVnd;
            intoMoney2 += moneyVnd;
        }
        $("#into_money2").val(intoMoney2);
    }
}

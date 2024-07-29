function total_payment_order() {
    var OriginalAmount9 = $("input[name='OriginalAmount9[]']")
        .map(function () {
            return $(this).val();
        })
        .get();
    OriginalAmount9 = OriginalAmount9.map(Number);
    let intoMoney1 = OriginalAmount9.reduce(function (a, b) {
        return a + b;
    }, zeroConst);
    $("#TotalOriginalAmount0").val(intoMoney1);

    var OriginalAmount3 = $("input[name='OriginalAmount3[]']")
        .map(function () {
            return $(this).val();
        })
        .get();
    OriginalAmount3 = OriginalAmount3.map(Number);
    let taxMoneyVnd = OriginalAmount3.reduce(function (a, b) {
        return a + b;
    }, zeroConst);

    if ($("input[name='Amount9[]']").length) {
        let intoMoney2 = zeroConst;
        for (let i = zeroConst; i < OriginalAmount9.length; i++) {
            const moneyVnd = OriginalAmount9[i] * $("#ExchangeRate").val();
            $("input[name='Amount9[]']")[i].value = moneyVnd;
            intoMoney2 += moneyVnd;
        }
        $("#TotalAmount0").val(intoMoney2);

        var Amount3 = $("input[name='Amount3[]']")
            .map(function () {
                return $(this).val();
            })
            .get();
        Amount3 = Amount3.map(Number);
        let taxMoneyMulti = Amount3.reduce(function (a, b) {
            return a + b;
        }, zeroConst);
        $("#TotalOriginalAmount3").val(taxMoneyVnd);
        $("#TotalAmount3").val(taxMoneyMulti);
        $("#TotalOriginalAmount").val(taxMoneyVnd + intoMoney1);
        $("#TotalAmount").val(taxMoneyMulti + intoMoney2);
    } else {
        $("#TotalOriginalAmount3").val(taxMoneyVnd);
        $("#TotalOriginalAmount").val(taxMoneyVnd + intoMoney1);
    }
}

function vat_value_added_tax_calculation(percent, trId) {
    if ($("#Amount9").length) {
        let value_OriginalAmount9 = $("#" + trId).find("#OriginalAmount9").val();
        $("#" + trId).find("#OriginalAmount3").val(value_OriginalAmount9 * percent);
        let value_Amount9 = $("#" + trId).find("#Amount9").val();
        $("#" + trId).find("#Amount3").val(value_Amount9 * percent);
    } else {
        let value_OriginalAmount9 = $("#" + trId).find("#OriginalAmount9").val();
        $("#" + trId).find("#OriginalAmount3").val(value_OriginalAmount9 * percent);
    }
    $("#" + trId).find("#TaxRate").val(percent);
}

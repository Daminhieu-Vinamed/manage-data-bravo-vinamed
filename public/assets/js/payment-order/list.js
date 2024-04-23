var listPaymentOrder = $("#dataTable").DataTable({
    ajax: {
        type: "get",
        url: linkPaymentAdmin + "get-data",
    },
    responsive: trueValue,
    rowReorder: trueValue,
    scrollX: trueValue,
    columns: [
        { data: "BranchCode", name: "BranchCode" },
        { data: "DocNo", name: "DocNo" },
        { data: "CustomerName", name: "CustomerName" },
        { data: "EmployeeName", name: "EmployeeName" },
        { data: "TotalAmount", name: "TotalAmount" },
        { data: "CurrencyCode", name: "CurrencyCode" },
        { data: "action", name: "action" },
        { data: "DocDate", name: "DocDate" },
        { data: "_StatusTT", name: "_StatusTT" },
    ],
    ordering: falseValue,
    order: {
        name: "DocDate",
        dir: "desc",
    },
    language: {
        paginate: {
            previous: '<i class="fas fa-caret-left"></i>',
            next: '<i class="fas fa-caret-right"></i>',
        },
        emptyTable: textListEmpty,
        info: textInfoDatatable,
        lengthMenu:
            '<select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">' +
            '<option value="10">10 đề nghị</option>' +
            '<option value="20">20 đề nghị</option>' +
            '<option value="30">30 đề nghị</option>' +
            '<option value="40">40 đề nghị</option>' +
            '<option value="50">50 đề nghị</option>' +
            '<option value="-1">tất cả đề nghị</option>' +
            "</select>",
        search: "_INPUT_",
        searchPlaceholder: textSearch,
        zeroRecords: textSearchDataEmpty,
        loadingRecords: textLoadingData,
    },
});
$(document).ready(function () {
    $("#tablePartA11, #tablePartA12, #tablePartA14, #tableStaffA11, #tableStaffA12, #tableStaffA14").DataTable({
        pageLength : fiveConst,
        responsive: trueValue,
        rowReorder: trueValue,
        scrollX: trueValue,
        drawCallback: function () {
            var api = this.api();
            var len = api.page.len();
            var numRows = api.rows().count();
            if (numRows <= len) {
                $('#' + $(this).attr('id') + '_wrapper').children('.row:last').remove();
                $('#' + $(this).attr('id') + '_wrapper').children('.row:first').remove();
            }
        },
        language: {
            paginate: {
                previous: '<i class="fas fa-caret-left"></i>',
                next: '<i class="fas fa-caret-right"></i>',
            },
            emptyTable: "Danh sách hiện tại đang trống",
            info: "Tổng có _TOTAL_ bản ghi",
            lengthMenu:
                '<select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">' +
                '<option value="5">5 bản ghi</option>' +
                '<option value="10">10 bản ghi</option>' +
                '<option value="20">20 bản ghi</option>' +
                '<option value="30">30 bản ghi</option>' +
                '<option value="40">40 bản ghi</option>' +
                '<option value="-1">tất cả bản ghi</option>' +
                "</select>",
            search: "_INPUT_",
            searchPlaceholder: "Tìm kiếm",
            zeroRecords: "Dữ liệu tìm kiếm không tồn tại",
            loadingRecords: "Đang tải dữ liệu...",
        }
    });
    $('#tablePartA11_length').appendTo('#filterPartA11 .lengthInTable');
    $('#tablePartA11_filter').appendTo('#filterPartA11 .searchInTable');
    $('#tablePartA12_length').appendTo('#filterPartA12 .lengthInTable');
    $('#tablePartA12_filter').appendTo('#filterPartA12 .searchInTable');
    $('#tablePartA14_length').appendTo('#filterPartA14 .lengthInTable');
    $('#tablePartA14_filter').appendTo('#filterPartA14 .searchInTable');

    $('#tableStaffA11_length').appendTo('#filterStaffA11 .lengthInTable');
    $('#tableStaffA11_filter').appendTo('#filterStaffA11 .searchInTable');
    $('#tableStaffA12_length').appendTo('#filterStaffA12 .lengthInTable');
    $('#tableStaffA12_filter').appendTo('#filterStaffA12 .searchInTable');
    $('#tableStaffA14_length').appendTo('#filterStaffA14 .lengthInTable');
    $('#tableStaffA14_filter').appendTo('#filterStaffA14 .searchInTable');
})
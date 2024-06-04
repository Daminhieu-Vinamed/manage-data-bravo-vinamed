$(document).ready(function () {
    $(`#tablePartA06, #tablePartA11, #tablePartA12, #tablePartA14, #tablePartA18, #tablePartA19, #tablePartA21, #tablePartA22, #tablePartA25, 
    #tableStaffA06, #tableStaffA11, #tableStaffA12, #tableStaffA14, #tableStaffA18, #tableStaffA19, #tableStaffA21, #tableStaffA22, #tableStaffA25`).DataTable({
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
    
    $('#tablePartA06_length').appendTo('#filterPartA06 .lengthInTable');
    $('#tablePartA06_filter').appendTo('#filterPartA06 .searchInTable');
    $('#tablePartA11_length').appendTo('#filterPartA11 .lengthInTable');
    $('#tablePartA11_filter').appendTo('#filterPartA11 .searchInTable');
    $('#tablePartA12_length').appendTo('#filterPartA12 .lengthInTable');
    $('#tablePartA12_filter').appendTo('#filterPartA12 .searchInTable');
    $('#tablePartA14_length').appendTo('#filterPartA14 .lengthInTable');
    $('#tablePartA14_filter').appendTo('#filterPartA14 .searchInTable');
    $('#tablePartA18_length').appendTo('#filterPartA18 .lengthInTable');
    $('#tablePartA18_filter').appendTo('#filterPartA18 .searchInTable');
    $('#tablePartA19_length').appendTo('#filterPartA19 .lengthInTable');
    $('#tablePartA19_filter').appendTo('#filterPartA19 .searchInTable');
    $('#tablePartA21_length').appendTo('#filterPartA21 .lengthInTable');
    $('#tablePartA21_filter').appendTo('#filterPartA21 .searchInTable');
    $('#tablePartA22_length').appendTo('#filterPartA22 .lengthInTable');
    $('#tablePartA22_filter').appendTo('#filterPartA22 .searchInTable');
    $('#tablePartA25_length').appendTo('#filterPartA25 .lengthInTable');
    $('#tablePartA25_filter').appendTo('#filterPartA25 .searchInTable');

    $('#tableStaffA06_length').appendTo('#filterStaffA06 .lengthInTable');
    $('#tableStaffA06_filter').appendTo('#filterStaffA06 .searchInTable');
    $('#tableStaffA11_length').appendTo('#filterStaffA11 .lengthInTable');
    $('#tableStaffA11_filter').appendTo('#filterStaffA11 .searchInTable');
    $('#tableStaffA12_length').appendTo('#filterStaffA12 .lengthInTable');
    $('#tableStaffA12_filter').appendTo('#filterStaffA12 .searchInTable');
    $('#tableStaffA14_length').appendTo('#filterStaffA14 .lengthInTable');
    $('#tableStaffA14_filter').appendTo('#filterStaffA14 .searchInTable');
    $('#tableStaffA18_length').appendTo('#filterStaffA18 .lengthInTable');
    $('#tableStaffA18_filter').appendTo('#filterStaffA18 .searchInTable');
    $('#tableStaffA19_length').appendTo('#filterStaffA19 .lengthInTable');
    $('#tableStaffA19_filter').appendTo('#filterStaffA19 .searchInTable');
    $('#tableStaffA21_length').appendTo('#filterStaffA21 .lengthInTable');
    $('#tableStaffA21_filter').appendTo('#filterStaffA21 .searchInTable');
    $('#tableStaffA22_length').appendTo('#filterStaffA22 .lengthInTable');
    $('#tableStaffA22_filter').appendTo('#filterStaffA22 .searchInTable');
    $('#tableStaffA25_length').appendTo('#filterStaffA25 .lengthInTable');
    $('#tableStaffA25_filter').appendTo('#filterStaffA25 .searchInTable');
})
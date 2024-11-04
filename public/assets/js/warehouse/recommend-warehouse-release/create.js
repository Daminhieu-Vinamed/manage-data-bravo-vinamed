$(document).ready(function () {
    $(document).on("click", "#search_product", function () {
        if ($('#table_products > thead > tr > th').length === fourConst) {
            $('#table_products > thead > tr > th:first').before('<th>Chọn sản phẩm</th>')
            $('#table_products > tbody').empty();
            $('#table_products > tfoot').remove();
        }
        
        $('#table_products').append(`<tr>
                                        <td><input type="checkbox" name="chooseProduct[]"></td>
                                        <td>Mã 1</td>
                                        <td>Sản phẩm 1</td>
                                        <td>Chai</td>
                                        <td>100</td> 
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="chooseProduct[]"></td>
                                        <td>Mã 2</td>
                                        <td>Sản phẩm 2</td>
                                        <td>Chai</td>
                                        <td>200</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="chooseProduct[]"></td>
                                        <td>Mã 3</td>
                                        <td>Sản phẩm 3</td>
                                        <td>Chai</td>
                                        <td>300</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="chooseProduct[]"></td>
                                        <td>Mã 4</td>
                                        <td>Sản phẩm 4</td>
                                        <td>Chai</td>
                                        <td>400</td>
                                    </tr>`);
                                    
        $("#table_products").DataTable({
            responsive: trueValue,
            rowReorder: trueValue,
            scrollX: trueValue,
            ordering: falseValue,
            language: {
                paginate: {
                    previous: '<i class="fas fa-caret-left"></i>',
                    next: '<i class="fas fa-caret-right"></i>',
                },
                emptyTable: "Danh sách hiện tại đang trống",
                info: "Đang hiển thị trang _PAGE_ trên tổng _PAGES_ trang, _PAGES_ trang này có tổng _TOTAL_ bản ghi",
                lengthMenu:
                    '<select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">' +
                    '<option value="10">10 sản phẩm</option>' +
                    '<option value="20">20 sản phẩm</option>' +
                    '<option value="30">30 sản phẩm</option>' +
                    '<option value="40">40 sản phẩm</option>' +
                    '<option value="50">50 sản phẩm</option>' +
                    '<option value="-1">tất cả sản phẩm</option>' +
                    "</select>",
                search: "_INPUT_",
                searchPlaceholder: "Tìm kiếm",
                zeroRecords: "Dữ liệu tìm kiếm không tồn tại",
                loadingRecords: "Đang tải dữ liệu...",
            },
            initComplete: function () {
                var api = this.api();
                var len = api.page.len();
                var numRows = api.rows().count();
                if (numRows <= len) {
                    $('#table_products_wrapper').children('.row:last').remove();
                    $('#table_products_wrapper').children('.row:first').remove();
                }
            },
        });
    });

    $(document).on("click", "input[name='chooseProduct[]']", function () {
        const chooseProduct = $("input[name='chooseProduct[]']").map(function() { return $(this).is(":checked") }).get();
        if (chooseProduct.includes(trueValue)) {
            if (!$('#get_the_product').length) {
                $("#list_product").append(`<div class="mt-3 row justify-content-center">
                    <button class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="get_the_product">LẤY SẢN PHẨM</button>
                </div>`);   
            }
        }else{
            $('#get_the_product').remove();
        }
    });

    $(document).on("click", "#get_the_product", function () {
        $('#table_products').DataTable().destroy();
        $('#table_products > thead > tr > th:first').remove();

        var chooseProducts = $("input[name='chooseProduct[]']").map(
            function(){
                if (!$(this).prop('checked')) {
                    return $(this);
                }
            }
        ).get();
        
        chooseProducts.forEach(element => {
            element.parents('tr').remove();
        });

        $("#table_products > tbody > tr").each(function() {
            $(this).find("td:first").remove();
        });
        
        $('#table_products').append(`<tfoot>
            <tr>
                <th colspan="3">Tổng</th>
                <th></th>
            </tr>
        </tfoot>`);

        $("#table_products > tbody > tr").each(function() {
            const quantity = Number($(this).find("td:last").text());
            zero += quantity;
        });

        $('#table_products > tfoot > tr > th:last').text(zero);

        $('#get_the_product').text('TẠO MỚI');
    });

    $('input[name="customer"]').select2({
        language: 'vi',
        placeholder: 'Chọn kho hàng',
        minimumInputLength: twoConst,
        allowClear: trueValue,
        ajax: {
            url: linkWarehouse + 'search-warehouse',
            dataType: 'json',
            quietMillis: twoHundredFiftyConst,
            data: function (term, page) {
                return {
                    q: term,
                    page: page || oneConst
                };
            },
            results: function (data, page) {
                var more = (page * twentyConst) < data.total;
                return { results: data.data, more: more };
            },
            cache: trueValue
        },
        formatResult: function(data) {
            return data.text;
        },
        formatSelection: function(data) {
            return data.text;
        },
        formatNoMatches: function() {
            return "Không tìm thấy kết quả phù hợp";
        },
        formatInputTooShort: function(input, min) {
            return "Vui lòng nhập nhiều hơn " + (min - input.length) + " ký tự";
        },
        formatInputTooLong: function(input, max) {
            return "Vui lòng nhập ít hơn " + (input.length - max) + " ký tự";
        },
        formatSelectionTooBig: function(limit) {
            return "Bạn chỉ có thể chọn tối đa " + limit + " mục";
        },
        formatLoadMore: function() {
            return "Đang tải thêm kết quả…";
        },
        formatSearching: function() {
            return "Đang tìm kiếm…";
        }
    });
});
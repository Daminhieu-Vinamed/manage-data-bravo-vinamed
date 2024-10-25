$(document).ready(function () {
    if ($('#validate-startDate-error').length) {
        $input = $('#validate-startDate-error').prev();
        $input.addClass('is-invalid');
    }

    if ($('#validate-endDate-error').length) {
        $input = $('#validate-endDate-error').prev();
        $input.addClass('is-invalid');
    }

    $('#customer').select2({
        language: 'vi',
        placeholder: 'Chọn khách hàng',
        minimumInputLength: twoConst,
        allowClear: trueValue,
        ajax: {
            url: linkWarehouse + 'search-customer',
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
$(document).ready(function(){
    /**
     * Xu ly khi nhap tieu de bai viet tao slugs
     */
    $("#title").bind('input', function () {
        var title;
        var host = window.location.origin;
        var uri = $(this).attr('url-data');
        var url = host + uri;
        title = $(this).val();
        $.ajax({
            url : url,
            type : 'post',
            data : {title : title},
            dataType : 'json',
            success : function (result) {
                $("#slugs").val(result.slugs);
                $(".error-slugs").html(result.notify);
            }
        });
    });

    /**
     * Xu ly khi edit slugs
     */
    $("#slugs").on('input', function () {
        var title;
        var host = window.location.origin;
        var uri = $(this).attr('url-data');
        var url = host + uri;
        title = $(this).val();
        $.ajax({
            url : url,
            type : 'post',
            data : {title : title},
            dataType : 'json',
            success : function (result) {
                $(".error-slugs").html(result.notify);
            }
        });
    });
});

//Tự động chọn theo các trạng thái cũ khi sửa
function autoSelect(valDefault, tag) {
    $(tag).each(function () {
        var value = $(this).val();
        if (valDefault == value) {
            $(this).prop('selected', true);
        }
    });
}

//Load danh mục khi tạo mới danh mục
function selectCategory(elm) {
    var type = $(elm).val();
    var uri = $(elm).attr('uri');
    var url = window.location.origin + uri;
    $.ajax({
        url: url,
        type: 'post',
        data: {type: type},
        dataType: 'json',
        success: function(result) {
            var html = `<option value="">Mặc định là cha</option>`;
            var list = '';
            if (result.result == 1) {
                $.each(result.list, function (key, value) {
                    list += `<option value="${value.id}">${value.title}</option>`;
                });
                html += list;
            } else {
                html += '';
            }
            console.log(html);
            $("select[name=parent]").html(html);
        }
    });
}

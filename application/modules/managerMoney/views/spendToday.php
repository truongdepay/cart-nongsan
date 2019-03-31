<?php
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 2/19/2019
 * Time: 3:26 PM
 */
?>

<h3 class="mt-5">Tra cứu</h3>
<div class="form-row">
    <div class="col-5">
        <input type="text" class="form-control" placeholder="Từ ngày" id="fromDate" name="fromDate">
    </div>
    <div class="col-5">
        <input type="text" class="form-control" placeholder="Đến ngày" id="toDate" name="toDate">
    </div>
    <div class="col-2">
        <input type="button" class="btn btn-danger" value="Tra cứu" onclick="search();">
    </div>
</div>

<div id="resultSearch" class="bg-light">

</div>

<h3 class="mt-5">Mới thêm gần đây nhất</h3>
<table class="table mt-1">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Content</th>
        <th scope="col">Money</th>
        <th scope="col">Date</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($listSpend as $value) {
        ?>
        <tr>
            <th scope="row"><?= $value->id; ?></th>
            <td><?= $value->content; ?></td>
            <td><?= number_format($value->money); ?></td>
            <td><?= date(date('d-m-Y', $value->date)); ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

<script>
    $(function() {
        $( "#fromDate" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
        $( "#toDate" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });

    function search() {
        var fromDate = $("#fromDate").val();
        var toDate = $("#toDate").val();

        var url = window.location.origin + '/managerMoney/index/search';
        $.ajax({
            url: url,
            type: 'post',
            data: {fromDate: fromDate, toDate: toDate},
            dataType: 'json',
            success: function (result) {
                var html = '';
                if (result.result == 1) {
                    $.each(result.content, function (key, item) {
                        html += `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.content}</td>
                        <td>${item.money}</td>
                        <td>${item.date}</td>
                    </tr>
                    `;
                    });
                    html = `
                        <h4 class="mt-5">Kết quả tra cứu từ <span class="text-danger">${result.fromDate}</span> tới <span class="text-danger">${result.toDate}</span></h4>
                        <table class="table mt-1">
                        ${html}
                        <tr>
                        <th colspan="4">Tổng: ${result['content'][0].total}</th>
                        </tr>
                        </table>`;
                } else {
                    html += `<h5 class="text-warning">Không tìm thấy kết quả!<h5>`;
                }

                $("#resultSearch").html(html);
            }
        });
    }
</script>
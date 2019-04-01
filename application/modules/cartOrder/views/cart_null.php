<?php
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 3/31/2019
 * Time: 11:38 AM
 */
?>
<div class="row justify-content-center mb-5">
    <div class="col-xl-10">
        <div class="row">
            <div class="col">
                <div class="card-header border-0 bg-light">
                    <h4>GIỎ HÀNG(<?= 0 ?> sản phẩm)</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 style="text-align: center">Không có sản phẩm nào trong giỏ hàng của bạn!</h4>
                <a style="text-align: center;" href="https://nongsandungha.com" class="btn btn-warning m-auto d-block w-25">Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="csrf_name" value="<?= $csrf_value ?>">


<script>
    function addProduct(elm) {
        var id = $(elm).attr('data-id');
        var type = 'add';
        var url = window.location.origin + '/cartOrder/orderProduct';
        var order = $("input[name=order-number]").val();
        var csrf_value = $("input[name=csrf_name]").val();

        $.ajax({
            url : url,
            type : 'post',
            data : {csrf_name : csrf_value, id : id, order : order, type : type},
            dataType : 'json',
            success : function (result) {
                window.location.reload();
            }
        });
    }
</script>
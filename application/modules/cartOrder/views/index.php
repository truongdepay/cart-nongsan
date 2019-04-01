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
                    <h4>GIỎ HÀNG(<?= $totalProduct ?> sản phẩm)</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-xl-8">
                <?php
                foreach ($result as $item) {
                    ?>
                    <div class="card border-0 mb-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 col-sm-2 col-md-2 col-lg-2">
                                    <img
                                        src="<?= $item['thumb'] ?>"
                                        alt="" style="width: 100%;">
                                </div>
                                <div class="col-9 col-sm-6 col-md-6 col-lg-6">
                                    <h5><?= $item['title'] ?></h5>
                                    <a href="" class="text">Xóa sản phẩm</a>
                                </div>
                                <div class="col-12 col-sm-4 col-md-2 col-lg-2 p-2 p-sm-0">
                                    <h4><?= number_format($item['price']) ?> đ</h4>
                                    <p class="line-through">190.000 đ</p>
                                    <input type="button" class="btn btn-sm btn-warning" value="Giảm 13%">
                                </div>
                                <div class="col-12 col-sm-12 col-md-2 col-lg-2 p-sm-3 p-2 p-md-0">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="order-number-<?= $item['id'] ?>" value="<?= $item['count'] ?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-danger" type="button" onclick="addProduct(this)" data-id="<?= $item['id'] ?>">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                ?>

            </div>
            <div class="col-lg-3 col-xl-4">
                <div class="card border-0">
                    <div class="card-body">
                        <h5>Thành tiền</h5>
                        <h3 class="text-danger"><?= number_format($totalMoney) ?> đ</h3>
                        <p>(đã bao gồm VAT)</p>
                    </div>
                </div>
                <input type="button" class="btn btn-danger btn-block " value="Tiến hành đặt hàng">
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="csrf_name" value="<?= $csrf_value ?>">


<script>
    function addProduct(elm) {
        var id = $(elm).attr('data-id');
        var url = '<?= base_url('cartOrder/index/orderProduct'); ?>';
        var name = "input[name=order-number-" + id +"]";
        var order = $(name).val();
        var csrf_value = $("input[name=csrf_name]").val();

        $.ajax({
            url : url,
            type : 'post',
            data : {csrf_name : csrf_value, id : id, order : order},
            dataType : 'json',
            success : function (result) {
                window.location.reload();
            }
        });
    }
</script>
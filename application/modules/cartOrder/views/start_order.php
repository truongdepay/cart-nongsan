<?php
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 4/1/2019
 * Time: 11:39 PM
 */
?>

<div class="row justify-content-center mb-5">
    <div class="col-xl-8 col-lg-10">
        <div class="card-header bg-light">
            <h3>Tiến hành đặt hàng</h3>
        </div>
        <?= form_open() ?>
        <div class="row">
            <div class="col-lg-8 box-product-order">
                <div class="card bg-white">
                    <div class="card-header">
                        <h4>1. Chọn cách nhận hàng</h4>
                    </div>
                    <div class="card-body">
                        <label  for="customRadio1" class="d-block"><input type="radio" id="customRadio1" name="receive" value="0" checked> Giao hàng tận nơi</label>

                        <div class="form-group" id="address-form">

                        </div>

                        <label  for="customRadio2"><input type="radio" id="customRadio2" name="receive" value="1"> Nhận hàng tại cửa hàng (Cơ sở 1: Nhà số 11 ngõ 100 đường Trung Kính quận Cầu Giấy Tp. Hà Nội)</label>
                    </div>
                </div>
                <div class="card bg-white">
                    <div class="card-header">
                        <h4>2. Nhập thông tin cá nhân</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="fullname">Họ tên<span class="text-danger">(Bắt buộc)</span></label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="" value="<?= set_value('fullname') ?>">
                            <?= form_error('fullname', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>

                        <div class="form-group">
                            <label for="phone">Điện thoại<span class="text-danger">(Bắt buộc)</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="" min="0" max="99999999999" maxlength="11" <?= set_value('phone') ?>>
                            <?= form_error('phone', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="" value="<?= set_value('email') ?>">
                            <?= form_error('email', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>
                </div>
                <div class="card bg-white">
                    <div class="card-header">
                        <h4>3. Thông tin thêm</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group mt-2">
                            <label for="date-receive">Ngày nhận hàng</label>
                            <input type="text" class="form-control" id="date-receive" name="date-receive" placeholder="">
                        </div>
                        <div class="form-group mt-2">
                            <label for="note">Ghi chú</label>
                            <textarea class="form-control" id="note" name="note"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 box-order">
                <div class="card border-0">
                    <div class="card-body">
                        <h5>Thành tiền</h5>
                        <h3 class="text-danger"><?= number_format($totalMoney) ?>đ</h3>
                    </div>
                </div>
                <input type="submit" class="btn btn-danger btn-block " value="Đặt ngay">
            </div>
        </div>
    </div>
    <?= form_close() ?>
</div>

<script>

    $(function() {
        $( "#date-receive" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });


    $("input[name=receive]").click(function () {
        displayAdress(this);
    });

    displayAdress("input[name=receive]");

    function displayAdress(elm) {
        var check = $(elm).val();
        var html = '<label for="address">Địa chỉ<span class="text-danger">(Bắt buộc)</span></label>\n' +
            '                            <input type="text" class="form-control" id="address" name="address" placeholder="" value="">'+
            '<?= form_error('address', '<p class="text-danger mb-0">', '</p>') ?>';
        if (check == 0) {
            $("#address-form").html(html);
        } else {
            $("#address-form").html('');
        }
    }
</script>
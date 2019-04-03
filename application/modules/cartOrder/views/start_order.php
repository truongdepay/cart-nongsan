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
            <h4>Tiến hành đặt hàng</h4>
        </div>
        <?= form_open() ?>
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0">
                    <div class="card-body bg-white">
                        <div class="form-group">
                            <label for="fullname">Họ tên<span class="text-danger">(Bắt buộc)</span></label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="phone">Điện thoại<span class="text-danger">(Bắt buộc)</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="" min="0" max="99999999999" maxlength="11">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="">
                        </div>

                        <label  for="customRadio1" class="d-block"><input type="radio" id="customRadio1" name="receive" value="0" checked> Giao hàng tận nơi</label>

                        <div class="form-group" id="address-form">

                        </div>

                        <label  for="customRadio2"><input type="radio" id="customRadio2" name="receive" value="1"> Nhận hàng tại cửa hàng (Cơ sở 1: Nhà số 11 ngõ 100 đường Trung Kính quận Cầu Giấy Tp. Hà Nội)</label>

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
            <div class="col-md-4">
                <div class="card border-0">
                    <div class="card-body">
                        <h5>Thành tiền</h5>
                        <h3 class="text-danger"><?= number_format($totalMoney) ?>đ</h3>
                        <p>(đã bao gồm VAT)</p>
                    </div>
                </div>
                <input type="submit" class="btn btn-danger btn-block " value="Tiến hành đặt hàng">
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
            '                            <input type="text" class="form-control" id="address" name="address" placeholder="">';
        if (check == 0) {
            $("#address-form").html(html);
        } else {
            $("#address-form").html('');
        }
    }
</script>
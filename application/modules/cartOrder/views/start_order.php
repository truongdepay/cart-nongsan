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
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0">
                    <div class="card-body bg-white">
                        <div class="form-group">
                            <label for="fullname">Họ tên</label>
                            <input type="text" class="form-control" id="fullname"placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email"placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="phone">Điện thoại</label>
                            <input type="text" class="form-control" id="phone"placeholder="">
                        </div>

                        <label  for="customRadio1" class="d-block"><input type="radio" id="customRadio1" name="receive" value="1"> Nhận hàng tại nhà</label>


                        <label  for="customRadio2"><input type="radio" id="customRadio2" name="receive" value="2"> Nhận hàng tại cửa hàng (Cơ sở 1: Nhà số 11 ngõ 100 đường Trung Kính quận Cầu Giấy Tp. Hà Nội)</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0">
                    <div class="card-body">
                        <h5>Thành tiền</h5>
                        <h3 class="text-danger">10101010đ</h3>
                        <p>(đã bao gồm VAT)</p>
                    </div>
                </div>
                <input type="button" class="btn btn-danger btn-block " value="Tiến hành đặt hàng">
            </div>
        </div>
    </div>
</div>

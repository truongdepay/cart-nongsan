<?php
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 4/7/2019
 * Time: 3:47 AM
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://nongsandungha.com/wp-content/cache/wpfc-minified/1sd5qg0n/84vwp.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style-nongsan.css') ?>">
    <script src="https://nongsandungha.com/wp-content/themes/twentysixteen/js/jquery.min.js?ver=20141010"></script>
</head>
<body>

<div style="position: relative; width: 500px; float:right;">

    <div class="box-order-cart-pc hidden-xs" id="box-order-cart-pc" style="display: none;">
        <i class="fa fa-caret-up icon-up-pc"></i>
        <a href="javascript:closeModal()" class="icon-remove-pc"><i class="fa fa-remove"></i></a>
        <div class="row">
            <div class="col-xs-12">
                <h3><small class="text-success">Sản phẩm đã được thêm vào giỏ hàng!</small></h3>
            </div>
            <div class="col-xs-12">
                <button class="btn btn-sm btn-danger">Xem giỏ hàng và thanh toán</button>
            </div>
        </div>
    </div>
</div>

<button onclick="openModal()">Mua lẻ</button>
<div class="box-cart-order  hidden-sm hidden-md hidden-lg" id="box-order-cart-mobile">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="text-success">Sản phẩm đã được thêm vào giỏ hàng!</h3>
        </div>
        <div class="col-xs-12">
            <button class="btn btn-lg btn-danger btn-block">Xem giỏ hàng</button>
        </div>
    </div>
    <div class="row" style="margin-top: 10px; text-align: center">
        <div class="col-xs-12">
            <button class="btn btn-default btn-sm" onclick="closeModal()">Đóng</button>
        </div>
    </div>
</div>
<script>
    function getIdbyDevice() {
        var innerW = window.innerWidth;
        var idModal = '';
        if (innerW < 768) {
            idModal = '#box-order-cart-mobile';
        } else {
            idModal = '#box-order-cart-pc';
        }
        return idModal;
    }
    function openModal() {

        var idModal = getIdbyDevice();
        $(idModal).show(100);
    }

    function closeModal() {
        var idModal = getIdbyDevice();
        $(idModal).hide(100);
    }
</script>
</body>
</html>



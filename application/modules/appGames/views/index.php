<?php
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 3/20/2019
 * Time: 3:52 PM
 */
?>
<div class="row justify-content-lg-center justify-content-md-center">
    <div class="col-md-7 col-lg-6">
<!--        <img src="--><?//= base_url('assets/img/banner.jpg') ?><!--" alt="banner" class="w-100">-->
        <div class="card mt-2 border-0">
            <div class="card-header bg-danger">
                <h4 class="text-light">Lượt còn lại: <span class="text-warning" id="turn">5</span></h4>
            </div>
            <div class="card-body bg-light-info">
                <h3 class="g_message" style="text-align: center">Vui lòng chọn số!</h3>
            </div>
        </div>
        <div class="row">
            <div class="col" id="error">

            </div>
        </div>
        <div class="card mt-1" id="body-play">
            <div class="card-body">
                <div class="row justify-content-lg-center justify-content-md-center">
                    <div class="col-md-7 col-lg-7">
                        <div class="row">
                            <?php
                            for ($i = 1; $i < $keyboard; $i++) {
                                ?>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 p-2">
                                    <button class="btn btn-success w-100" onclick="selectNumber(this);"><?= $i ?></button>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 p-2 justify-content-lg-center">

                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 p-2 justify-content-lg-center">
                                <button class="btn btn-success w-100" onclick="selectNumber(this);">0</button>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 p-2 justify-content-lg-center">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 p-2">
                                <button class="btn btn-danger w-100" onclick="resetNumber();">Reset</button>
                            </div>
                            <div class="col-6 p-2">
                                <button class="btn btn-primary w-100" onclick="sendNumber();">Xác nhận</button>
                            </div>
                            <div class="col-12 p-2">
                                <button class="btn btn-light w-100" onclick="window.location.href = '<?= site_url('appGames/index/start') ?>'">Thoát</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Lịch sử chơi</h4>
            </div>
            <div class="card-body" id="history">

            </div>
        </div>
    </div>
</div>
<input type="hidden" id="val-select">
<input type="hidden" name="<?= $csrf_name ?>" value="<?= $csrf_value ?>" id="csrf">
<script>
    function selectNumber(elm) {
        var number = $(elm).text();
        var valHidden = $("#val-select").val();
        valHidden += number;
        if (valHidden.length > 2) {
            $("#error").html("<p class='text-danger bg-light'>Chỉ được nhập 2 số, vui lòng Reset để nhập lại!</p>");
            setTimeout(function () {
                $("#error").html("");
            }, 2000);
        } else {
            $("#val-select").val(valHidden);
            $('.g_message').html(valHidden);
        }

    }

    function resetNumber() {
        $("#val-select").val('');
        $('.g_message').html('Vui lòng chọn số!');
    }

    function sendNumber() {
        var number = $("#val-select").val();
        if (number.length > 0 && number.length <= 2) {
            var host = window.location.origin;
            var uri = '/appGames/index/logic';
            var url = host + uri;
            var csrf_name = $("#csrf").attr('name');
            var csrf_value = $("#csrf").val();

            $.ajax({
                url : url,
                type : 'post',
                data : {csrf_name:csrf_value, number:number},
                dataType : 'json',
                success : function (result) {
                    $("#val-select").val('');
                    if (result.result == 1) {
                        if (result.data.turn == 0) {
                            var html = '<button class="btn btn-success d-block m-auto" onclick="startGame()">Chơi lại</button>'+
                                '<form method="post" action="" id="formStartGame">' +
                                '<input type="hidden" name="csrf_name" value="'+ result.csrf.csrf_value +'">'+
                                '</form>';
                            $("#csrf").val(result.csrf.csrf_value);
                            $(".g_message").html(result.data.notify);
                            $("#turn").html(result.data.turn);
                            $("#history").append('<h5>' + result.data.notify + '</h5>');
                            $(".g_message").after(html);
                            $("#body-play").html('');
                        } else {
                            $("#csrf").val(result.csrf.csrf_value);
                            $(".g_message").html(result.data.notify);
                            $("#turn").html(result.data.turn);
                            $("#history").append('<h5>' + result.data.notify + '</h5>');
                        }

                    } else if (result.result == 0) {
                        $("#body-play").html('');
                    }
                }
            });
        } else {
            $("#error").html("<p class='text-danger bg-light'>Bạn chưa nhập số, vui lòng nhập số rồi xác nhận!</p>");
            setTimeout(function () {
                $("#error").html("");
            }, 2000);
        }
    }

    function startGame() {
        var idForm = document.getElementById('formStartGame');
        idForm.submit();
    }

</script>
<?php
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 3/21/2019
 * Time: 10:41 AM
 */
?>
<div class="row justify-content-lg-center justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6">
        <h1 class="text-light">Bạn còn <?= $turn ?> lượt chơi!</h1>
        
        <button class="btn btn-success" onclick="startGame()">Start Games</button>
        <?= form_open('appGames/index/index', [
            'id' => 'formStartGame'
        ]) ?>
        <?= form_close() ?>
    </div>
</div>

<script>
    function startGame() {
        var idForm = document.getElementById('formStartGame');
        idForm.submit();
    }
</script>

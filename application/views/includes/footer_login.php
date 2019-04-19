<?php
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 3/14/2019
 * Time: 3:38 PM
 */
?>

<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
</script>
</body>
</html>

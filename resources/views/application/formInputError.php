<?php if (isset($_SESSION["error_$inputName"])) { ?>
    <p style="color: red;"><?= $_SESSION['error_$inputName'] ?></p>
<?php }
unset($_SESSION['error_$inputName']); ?>
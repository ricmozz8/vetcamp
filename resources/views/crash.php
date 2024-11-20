<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';


// crafting google search for error url

$helpURL = "https://www.php.net/search.php?q=" . urlencode($exception_name);

?>



<body class="error-body">

    <div class="error-box by-engine">
        <a href="<?= $helpURL ?>" target="_blank">
        <h1><?= $exception_name ?></h1>
        </a>
        <p class="error-message"><?= $exception_message ?></p>

        <div class="error-desc">
            <p>At file</p>
            <p class="error-file"> <?= $exception_file ?> </p>
            <p>on line <b> <?= $exception_line ?> </b></p>
        </div>
        <br>

        <div class="error-trace">
            <h2>File Trace</h2>
            <br>

            <div class="trace">
                <div class="trace-files">
                    <?php
                    foreach ($exception_trace as $trace) {
                        echo '<div class="error-trace-file">' . $trace['file'] . '</div>';
                    }
                    ?>
                </div>

                <div class="file-contents">
                    <?php
                    foreach ($exception_trace as $trace) {
                        echo '<div class="error-trace-line"> Line ' . $trace['line'] . '</div>';
                    }
                    ?>
                </div>

            </div>

        </div>



</body>

</html>
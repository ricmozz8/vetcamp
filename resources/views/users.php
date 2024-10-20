<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '/partials/header.php';
?>

<body style="background-color: white; color:black;">
    <!--- Define your structure here --->
    <h1 style="font-size: 6em;">Users</h1>
    <?php
   
    echo "<ul>";
    foreach($users as $columns){
        foreach($columns as $k => $v){
            echo "<li>$k: $v</li>";
        }
        echo "<hr>";
    }
    
    ?>
</body>

</html>
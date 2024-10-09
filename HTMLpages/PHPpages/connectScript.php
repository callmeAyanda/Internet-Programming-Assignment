<?php
    $db_server = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "socialapp_db";

    $connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);

    if (!$connection) {
        error_log("Connection failed: " . mysqli_connect_error(), 0);
        die("There was a problem connecting to the database.");
    }

    mysqli_set_charset($connection, "utf8");

    mysqli_close($connection);
?>


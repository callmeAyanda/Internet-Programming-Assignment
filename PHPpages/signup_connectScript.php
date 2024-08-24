<?php

    $db_server = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "socialapp_db";
    $connection = "";

    try {
        $connection = mysqli_connect($db_server, 
                            $db_username, 
                            $db_password, 
                            $db_name);
    }
    catch (mysqli_sql_exception){
        echo "Could not connect. <br>";
    }

    if ($connection){
        echo "You are connected. <br>";
    }


    
?>

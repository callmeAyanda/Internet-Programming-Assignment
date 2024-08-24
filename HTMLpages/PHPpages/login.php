<?php
    include("login_connectScript.php");
    //include("HTMLpages/login.html");

    if (isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['password'];

/*
        $sql = "INSERT INTO login
        VALUES ('$username', '$email', '$phone')";

        if ($connection->query($sql) === TRUE){
            echo "New record created successfully";
        }
        else{
            echo "Error: {$sql} <br> {$connection->error}";
        }


    }
        
*/

    $connection->close();
?>

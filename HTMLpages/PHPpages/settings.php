<?php
    include("settings_connectScript.php");
    //include("HTMLpages/settings.html");


    if (isset($_POST['submit'])){
        $updateusername = $_POST['username'];
        $updateemail = $_POST['email'];
        $updatepassword = $_POST['password'];

//add new user
        $newusername = $_POST['username'];
        $newemail = $_POST['email'];
        $newpassword = $_POST['password'];

//deleting a user
        $deleteuser = $_POST['delete_username'];


/*
        $sql = "INSERT INTO settings
        VALUES ('$updateusername', '$updateemail', '$updatepassword', '$newusername', '$newemail', '$newpassword', '$deleteuser')";

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

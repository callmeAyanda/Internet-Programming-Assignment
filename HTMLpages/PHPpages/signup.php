<?php
    include("signup_connectScript.php");
    //include("HTMLpages/signUp.html");


    if (isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];


/*
        $sql = "INSERT INTO signup
        VALUES ('$firstname', '$lastname', '$email', '$phonenumber', '$username', '$pasword', '$confirmpassword')";

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

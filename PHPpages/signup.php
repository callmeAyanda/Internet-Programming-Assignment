<?php
    include("signup_connectScript.php");
    //include("form.html");

    if (isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];


/*
        $sql = "INSERT INTO student_info(student_id, first_name, last_name, course_id, email, phone, course_name)
        VALUES ('$student_id', '$first_name', '$last_name', '$course_id', '$email', '$phone', '$course_name')";

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

<?php
    include("login_connectScript.php");
    //include("form.html");

    if (isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['password'];

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

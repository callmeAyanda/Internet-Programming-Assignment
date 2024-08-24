<?php
    include("settings_connectScript.php");
    //include("form.html");

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

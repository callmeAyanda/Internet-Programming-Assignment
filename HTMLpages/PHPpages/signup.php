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
    // Insert user data into the users table
    $sql = "INSERT INTO users (firstname, lastname, email, phonenumber, username, password)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssss", $firstname, $lastname, $email, $phonenumber, $username, $password);

    if ($stmt->execute()) {
        $user_id = $connection->insert_id;

        // Log the signup event
        $sql_signup = "INSERT INTO signup (user_id) VALUES (?)";
        $stmt_signup = $connection->prepare($sql_signup);
        $stmt_signup->bind_param("i", $user_id);
        $stmt_signup->execute();

        echo "User signed up successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
        
*/

    $stmt->close();
?>

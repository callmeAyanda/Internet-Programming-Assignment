<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Start a session for session management

// Include database connection (update credentials as per your setup)
include("connectScript.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validate if all required fields are provided
    if (!empty($_POST['firstname']) && 
    !empty($_POST['lastname']) && !empty($_POST['email']) && 
    !empty($_POST['phonenumber']) && !empty($_POST['username']) && 
    !empty($_POST['password']) && !empty($_POST['confirmpassword'])) {
        
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];

        // Validate if passwords match
        if ($password === $confirmpassword) { // Corrected
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Check if username or email already exists
            $check_sql = "SELECT * FROM users WHERE username = ? OR email = ?";
            $stmt = $conn->prepare($check_sql);
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "Username or email already taken.";
            } else {
                // Insert user data into the database
                $sql = "INSERT INTO users (firstname, lastname, email, phonenumber, username, password) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $firstname, $lastname, $email, $phonenumber, $username, $hashed_password); // Corrected

                if ($stmt->execute()) {
                    // Set session variables and redirect to home.php
                    $_SESSION['user_id'] = $conn->insert_id; // Get new user's ID
                    $_SESSION['username'] = $username;
                    
                    // Redirect to home.php
                    header("Location: dashboard.html");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
        } else {
            echo "Passwords do not match!";
        }
    } else {
        header("Location: signup2.html");
    }
}

?>


<?php
    include("connectScript.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize input
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        
        $sql = "SELECT user_id, password FROM users WHERE username = ? AND email = ?";
        $stmt = $connection->prepare($sql);
        
        if (!$stmt) {
            die("Error in query: " . $connection->error);
        }
        
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->bind_result($user_id, $hashed_password);
        
        if ($stmt->fetch()) {
            // Verifying the password
            if (password_verify($password, $hashed_password)) {
                // Log the login event
                $sql_login = "INSERT INTO login (user_id) VALUES (?)";
                $stmt_login = $connection->prepare($sql_login);
                $stmt_login->bind_param("i", $user_id);
                $stmt_login->execute();

                // Start session and set user_id
                session_start();
                $_SESSION['user_id'] = $user_id;
                header("Location: ../HTMLpages/dashboard.html");
                exit();
            } else {
                // Password mismatch
                echo "Invalid password. Please try again.";
            }
        } else {
            // User not found
            echo "User not found or email is incorrect.";
        }

        // Closing statements
        $stmt->close();
        $stmt_login->close();
        $connection->close();
    }
?>

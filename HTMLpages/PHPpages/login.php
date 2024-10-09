<?php
    include("connectScript.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize input
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        // SQL query to get user information
        $sql = "SELECT user_id, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql); // Ensure `$conn` is correct

        if (!$stmt) {
            die("Error in query: " . $conn->error); // Correct variable name
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($user_id, $hashed_password);

        if ($stmt->fetch()) {
            // Verifying the password
            if (password_verify($password, $hashed_password)) {
                // Log the login event
                $sql_login = "INSERT INTO login (user_id) VALUES (?)";
                $stmt_login = $conn->prepare($sql_login);

                if (!$stmt_login) {
                    die("Error in query: " . $conn->error);
                }

                $stmt_login->bind_param("i", $user_id);

                if (!$stmt_login->execute()) {
                    die("Error logging login event: " . $stmt_login->error); // Error handling for login event
                }

                // Start session and set user_id
                session_start();
                $_SESSION['user_id'] = $user_id;
                header("Location: ../HTMLpages/dashboard.php");
                exit();
            } else {
                // Password mismatch
                echo "Invalid password. Please try again.";
            }
        } else {
            // User not found
            echo "User not found or username is incorrect."; // Corrected message
        }

        // Closing statements
        $stmt->close();
        
        // Close only if initialized
        if ($stmt_login) {
            $stmt_login->close();
        }
        
        $conn->close(); // Correct variable name
    }
?>

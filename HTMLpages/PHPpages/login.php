<?php
    include("connectScript.php");
    include("HTMLpages/login.html");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = ?, email = ?, password = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();
        $stmt->bind_result($username, $email, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Log the login event
            $sql_login = "INSERT INTO login (user_id) VALUES (?)";
            $stmt_login = $connection->prepare($sql_login);
            $stmt_login->bind_param("i", $user_id);
            $stmt_login->execute();

            echo "Login successful.";
            
            session_start();
            $_SESSION['user_id'] = $user_id;
            header("Location: dashboard.html");
            exit();

        } else {
            echo "Either your username, email or password is incorrect.";
        }

        $stmt->close();
        $connection->close();
    }
?>

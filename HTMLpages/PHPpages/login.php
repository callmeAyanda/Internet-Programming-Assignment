<?php
    include("login_connectScript.php");
    include("HTMLpages/login.html");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT user_id, password FROM users WHERE username = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Log the login event
            $sql_login = "INSERT INTO login (user_id) VALUES (?)";
            $stmt_login = $connection->prepare($sql_login);
            $stmt_login->bind_param("i", $user_id);
            $stmt_login->execute();

            echo "Login successful.";
        } else {
            echo "Invalid username or password.";
        }

        $stmt->close();
        $connection->close();
    }
?>

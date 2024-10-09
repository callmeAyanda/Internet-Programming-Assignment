<?php
session_start();
include("connectScript.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender_id = $_SESSION['user_id'];  // Assume the sender is logged in and their user_id is stored in the session
    $receiver_username = $_POST['receiver'];
    $message_text = $_POST['message'];

    // Get receiver's user_id based on their username
    $sql = "SELECT user_id FROM users WHERE username = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $receiver_username);
    $stmt->execute();
    $stmt->bind_result($receiver_id);
    $stmt->fetch();
    $stmt->close();

    if ($receiver_id) {
        // Insert the message into the messages table
        $sql_insert = "INSERT INTO messages (sender_id, receiver_id, message_text) VALUES (?, ?, ?)";
        $stmt_insert = $connection->prepare($sql_insert);
        $stmt_insert->bind_param("iis", $sender_id, $receiver_id, $message_text);

        if ($stmt_insert->execute()) {
            echo "Message sent successfully!";
            header("Location: inbox.php"); // Redirect to the inbox page after sending the message
            exit();
        } else {
            echo "Error: " . $stmt_insert->error;
        }
        $stmt_insert->close();
    } else {
        echo "User not found.";
    }
}
?>

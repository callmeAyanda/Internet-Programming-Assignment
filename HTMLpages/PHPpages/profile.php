<?php
session_start();
include("connectScript.php");

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$sql_posts = "SELECT * FROM posts WHERE user_id = ?";
$stmt_posts = $connection->prepare($sql_posts);
$stmt_posts->bind_param("i", $user_id);
$stmt_posts->execute();
$posts_result = $stmt_posts->get_result();
?>

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="CSSpages/profile.css">
</head>
<body>
    <h2>My Profile</h2>
    <div class="user-info">
        <p>Name: <?php echo $user['firstname'] . " " . $user['lastname']; ?></p>
        <p>Email: <?php echo $user['email']; ?></p>
    </div>
    <div class="user-posts">
        <h3>My Posts</h3>
        <?php while ($post = $posts_result->fetch_assoc()): ?>
            <div class="post">
                <img src="<?php echo $post['image_path']; ?>" alt="Post Image">
                <p><?php echo $post['caption']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

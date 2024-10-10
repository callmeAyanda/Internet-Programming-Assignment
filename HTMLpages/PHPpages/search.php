<?php
// Get search query from URL parameter
$searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';

if ($searchQuery) {
    // Escape special characters to prevent SQL injection
    $searchQuery = $conn->real_escape_string($searchQuery);

    // SQL query to search for users by username
    $sql = "SELECT username, email FROM users WHERE username LIKE '%$searchQuery%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Search Results for: " . htmlspecialchars($searchQuery) . "</h3>";
        echo "<ul>";
        // Output search results
        while ($row = $result->fetch_assoc()) {
            echo "<li>Username: " . htmlspecialchars($row['username']) . " | Email: " . htmlspecialchars($row['email']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No users found with the username '$searchQuery'.</p>";
    }
} else {
    echo "<p>Please enter a username to search.</p>";
}

// Close the connection
$conn->close();
?>

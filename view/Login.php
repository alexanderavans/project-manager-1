<!-- Auth.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add your CSS stylesheets and other head elements here -->
</head>
<body>

<?php
// Start the session
//session_start();

// Check if the user is logged in
if (isset($_SESSION['userId'])) {
    // If logged in, display the username and logout option
    echo '<p>Welkom, ' . $_SESSION['username'] . '!</p>';
    echo '<p>Jouw rol is ' . $_SESSION['role'] . '!</p>';
    echo '<a href="?controller=UserController&action=logout">Logout</a>';
} else {
    // If not logged in, display the login form
    if (isset($_GET['error'])) {
        echo '<p style="color: red;">' . $_GET['error'] . '</p>';
    }
    
    // Authentication form
    echo '
    <form action="?controller=UserController&action=login" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>';
}

?>


</body>
</html>

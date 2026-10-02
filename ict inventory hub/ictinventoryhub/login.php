<?php

session_start();
include("connection.php");

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users 
            WHERE username='$username' 
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1)
    {
        // Get the user's details
        $user = mysqli_fetch_assoc($result);

        // Store user information in the session
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Go to dashboard
        header("Location: dashboard.php");
        exit();
    }
    else
    {
        echo "<script>alert('Invalid Username or Password');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICT Inventory Hub</title>

    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="login-container">

    <div class="login-box">

        <h1>ICT Inventory Hub</h1>

        <p>Please login to continue</p>

        <form action="" method="POST">

            <label>Username</label>

            <input
                type="text"
                name="username"
                placeholder="Enter Username"
                required>

            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Enter Password"
                required>

            <button type="submit" name="login">
                Login
            </button>

        </form>

    </div>

</div>

</body>
</html>
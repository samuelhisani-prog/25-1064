<?php

include("connection.php");
session_start();

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

if($_SESSION['role'] != 'admin')
{
    die("Access Denied. Only administrators can access this page.");
}

$message = "";

if(isset($_POST['adduser']))
{
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $department = $_POST['department'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $status = "Active";

    // Check if passwords match
    if($password != $confirm_password)
    {
        $message = "Passwords do not match!";
    }
    else
    {
        // Check if username already exists
        $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

        if(mysqli_num_rows($check) > 0)
        {
            $message = "Username already exists!";
        }
        else
        {
            $sql = "INSERT INTO users(fullname, username, email, phone, role, department, password, status)
                    VALUES('$fullname','$username','$email','$phone','$role','$department','$password','$status')";

            if(mysqli_query($conn, $sql))
            {
                $message = "User added successfully!";
            }
            else
            {
                $message = "Error: " . mysqli_error($conn);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>

   
    <link rel="stylesheet" href="adduser.css">
</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main-content">

    <h2>Add Users</h2>

    <hr>

    <?php
    if($message != "")
    {
        echo "<p class='message'>$message</p>";
    }
    ?>

    <form method="POST">

        <table>

            <tr>

                <td>
                    <label>Full Name</label><br>
                    <input
                        type="text"
                        name="fullname"
                        placeholder="Enter Full Name"
                        required>
                </td>

                <td>
                    <label>Username</label><br>
                    <input
                        type="text"
                        name="username"
                        placeholder="Enter Username"
                        required>
                </td>

            </tr>

            <tr>

                <td>
                    <label>Email Address</label><br>
                    <input
                        type="email"
                        name="email"
                        placeholder="example@kpc.co.ke"
                        required>
                </td>

                <td>
                    <label>Phone Number</label><br>
                    <input
                        type="text"
                        name="phone"
                        placeholder="07XXXXXXXX"
                        required>
                </td>

            </tr>

            <tr>

                <td>

                    <label>User Role</label><br>

                    <select name="role">

                        <option value="Administrator">Administrator</option>
                        <option value="ICT Technician">ICT Technician</option>
                        <option value="Viewer">Viewer</option>

                    </select>

                </td>

                <td>

                    <label>Department</label><br>

                    <select name="department">

                        <option value="ICT">ICT</option>
                        <option value="Finance">Finance</option>
                        <option value="Human Resource">Human Resource</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Procurement">Procurement</option>

                    </select>

                </td>

            </tr>

            <tr>

                <td>

                    <label>Password</label><br>

                    <input
                        type="password"
                        name="password"
                        required>

                </td>

                <td>

                    <label>Confirm Password</label><br>

                    <input
                        type="password"
                        name="confirm_password"
                        required>

                </td>

            </tr>

        </table>

        <br>

        <button type="submit" name="adduser">
            Add User
        </button>

        <button type="reset">
            Clear
        </button>

    </form>

</div>

</body>
</html>
<?php

include("connection.php");

$sql = "SELECT * FROM users ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="sidebar.css">

    <title>Users</title>
</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main-content">

    <h1>System Users</h1>

    <br><br>

    <table>

        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Department</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
        ?>

        <tr>

            <td><?php echo $row['id']; ?></td>

            <td><?php echo $row['fullname']; ?></td>

            <td><?php echo $row['username']; ?></td>

            <td><?php echo $row['email']; ?></td>

            <td><?php echo $row['phone']; ?></td>

            <td><?php echo $row['role']; ?></td>

            <td><?php echo $row['department']; ?></td>

            <td><?php echo $row['status']; ?></td>

            <td>

                <a href="edituser.php?id=<?php echo $row['id']; ?>">
                    <button>Edit</button>
                </a>

                <a href="deleteuser.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this user?');">
                    <button>Delete</button>
                </a>

            </td>

        </tr>

        <?php
            }
        }
        else
        {
        ?>

        <tr>
            <td colspan="9">No users found.</td>
        </tr>

        <?php
        }
        ?>

    </table>

</div>

</body>
</html>
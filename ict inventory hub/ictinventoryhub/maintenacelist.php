<?php

include("connection.php");

$sql = "SELECT * FROM maintenance ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Maintenance List</title>


<link rel="stylesheet" href="maintenacelist.css">

</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main-content">

<h1>Maintenance Management</h1>

<div class="top-bar">

<a href="schedulemaintenance.php">
<button>+ Schedule Maintenance</button>
</a>


</div>

<table>

<tr>



<th>Asset Type</th>
<th>Asset Tag</th>
<th>Asset Model</th>
<th>Serial Number</th>
<th>Date done</th>
<th>Technician</th>
<th>Status</th>
<th>Action</th>


</tr>

<?php

if(mysqli_num_rows($result)>0)
{
    while($row=mysqli_fetch_assoc($result))
    {
?>

<tr>


<td><?php echo $row['asset_type']; ?></td>
<td><?php echo $row['asset_tag']; ?></td>
<td><?php echo $row['asset_model']; ?></td>
<td><?php echo $row['serial_number']; ?></td>
<td><?php echo $row['maintenance_date']; ?></td>
<td><?php echo $row['technician']; ?></td>
<td><?php echo $row['status']; ?></td>




<td>
    <a href="viewmaintenance.php?id=<?php echo $row['id']; ?>">
        <button type="button">View</button>
    </a>

    <a href="editmaintenance.php?id=<?php echo $row['id']; ?>">
        <button type="button">Edit</button>
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

<td colspan="12">No maintenance records found.</td>

</tr>

<?php
}
?>

</table>

</div>

</body>
</html>
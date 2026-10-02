<?php
include("connection.php");

// TOTAL ITEMS
$sql = "SELECT COUNT(*) AS total_assets
        FROM assets";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$total_assets = $row['total_assets'];


// ISSUED ITEMS
// assignedto is NOT empty
$sql = "SELECT COUNT(*) AS issued_assets
        FROM assets
        WHERE assignedto IS NOT NULL
        AND assignedto != ''";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$issued_assets = $row['issued_assets'];


// AVAILABLE ITEMS
// assignedto is empty
$sql = "SELECT COUNT(*) AS available_assets
        FROM assets
        WHERE assignedto IS NULL
        OR assignedto = ''";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$available_assets = $row['available_assets'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventory Management System - Dashboard</title>

    <link rel="stylesheet" href="sidebar.css">

    <link rel="stylesheet" href="dashboard.css">

</head>


<body>


<?php include("sidebar.php"); ?>


<div class="main-content">


    <!-- ============================= -->
    <!-- HEADER -->
    <!-- ============================= -->

    <div class="header">

        <div>

            <h1>Dashboard</h1>

            <p>Welcome</p>

        </div>


        <div>

            <h3>ICT INVENTORY HUB</h3>

        </div>

    </div>



    <!-- ============================= -->
    <!-- SUMMARY CARDS -->
    <!-- ============================= -->

    <div class="cards">


        <!-- TOTAL ASSETS -->

        <div class="card">

            <h3>Total Items</h3>

            <h1>
                <?php echo $total_assets; ?>
            </h1>

        </div>



        <!-- AVAILABLE ASSETS -->

        <div class="card">

            <h3>Available Items</h3>

            <h1>
                <?php echo $available_assets; ?>
            </h1>

        </div>



        <!-- ISSUED ASSETS -->

        <div class="card">

            <h3>Issued Items</h3>

            <h1>
                <?php echo $issued_assets; ?>
            </h1>

        </div>


    </div>



    <!-- ============================= -->
    <!-- RECENT ACTIVITIES -->
    <!-- ============================= -->

    <div class="table-section">

    <h2>Recent Activities</h2>

    <?php

    // GET THE FIVE MOST RECENT ASSETS
    $sql = "SELECT *
            FROM assets
            ORDER BY id DESC
            LIMIT 5";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0)
    {

        while($row = mysqli_fetch_assoc($result))
        {

    ?>

        <p>
            <strong>Asset Tag:</strong>
            <?php echo htmlspecialchars($row['assettag']); ?>

            &nbsp; | &nbsp;

            <strong>Model:</strong>
            <?php echo htmlspecialchars($row['assetmodel']); ?>

            &nbsp; | &nbsp;

            <strong>Type:</strong>
            <?php echo htmlspecialchars($row['assettype']); ?>

            &nbsp; | &nbsp;

            <strong>Assigned To:</strong>
            <?php
            if(empty($row['assignedto']))
            {
                echo "Not Assigned";
            }
            else
            {
                echo htmlspecialchars($row['assignedto']);
            }
            ?>

            &nbsp; | &nbsp;

            <strong>Status:</strong>
            <?php
            if(empty($row['assignedto']))
            {
                echo "Available";
            }
            else
            {
                echo "Issued";
            }
            ?>
        </p>

    <?php

        }

    }
    else
    {

    ?>

        <p>No recent activities found.</p>

    <?php

    }

    ?>

</div>


    <!-- ============================= -->
    <!-- QUICK ACTIONS -->
    <!-- ============================= -->

    <div class="actions">

        <h2>Quick Actions</h2>


        <button
            onclick="window.location.href='addasset.php'">

            Add New Item

        </button>



        <button
            onclick="window.location.href='assingassest.php'">

            Assign New Item

        </button>


    </div>


</div>


</body>

</html>
<?php
include("connection.php");

// DELETE ASSET
if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    $sql = "DELETE FROM assets WHERE id='$id'";

    if(mysqli_query($conn, $sql))
    {
        header("Location: assetlist.php");
        exit();
    }
    else
    {
        die("Error deleting asset: " . mysqli_error($conn));
    }
}


// LOAD ASSET FOR EDITING
if(isset($_GET['edit']))
{
    $id = $_GET['edit'];

    $sql = "SELECT * FROM assets WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    $asset = mysqli_fetch_assoc($result);
}


// UPDATE ASSET
if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $assettype = $_POST['assettype'];
    $assetmodel = $_POST['assetmodel'];
    $serialnumber = $_POST['serialnumber'];
    $assettag = $_POST['assettag'];
    $assignedto = $_POST['assignedto'];
    $department = $_POST['department'];
    $status = $_POST['status'];

    $sql = "UPDATE assets SET
            assettype='$assettype',
            assetmodel='$assetmodel',
            serialnumber='$serialnumber',
            assettag='$assettag',
            assignedto='$assignedto',
            department='$department',
            status='$status'
            WHERE id='$id'";

    if(mysqli_query($conn, $sql))
    {
        header("Location: assetlist.php");
        exit();
    }
    else
    {
        echo "Error updating asset: " . mysqli_error($conn);
    }
}


// SEARCH AND SORT
$search = "";
$category = "";

if(isset($_GET['search']))
{
    $search = $_GET['search'];
}

if(isset($_GET['category']))
{
    $category = $_GET['category'];
}


// BUILD SQL QUERY
$sql = "SELECT * FROM assets WHERE 1=1";


// SEARCH
if($search != "")
{
    $sql .= " AND (
        assettype LIKE '%$search%'
        OR assetmodel LIKE '%$search%'
        OR serialnumber LIKE '%$search%'
        OR assettag LIKE '%$search%'
        OR assignedto LIKE '%$search%'
        OR department LIKE '%$search%'
        OR status LIKE '%$search%'
    )";
}


// SORT BY CATEGORY
if($category != "")
{
    $sql .= " AND assettype='$category'";
}


$sql .= " ORDER BY assettype ASC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventory List</title>

    <link rel="stylesheet" href="assetlist.css">

</head>

<body>

<?php include("sidebar.php"); ?>


<div class="main-content">

    <div class="header">

        <h1>Inventory List</h1>

        <button onclick="window.location.href='addasset.php'">
            Add New Item
        </button>

    </div>


    <br>


    <!-- SEARCH AND SORT -->

    <form method="GET" class="search">

        <input
            type="text"
            name="search"
            placeholder="Search Item"
            value="<?php echo htmlspecialchars($search); ?>"
        >


        <button type="submit">
            Search
        </button>


        <!-- SORT BY CATEGORY -->

        <select name="category">

            <option value="">All Categories</option>

            <option value="Desktop"
                <?php if($category == "Desktop") echo "selected"; ?>>
                Desktop
            </option>

            <option value="Laptop"
                <?php if($category == "Laptop") echo "selected"; ?>>
                Laptop
            </option>

            <option value="Printer"
                <?php if($category == "Printer") echo "selected"; ?>>
                Printer
            </option>

            <option value="Monitor"
                <?php if($category == "Monitor") echo "selected"; ?>>
                Monitor
            </option>

            <option value="Router"
                <?php if($category == "Router") echo "selected"; ?>>
                Router
            </option>

            <option value="Switch"
                <?php if($category == "Switch") echo "selected"; ?>>
                Switch
            </option>

        </select>


        <button type="submit">
            Sort
        </button>


        <!-- CLEAR SEARCH -->

        <button
            type="button"
            onclick="window.location.href='assetlist.php'">
            Clear
        </button>

    </form>


    <br>


    <!-- INVENTORY TABLE -->

    <table>

        <tr>

            <th>Asset Type</th>

            <th>Asset Model</th>

            <th>Serial Number</th>

            <th>Asset Tag</th>

            <th>Assigned To</th>

            <th>Department</th>

            
            <th>Action</th>

        </tr>


        <?php

        if(mysqli_num_rows($result) > 0)
        {

            while($row = mysqli_fetch_assoc($result))
            {

        ?>

        <tr>

            <td>
                <?php echo $row['assettype']; ?>
            </td>

            <td>
                <?php echo $row['assetmodel']; ?>
            </td>

            <td>
                <?php echo $row['serialnumber']; ?>
            </td>

            <td>
                <?php echo $row['assettag']; ?>
            </td>

            <td>
                <?php echo $row['assignedto']; ?>
            </td>

            <td>
                <?php echo $row['department']; ?>
            </td>

           

            <td>

                <a href="editasset.php?id=<?php echo $row['id']; ?>">

                    <button type="button">
                        Edit
                    </button>

                </a>


                <a
                    href="assetlist.php?delete=<?php echo $row['id']; ?>"
                    onclick="return confirm('Are you sure you want to delete this asset?');"
                >

                    <button type="button">
                        Delete
                    </button>

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

            <td colspan="8">
                No assets found.
            </td>

        </tr>

        <?php

        }

        ?>

    </table>

</div>

</body>

</html>
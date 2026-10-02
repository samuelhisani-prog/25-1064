<?php

include("connection.php");


// ==============================
// LOAD ASSET DETAILS
// ==============================

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM assets WHERE id='$id'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $asset = mysqli_fetch_assoc($result);

    } else {

        die("Asset not found.");

    }

} else {

    die("No asset ID provided.");

}


// ==============================
// UPDATE ASSET
// ==============================

if (isset($_POST['update'])) {

    // Get the asset ID
    $id = $_POST['id'];

    // Get form values
    $assettype = $_POST['asset_type'];
    $assetmodel = $_POST['asset_model'];
    $serialnumber = $_POST['serial_number'];
    $assettag = $_POST['asset_tag'];
    $assignedto = $_POST['assigned_to'];
    $department = $_POST['department'];


    // Update query
    $sql = "UPDATE assets SET

            assettype='$assettype',
            assetmodel='$assetmodel',
            serialnumber='$serialnumber',
            assettag='$assettag',
            assignedto='$assignedto',
            department='$department'

            WHERE id='$id'";


    // Execute update
    if (mysqli_query($conn, $sql)) {

        // Go back to asset list
        header("Location: assetlist.php");
        exit();

    } else {

        echo "Error updating asset: " . mysqli_error($conn);

    }

}

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Asset</title>

    <link rel="stylesheet" href="editasset.css">

</head>


<body>


<?php include("sidebar.php"); ?>


<div class="main-content">


    <div class="form-container">


        <div class="form-header">

            <h3>Edit Asset</h3>

        </div>


        <form method="POST">


            <!-- IMPORTANT: KEEP THE ASSET ID -->
            <input
                type="hidden"
                name="id"
                value="<?php echo $asset['id']; ?>"
            >


            <div class="form-grid">


                <!-- Asset Type -->

                <div class="form-group">

                    <label>1. Asset Type</label>

                    <select name="asset_type" required>

                        <option value="Desktop"
                        <?php
                        if ($asset['assettype'] == "Desktop")
                            echo "selected";
                        ?>>
                            Desktop
                        </option>

                        <option value="Laptop"
                        <?php
                        if ($asset['assettype'] == "Laptop")
                            echo "selected";
                        ?>>
                            Laptop
                        </option>

                        <option value="Printer"
                        <?php
                        if ($asset['assettype'] == "Printer")
                            echo "selected";
                        ?>>
                            Printer
                        </option>

                        <option value="Monitor"
                        <?php
                        if ($asset['assettype'] == "Monitor")
                            echo "selected";
                        ?>>
                            Monitor
                        </option>

                        <option value="Router"
                        <?php
                        if ($asset['assettype'] == "Router")
                            echo "selected";
                        ?>>
                            Router
                        </option>

                        <option value="Switch"
                        <?php
                        if ($asset['assettype'] == "Switch")
                            echo "selected";
                        ?>>
                            Switch
                        </option>

                    </select>

                </div>


                <!-- Asset Model -->

                <div class="form-group">

                    <label>2. Asset Model</label>

                    <input
                        type="text"
                        name="asset_model"
                        value="<?php echo $asset['assetmodel']; ?>"
                        required
                    >

                </div>


                <!-- Serial Number -->

                <div class="form-group">

                    <label>3. Serial Number</label>

                    <input
                        type="text"
                        name="serial_number"
                        value="<?php echo $asset['serialnumber']; ?>"
                        required
                    >

                </div>


                <!-- Asset Tag -->

                <div class="form-group">

                    <label>4. Asset Tag</label>

                    <input
                        type="text"
                        name="asset_tag"
                        value="<?php echo $asset['assettag']; ?>"
                        required
                    >

                </div>


                <!-- Assigned To -->

                <div class="form-group">

                    <label>5. Assigned To</label>

                    <input
                        type="text"
                        name="assigned_to"
                        value="<?php echo $asset['assignedto']; ?>"
                        required
                    >

                </div>


                <!-- Department -->

                <div class="form-group">

                    <label>6. Department</label>

                    <select name="department" required>

                        <option value="ICT"
                        <?php
                        if ($asset['department'] == "ICT")
                            echo "selected";
                        ?>>
                            ICT
                        </option>

                        <option value="Finance"
                        <?php
                        if ($asset['department'] == "Finance")
                            echo "selected";
                        ?>>
                            Finance
                        </option>

                        <option value="Human Resource"
                        <?php
                        if ($asset['department'] == "Human Resource")
                            echo "selected";
                        ?>>
                            Human Resource
                        </option>

                        <option value="Procurement"
                        <?php
                        if ($asset['department'] == "Procurement")
                            echo "selected";
                        ?>>
                            Procurement
                        </option>

                        <option value="Engineering"
                        <?php
                        if ($asset['department'] == "Engineering")
                            echo "selected";
                        ?>>
                            Engineering
                        </option>

                    </select>

                </div>


            </div>


            <hr>


            <!-- BUTTONS -->

            <div class="button-group">


                <button
                    type="button"
                    onclick="window.location.href='assetlist.php'"
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    name="update"
                >
                    Update Asset
                </button>


            </div>


        </form>


    </div>


</div>


</body>

</html>
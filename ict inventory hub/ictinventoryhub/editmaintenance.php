<?php

include("connection.php");


// GET MAINTENANCE RECORD
if(isset($_GET['id']))
{
    $id = $_GET['id'];

    // GET RECORD FROM DATABASE
    $sql = "SELECT * FROM maintenance WHERE id='$id'";

    $result = mysqli_query($conn, $sql);

    // CHECK IF RECORD EXISTS
    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
    }
    else
    {
        echo "Maintenance record not found.";
        exit();
    }
}
else
{
    echo "No maintenance record selected.";
    exit();
}


// UPDATE MAINTENANCE RECORD
if(isset($_POST['update']))
{
    $asset_type = $_POST['asset_type'];
    $asset_tag = $_POST['asset_tag'];
    $asset_model = $_POST['asset_model'];
    $serial_number = $_POST['serial_number'];
    $maintenance_date = $_POST['maintenance_date'];
    $technician = $_POST['technician'];
    $maintenance_type = $_POST['maintenance_type'];
    $status = $_POST['status'];
    $fault_description = $_POST['fault_description'];
    $maintenance_performed = $_POST['maintenance_performed'];


    $update_sql = "UPDATE maintenance SET

        asset_type='$asset_type',
        asset_tag='$asset_tag',
        asset_model='$asset_model',
        serial_number='$serial_number',
        maintenance_date='$maintenance_date',
        technician='$technician',
        maintenance_type='$maintenance_type',
        status='$status',
        fault_description='$fault_description',
        maintenance_performed='$maintenance_performed'

        WHERE id='$id'
    ";


    if(mysqli_query($conn, $update_sql))
    {
        header("Location: maintenacelist.php");
        exit();
    }
    else
    {
        echo "Error updating maintenance record: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Maintenance</title>

    <link rel="stylesheet" href="viewmaintenance.css">

</head>

<body>

<?php include("sidebar.php"); ?>


<h2>Edit Asset Maintenance</h2>

<hr>


<form method="POST">

    <table>

        <!-- ASSET TYPE + ASSET TAG -->

        <tr>

            <td>

                <label>Asset Type</label><br>

                <select name="asset_type" required>

                    <option value="Laptop"
                        <?php if($row['asset_type'] == 'Laptop') echo 'selected'; ?>>
                        Laptop
                    </option>

                    <option value="Desktop"
                        <?php if($row['asset_type'] == 'Desktop') echo 'selected'; ?>>
                        Desktop
                    </option>

                    <option value="Printer"
                        <?php if($row['asset_type'] == 'Printer') echo 'selected'; ?>>
                        Printer
                    </option>

                    <option value="Monitor"
                        <?php if($row['asset_type'] == 'Monitor') echo 'selected'; ?>>
                        Monitor
                    </option>

                    <option value="Router"
                        <?php if($row['asset_type'] == 'Router') echo 'selected'; ?>>
                        Router
                    </option>

                    <option value="Switch"
                        <?php if($row['asset_type'] == 'Switch') echo 'selected'; ?>>
                        Switch
                    </option>

                </select>

            </td>


            <td>

                <label>Asset Tag</label><br>

                <input
                    type="text"
                    name="asset_tag"
                    value="<?php echo htmlspecialchars($row['asset_tag']); ?>"
                    required
                >

            </td>

        </tr>


        <!-- ASSET MODEL + SERIAL NUMBER -->

        <tr>

            <td>

                <label>Asset Model</label><br>

                <input
                    type="text"
                    name="asset_model"
                    value="<?php echo htmlspecialchars($row['asset_model']); ?>"
                    required
                >

            </td>


            <td>

                <label>Serial Number</label><br>

                <input
                    type="text"
                    name="serial_number"
                    value="<?php echo htmlspecialchars($row['serial_number']); ?>"
                    required
                >

            </td>

        </tr>


        <!-- DATE + TECHNICIAN -->

        <tr>

            <td>

                <label>Maintenance Date</label><br>

                <input
                    type="date"
                    name="maintenance_date"
                    value="<?php echo $row['maintenance_date']; ?>"
                    required
                >

            </td>


            <td>

                <label>Working Technician</label><br>

                <input
                    type="text"
                    name="technician"
                    value="<?php echo htmlspecialchars($row['technician']); ?>"
                    required
                >

            </td>

        </tr>


        <!-- MAINTENANCE TYPE + STATUS -->

        <tr>

            <td>

                <label>Maintenance Type</label><br>

                <select name="maintenance_type" required>

                    <option value="Preventive"
                        <?php if($row['maintenance_type'] == 'Preventive') echo 'selected'; ?>>
                        Preventive
                    </option>

                    <option value="Corrective"
                        <?php if($row['maintenance_type'] == 'Corrective') echo 'selected'; ?>>
                        Corrective
                    </option>

                    <option value="Repair"
                        <?php if($row['maintenance_type'] == 'Repair') echo 'selected'; ?>>
                        Repair
                    </option>

                    <option value="Software Update"
                        <?php if($row['maintenance_type'] == 'Software Update') echo 'selected'; ?>>
                        Software Update
                    </option>

                    <option value="Hardware Replacement"
                        <?php if($row['maintenance_type'] == 'Hardware Replacement') echo 'selected'; ?>>
                        Hardware Replacement
                    </option>

                </select>

            </td>


            <td>

                <label>Status</label><br>

                <select name="status" required>

                    <option value="Pending"
                        <?php if($row['status'] == 'Pending') echo 'selected'; ?>>
                        Pending
                    </option>

                    <option value="In Progress"
                        <?php if($row['status'] == 'In Progress') echo 'selected'; ?>>
                        In Progress
                    </option>

                    <option value="Completed"
                        <?php if($row['status'] == 'Completed') echo 'selected'; ?>>
                        Completed
                    </option>

                </select>

            </td>

        </tr>


        <!-- FAULT DESCRIPTION -->

        <tr>

            <td colspan="2">

                <label>Fault Description</label><br>

                <textarea
                    name="fault_description"
                    rows="3"
                    placeholder="Describe the reported fault..."
                ><?php echo htmlspecialchars($row['fault_description']); ?></textarea>

            </td>

        </tr>


        <!-- MAINTENANCE PERFORMED -->

        <tr>

            <td colspan="2">

                <label>Maintenance Performed</label><br>

                <textarea
                    name="maintenance_performed"
                    rows="3"
                    placeholder="Describe the maintenance performed..."
                ><?php echo htmlspecialchars($row['maintenance_performed']); ?></textarea>

            </td>

        </tr>

    </table>


    <br>


    <!-- BUTTONS -->

    <button type="submit" name="update">
        Update Maintenance Record
    </button>


    <button
        type="button"
        onclick="window.location.href='maintenacelist.php'">
        Cancel
    </button>


</form>


<br><br>


</body>

</html>
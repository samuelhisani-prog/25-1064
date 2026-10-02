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

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Maintenance</title>

    <link rel="stylesheet" href="viewmaintenance.css">

</head>

<body>

<?php include("sidebar.php"); ?>


<h2>View Asset Maintenance</h2>

<hr>


<form>

    <table>

        <!-- ASSET TYPE + ASSET TAG -->
        <tr>

            <td>

                <label>Asset Type</label><br>

                <select name="asset_type" disabled>

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
                    readonly
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
                    readonly
                >

            </td>


            <td>

                <label>Serial Number</label><br>

                <input
                    type="text"
                    name="serial_number"
                    value="<?php echo htmlspecialchars($row['serial_number']); ?>"
                    readonly
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
                    readonly
                >

            </td>


            <td>

                <label>Working Technician</label><br>

                <input
                    type="text"
                    name="technician"
                    value="<?php echo htmlspecialchars($row['technician']); ?>"
                    readonly
                >

            </td>

        </tr>


        <!-- MAINTENANCE TYPE + STATUS -->
        <tr>

            <td>

                <label>Maintenance Type</label><br>

                <select name="maintenance_type" disabled>

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

                <select name="status" disabled>

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
                    readonly
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
                    readonly
                ><?php echo htmlspecialchars($row['maintenance_performed']); ?></textarea>

            </td>

        </tr>

    </table>


    <br>


    <!-- BUTTONS -->

    <button
        type="button"
        onclick="window.location.href='editmaintenance.php?id=<?php echo $row['id']; ?>'">
        Edit
    </button>


    <button
        type="button"
        onclick="window.location.href='maintenacelist.php'">
        Back
    </button>


</form>


<br><br>


</body>

</html>
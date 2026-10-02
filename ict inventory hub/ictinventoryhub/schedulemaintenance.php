<?php

include("connection.php");

// SAVE MAINTENANCE RECORD
if(isset($_POST['save']))
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

    $sql = "INSERT INTO maintenance
            (
                asset_type,
                asset_tag,
                asset_model,
                serial_number,
                maintenance_date,
                technician,
                maintenance_type,
                status,
                fault_description,
                maintenance_performed
            )
            VALUES
            (
                '$asset_type',
                '$asset_tag',
                '$asset_model',
                '$serial_number',
                '$maintenance_date',
                '$technician',
                '$maintenance_type',
                '$status',
                '$fault_description',
                '$maintenance_performed'
            )";

    if (mysqli_query($conn, $sql)) 
        {$message = "Maintenance record saved successfully!"; 
         $message_type = "success"; } 
    else 
        { $message = "Error saving maintenance record: " . mysqli_error($conn); 
    $message_type = "error"; } }


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Asset Maintenance</title>

    <link rel="stylesheet" href="schedulemaintenance.css">

</head>

<body>

<?php include("sidebar.php"); ?>


<h2>Asset Maintenance</h2>

<hr>


<form method="POST">

    <table>

        <tr>

            <td>

                <label>Asset Type</label><br>

                <select name="asset_type" required>

                    <option value="Laptop">Laptop</option>

                    <option value="Desktop">Desktop</option>

                    <option value="Printer">Printer</option>

                    <option value="Monitor">Monitor</option>

                    <option value="Router">Router</option>

                    <option value="Switch">Switch</option>

                </select>

            </td>


            <td>

                <label>Asset Tag</label><br>

                <input
                    type="text"
                    name="asset_tag"
                    placeholder="KPC/ICT/LAP/001"
                    required
                >

            </td>

        </tr>


        <tr>

            <td>

                <label>Asset Model</label><br>

                <input
                    type="text"
                    name="asset_model"
                    placeholder="HP ProBook 450 G8"
                    required
                >

            </td>


            <td>

                <label>Serial Number</label><br>

                <input
                    type="text"
                    name="serial_number"
                    required
                >

            </td>

        </tr>


        <tr>

            <td>

                <label>Maintenance Date</label><br>

                <input
                    type="date"
                    name="maintenance_date"
                    required
                >

            </td>


            <td>

                <label>Working Technician</label><br>

                <input
                    type="text"
                    name="technician"
                    required
                >

            </td>

        </tr>


        <tr>

            <td>

                <label>Maintenance Type</label><br>

                <select name="maintenance_type" required>

                    <option value="Preventive">Preventive</option>

                    <option value="Corrective">Corrective</option>

                    <option value="Repair">Repair</option>

                    <option value="Software Update">Software Update</option>

                    <option value="Hardware Replacement">
                        Hardware Replacement
                    </option>

                </select>

            </td>


            <td>

                <label>Status</label><br>

                <select name="status" required>

                    <option value="Pending">Pending</option>

                    <option value="In Progress">
                        In Progress
                    </option>

                    <option value="Completed">
                        Completed
                    </option>

                </select>

            </td>

        </tr>


        <tr>

            <td colspan="2">

                <label>Fault Description</label><br>

                <textarea
                    name="fault_description"
                    rows="3"
                    cols="30"
                    placeholder="Describe the reported fault..."
                ></textarea>

            </td>

        </tr>


        <tr>

            <td colspan="2">

                <label>Maintenance Performed</label><br>

                <textarea
                    name="maintenance_performed"
                    rows="3"
                    cols="30"
                    placeholder="Describe the maintenance performed..."
                ></textarea>

            </td>

        </tr>

    </table>


    <br>


    <button type="submit" name="save">
        Save Maintenance Record
    </button>


    <button type="reset">
        Cancel
    </button>

</form>


<br><br>


</body>

</html>
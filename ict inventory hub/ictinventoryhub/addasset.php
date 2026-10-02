<?php
include("connection.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $assettype = $_POST['asset_type'];
    $assetmodel = $_POST['asset_model'];
    $serialnumber = $_POST['serial_number'];
    $assettag = $_POST['asset_tag'];
    

    $sql = "INSERT INTO assets
            (assettype, assetmodel, serialnumber, assettag)
            VALUES
            ('$assettype', '$assetmodel', '$serialnumber', '$assettag')";

    if (mysqli_query($conn, $sql))
    {
        $message = "Asset added successfully!";
    }
    else
    {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Asset</title>

    <link rel="stylesheet" href="addasset.css">
</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main-content">

    <div>

        <h3>Add Asset</h3>

        <?php
        if($message != "")
        {
            echo "<p>$message</p>";
        }
        ?>

        <form method="POST">

            <div>

                <!-- Asset Type -->
                <div>

                    <label>1. Asset Type</label>

                    <select name="asset_type" required>
                        <option value="">Select Category</option>
                        <option>Work Station</option>
                        <option>Laptop</option>
                        <option>Printer</option>
                        <option>Monitor</option>
                        <option>Router</option>
                        <option>Switch</option>
                    </select>

                </div>

                <!-- Asset Model -->
                <div>

                    <label>2. Asset Model</label>

                    <input
                        type="text"
                        name="asset_model"
                        placeholder="Enter asset model"
                        required>

                </div>

                <!-- Serial Number -->
                <div>

                    <label>3. Serial Number</label>

                    <input
                        type="text"
                        name="serial_number"
                        placeholder="Enter Serial Number"
                        required>

                </div>

                <!-- Asset Tag -->
                <div>

                    <label>4. Asset Tag</label>

                    <input
                        type="text"
                        name="asset_tag"
                        placeholder="KPC/ICT/LAP/001"
                        required>

                </div>

                


            </div>

            <hr>

            <div>

                <button type="reset">
                    Cancel
                </button>

                <button type="submit">
                    Save Asset
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>
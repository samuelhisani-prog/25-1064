<?php
include("connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM assets WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    $asset = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign New Asset</title>

    <link rel="stylesheet" href="assingasset.css">
</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main-content">

    <div class="form-container">

        <div class="form-header">
            <h3>Assign New Asset</h3>
        </div>

        <form method="POST">

            <div class="form-grid">

                <div class="form-group">
                    <label>1. Asset Type</label>
                    <select name="asset_type">
                        <option selected>Select Category</option>
                        <option>Desktop</option>
                        <option>Laptop</option>
                        <option>Printer</option>
                        <option>Monitor</option>
                        <option>Router</option>
                        <option>Switch</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>2. Asset Model</label>
                    <input type="text" name="asset_model" placeholder="Enter asset model">
                </div>

                <div class="form-group">
                    <label>3. Serial Number</label>
                    <input type="text" name="serial_number" placeholder="Enter Serial Number">
                </div>

                <div class="form-group">
                    <label>4. Asset Tag</label>
                    <input type="text" name="asset_tag" placeholder="KPC/ICT/LAP/001">
                </div>

                <div class="form-group">
                    <label>5. Assigned To</label>
                    <input type="text" name="assigned_to" placeholder="Mr/Ms">
                </div>

                <div class="form-group">
                    <label>6. Department</label>
                    <select name="department">
                        <option selected>Select Department</option>
                        <option>ICT</option>
                        <option>Finance</option>
                        <option>Human Resource</option>
                        <option>Procurement</option>
                        <option>Engineering</option>
                    </select>
                </div>

            </div>

            <hr>

            <div class="button-group">
                <button type="button" onclick="window.location.href='assetlist.php'">
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
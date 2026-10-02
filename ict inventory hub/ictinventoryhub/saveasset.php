<?php

include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $assettype = $_POST['asset_type'];
    $assetmodel = $_POST['asset_model'];
    $serialnumber = $_POST['serial_number'];
    $assettag = $_POST['asset_tag'];
    $assignedto = $_POST['assigned_to'];
    $department = $_POST['department'];

    $sql = "INSERT INTO assets
    (assettype, assetmodel, serialnumber, assettag, assignedto, department)
    VALUES
    ('$assettype', '$assetmodel', '$serialnumber', '$assettag', '$assignedto', '$department')";

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
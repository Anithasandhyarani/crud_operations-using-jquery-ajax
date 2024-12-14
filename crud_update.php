<?php

$conn = new mysqli("localhost", "root", "", "ajax");


if (isset($_POST['country']) && isset($_POST['c_id'])) {
    $country = $conn->real_escape_string($_POST['country']);
    $id = $_POST['c_id'];


    $sql = "UPDATE crud_operations SET country_name = '$country' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "true";
    } else {
        echo "false";
    }
} else {
    echo "false";
}

$conn->close();

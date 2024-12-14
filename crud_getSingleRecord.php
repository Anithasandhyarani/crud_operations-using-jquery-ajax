<?php

$conn = new mysqli("localhost", "root", "", "ajax");





if (isset($_POST['c_id'])) {
    $id = (int)$_POST['c_id'];


    $sql = "SELECT country_name FROM crud_operations WHERE id = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['country_name'];
    } else {
        echo "Error: Country not found";
    }
} else {
    echo "Error: Country ID not provided";
}

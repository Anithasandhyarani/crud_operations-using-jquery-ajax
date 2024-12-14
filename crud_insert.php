<?php

$conn = new mysqli("localhost", "root", "", "database");




if (isset($_POST['country'])) {
    $country = $conn->real_escape_string($_POST['country']);


    $sql = "INSERT INTO crud_operations (country_name) VALUES ('$country')";

    if ($conn->query($sql) === TRUE) {
        echo "true";
    } else {
        echo "false";
    }
} else {
    echo "false";
}

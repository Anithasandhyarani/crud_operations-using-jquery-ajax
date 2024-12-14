<?php

$conn = new mysqli("localhost", "root", "", "ajax");



if (isset($_POST['c_id'])) {
    $id = (int)$_POST['c_id'];


    $sql = "DELETE FROM crud_operations WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "true";
    } else {
        echo "false";
    }
} else {
    echo "false";
}

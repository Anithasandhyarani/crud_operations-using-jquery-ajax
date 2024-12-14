<?php

$conn = new mysqli("localhost", "root", "", "ajax");

$sql = "SELECT * FROM crud_operations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo '<div class="row mb-2">';
        echo '<div class="col-9">' . $row['country_name'] . '</div>';
        echo '<div class="col-3">';
        echo '<button class="btn btn-primary me-2 edit-btn" data-id="' . $row['id'] . '">Edit</button>';

        echo '<button class="btn btn-danger delete-btn" data-id="' . $row['id'] . '">Delete</button>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No countries found";
}

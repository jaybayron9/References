<?php
$conn = new mysqli('localhost', 'root', '', 'rev');

// select all rows from the user table
$query = $conn->query("SELECT * FROM user");

// create an array to hold the data
$data = array();

// loop through the rows and add them to the array
while($row = $query->fetch_assoc()) {
    $data[] = $row;
}

// return the data as a JSON array
echo json_encode($data);
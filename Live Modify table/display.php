<?php 

$conn = new mysqli('localhost', 'root', '', 'rev');

$id = $_POST['rowData'];

$query = $conn->query("SELECT * FROM user WHERE user_id = '$id'");

foreach($query as $row){
    echo json_encode($row);
}
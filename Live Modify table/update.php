<?php 

$conn = new mysqli('localhost', 'root', '', 'rev');

$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];

$query = $conn->query("UPDATE user SET fname='$fname', lname='$lname' WHERE user_id = $id");

$resp['msg'] = 'hello';
echo json_encode($resp);
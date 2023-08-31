<?php

session_start();

$_SESSION['name'] = $_POST['name'];
$_SESSION['price'] = $_POST['price'];


// session_destroy();
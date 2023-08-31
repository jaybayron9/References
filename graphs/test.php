<?php 

$inv = require 'config.php';

extract($inv);
extract($mysql);

echo $host . '<br>';
echo $username . '<br>';
echo $password . '<br>';
echo $dbname . '<br>';
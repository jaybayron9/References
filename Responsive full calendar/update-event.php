<?php
$db = new mysqli("localhost", "root", "", "rev");

// get event data
$id = $_POST['id'];
$start = $_POST['start'];

// convert start date and time to separate variables
$date = date('Y-m-d', strtotime($start));
$time = date('g:i a', strtotime($start));

// update event in the database
$query = "UPDATE schedule SET date_sched = '$date', time_sched = '$time' WHERE schedule_id = '$id'";
mysqli_query($db, $query);

echo 'Event updated';
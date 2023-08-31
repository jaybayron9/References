<?php

$db = new mysqli("localhost", "root", "", "rev");

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Select the events from the database
$result = $db->query("SELECT u.*, s.*, d.* FROM user u INNER JOIN schedule s USING(user_id) INNER JOIN description d USING(schedule_id)");

// Create an array to hold the events
$events = array();

// Add each event to the array
$status = '#00C6E8';
while ($row = $result->fetch_assoc()) {
    $date = $row['date_sched'] . ' ' . $row['time_sched'];
    $datetime = DateTime::createFromFormat('Y-m-d h:i a', $date);
    $formatted_date = $datetime->format('Y-m-d\TH:i:s');
    
    if($row['status'] == 'Accepted'){
        $status = '#88E068';
    }elseif($row['status'] == 'Declined'){
        $status = '#FF3917';
    }

    $event = array(
        'id' => $row['schedule_id'],
        'title' => $row['service'],
        'start' => $formatted_date,
        'time' => date('g:i a', strtotime($row['time_sched'])),
        'color' => $status
    );
    array_push($events, $event);
}

// Output the events as a JSON array
header('Content-Type: application/json');
echo json_encode($events);

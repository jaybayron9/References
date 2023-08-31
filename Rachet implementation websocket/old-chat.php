<?php 
use DBConn\DBConn; 

require_once 'DBConn.php';

$db = new DBConn(); 

$data = $db->DBQuery( "SELECT * FROM convo 
    WHERE 
        (from_user = '{$_POST['from_user']}' AND send_to = '{$_POST['send_to']}') OR
        (from_user = '{$_POST['send_to']}' AND send_to = '{$_POST['from_user']}')" ); 

foreach($data as $row) {  
        $user = $_POST['from_user'] == $row['from_user'] ? 'text-right' : 'text-left'; 
        echo '<div class="block '. $user .'"><span class="bg-blue-600 px-2 text-white font-ligh rounded-full text-lg">'. $row['message'] .'</span></div>'; 
}
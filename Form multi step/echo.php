<?php 
if (isset($_POST['submit'])) {
    $new = $_POST['new'];
    $return = $_POST['return'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    echo $new;
    echo $return;
    echo $date;
    echo $time;
    echo $fname;
    echo $lname;
}

?>
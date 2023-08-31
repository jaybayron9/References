<?php
//export.php  
if (isset($_POST["export"])) {
     $connect = mysqli_connect("localhost", "root", "", "testing");
     header('Content-Type: text/csv; charset=utf-8');
     header('Content-Disposition: attachment; filename=data.csv');
     $output = fopen("php://output", "w");
     fputcsv($output, array('id', 'first_name', 'last_name', 'age', 'gender', 'Date_created'));
     $query = "SELECT * from customer ORDER BY id DESC";
     $result = mysqli_query($connect, $query);
     while ($row = mysqli_fetch_assoc($result)) {
          fputcsv($output, $row);
     }
     fclose($output);
}

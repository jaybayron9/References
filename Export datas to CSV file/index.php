<?php
$connect = mysqli_connect("localhost", "root", "", "testing");
$query = "SELECT * FROM customer ORDER BY id desc";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>

<head>
     <title>Webslesson Tutorial | Export Mysql Table Data to CSV file in PHP</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
     <br /><br />
     <div class="container" style="width:900px;">
          <h2 align="center">Export Mysql Table Data to CSV file in PHP</h2>
          <h3 align="center">Employee Data</h3>
          <br />
          <form method="post" action="export.php" align="center">
               <input type="submit" name="export" value="CSV Export" class="btn btn-success" />
          </form>
          <br />
          <div class="table-responsive" id="employee_table">
               <table class="table table-bordered">
                    <tr>
                         <th width="5%">ID</th>
                         <th width="25%">first_name</th>
                         <th width="35%">last_name</th>
                         <th width="10%">age</th>
                         <th width="20%">gender</th>
                         <th width="5%">Date_created</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                         <td><?php echo $row["id"]; ?></td>
                         <td><?php echo $row["first_name"]; ?></td>
                         <td><?php echo $row["last_name"]; ?></td>
                         <td><?php echo $row["age"]; ?></td>
                         <td><?php echo $row["gender"]; ?></td>
                         <td><?php echo $row["Date_created"]; ?></td>
                    </tr>
                    <?php
                    }
                    ?>
               </table>
          </div>
     </div>
</body>

</html>
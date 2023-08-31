<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "copy_cjce";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the backup filename
$backupFilename = 'backup.sql';

// Open the backup file
$backupFile = fopen($backupFilename, 'w');

// Get all table names in the database
$tables = array();
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Iterate through each table and write its structure and data to the backup file
foreach ($tables as $table) {
    // Add table structure to the backup file
    $result = $conn->query("SHOW CREATE TABLE $table");
    $row = $result->fetch_row();
    fwrite($backupFile, $row[1] . ";\n");

    // Add table data to the backup file
    $result = $conn->query("SELECT * FROM $table");
    while ($row = $result->fetch_row()) {
        $rowData = implode("','", $row);
        fwrite($backupFile, "INSERT INTO $table VALUES ('$rowData');\n");
    }
}

// Close the backup file
fclose($backupFile);

// Provide the download link
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($backupFilename) . '"');
header('Content-Length: ' . filesize($backupFilename));
readfile($backupFilename);

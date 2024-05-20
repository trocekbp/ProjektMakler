
<?php
 $conn = new mysqli("localhost", "root", "", "maklerdb");
 if ($conn->connect_error) {
    exit("Connection failed: " . $conn->connect_error);
 }
?>

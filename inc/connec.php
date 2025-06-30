<!-- Why 'connec' ?x? note to self: dun forget to add try except rule for docker run -->
<?php
    $username = "root";
    $pass = "";
    $host = "localhost";
    $database = "db_tasklyze";

    $conn = mysqli_connect($host, $username, $pass, $database);
?>
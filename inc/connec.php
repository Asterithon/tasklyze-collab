<?php // Fallback to localhost if not found in env using ?: (Not exposing password) (Just a docker function)
$host     = getenv("DB_HOST") ?: "localhost";
$username = getenv("DB_USER") ?: "root";
$password = getenv("DB_PASS") ?: "";
$database = getenv("DB_NAME") ?: "db_tasklyze";

$conn = mysqli_connect($host, $username, $password, $database);

// Error MsG
if (!$conn) {
    exit("Gagal terkoneksi Database: " . mysqli_connect_error());
}
?>

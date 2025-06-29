<?php
    include '../inc/connec.php';
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pass = md5($_POST["password"]);

    $sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$pass')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
        window.location = '../';</script>";
    } else {
    echo "<script>alert('Account Failed to create');
        window.location = '../';</script>";
    }
?>
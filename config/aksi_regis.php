<?php
    include '../inc/connec.php';
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pass = $_POST["password"];

    $sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$pass')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Account succesfully created');
        window.location = '../';</script>";
    } else {
    echo "<script>alert('Account Failed to create');
        window.location = '../';</script>";
    }
?>
<?php
session_start();
include '../inc/connec.php';

$username=$_POST['username'];
$password=md5($_POST['password']);
$login = mysqli_query($conn, "SELECT * from user where username='$username' and password='$password'");

$cek = mysqli_num_rows($login);

if ($cek > 0) {
$data =mysqli_fetch_assoc($login);
$_SESSION['level'] = "user";
$_SESSION['id_user'] = $data['id_user'];
$_SESSION['username'] = $data['username'];
header(header: 'location:../?user=' . $_SESSION['username'] . '&id=' . $_SESSION['id_user'] . '' . $_SESSION['level'] . '');
} 

else {
echo "<script>
  alert('username atau password tidak terdaftar');
  window.location = '../';
</script>
";
}
?>
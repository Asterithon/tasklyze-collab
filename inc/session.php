<?php
session_start();
include 'connec.php';

$username=$_POST['username'];
$password=md5($_POST['password']);
$login = mysqli_query($koneksi, "SELECT * from user where username='$username' and password='$password'");

$cek = mysqli_num_rows($login);

if ($cek > 0) {
$data =mysqli_fetch_assoc($login);

if ($data['level'] == 'user') {
$_SESSION['user_id'] = $data['user_id'];
$_SESSION['username'] = $data['username'];
header('location:../');
} 

else {
echo "<script>
  alert('username atau password tidak terdaftar');
  window.location = '../';
</script>
";
}
}
?>
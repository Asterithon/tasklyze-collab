<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tasklyze</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link href="css/styles.css" rel="stylesheet" /> -->
     <!-- sementara cdn dulu -->
    <!-- Font Awesome 6.7.2 via CDNJS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="style/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="style/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="style/css/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="style/css/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="style/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="style/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="style/css/daterangepicker.css">

</head>

<body class="font-sans sidebar-collapse">

  <!-- Navbar -->
  <header class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
      <h1 class="text-xl font-bold text-blue-600">Tasklyze</h1>
      <nav>
        <ul class="flex space-x-6 text-sm font-medium">
          <li><a href="#features" class="hover:text-blue-500">Fitur</a></li>
          <li><a href="#demo" class="hover:text-blue-500">Demo</a></li>
          <li><a href="#about" class="hover:text-blue-500">Tentang</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Hero -->
  <section class="bg-blue-100 py-10">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-4xl font-bold mb-4">Kelola Proyekmu Tanpa Ribet</h2>
      <p class="text-lg mb-6 text-gray-700">Dashboard ringan, cepat, dan fokus pada produktivitas.</p>
      <a href="register.php" class="mt-8 inline-block bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition">Masuk Dashboard</a>
    </div>
  </section>

<!-- Features -->
<section id="features" class="py-20">
  <div class="max-w-5xl mx-auto px-4">
    <h3 class="text-2xl font-bold mb-8 text-center">Fitur Utama</h3>
    <div class="grid md:grid-cols-3 gap-8">

      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition text-center">
        <img src="asset\img\feature_1.webp" alt="Minimalism" class="mx-auto h-16 mb-4">
        <h4 class="font-semibold text-lg mb-2">Minimalism</h4>
        <p class="text-sm text-gray-600">Less is more, diperpadukan dengan gaya minimalistik yang indah.</p>
      </div>

      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition text-center">
        <img src="asset\img\feature_2.webp" alt="Kanban Style" class="mx-auto h-16 mb-4">
        <h4 class="font-semibold text-lg mb-2">Kanban Style</h4>
        <p class="text-sm text-gray-600">Memudahkan organisasi tugas dan capaian.</p>
      </div>

      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition text-center">
        <img src="asset\img\feature_3.webp" alt="Kolaborasi Mudah" class="mx-auto h-16 mb-4">
        <h4 class="font-semibold text-lg mb-2">Kolaborasi Mudah</h4>
        <p class="text-sm text-gray-600">Undang teman, buat tim, dan selesaikan task bareng-bareng.</p>
      </div>

    </div>
  </div>
</section>



  <!-- Demo -->
  <section id="demo" class="bg-gray-100 py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
      <h3 class="text-2xl font-bold mb-4">Preview Langsung</h3>
      <p class="mb-6 text-gray-600">Penasaran seperti apa? Lihat preview dashboard kami.</p>
      <iframe src="asset/img/dashboard_preview.webp"class="w-full h-[80vh] border rounded-xl shadow-inner"></iframe>
    </div>
  </section>

  <!-- About -->
  <section id="about" class="py-20">
    <div class="max-w-3xl mx-auto px-4 text-center">
      <h3 class="text-2xl font-bold mb-4">Tentang Kami</h3>
      <p class="text-gray-600">Kami mahasiswa yang lelah dengan UI ribet. Jadi kami buat solusi yang sederhana dan to the point.</p>
    </div>
  </section>

  <!-- Footer -->
  <div class="" style="min-height:60px"></div>
    <footer class="main-footer fixed-bottom" style="min-height:60px">
        <strong>Copyright &copy; 2025 <a href="../">tasklyze.com</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.2.0
        </div>
    </footer>

</body>
</html>

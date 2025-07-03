<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="180x180" href="asset/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="asset/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="asset/favicon/favicon-16x16.png">
  <link rel="manifest" href="asset/favicon/site.webmanifest">
  <title>Tasklyze</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- AdminLTE & Plugins -->
  <link rel="stylesheet" href="style/css/all.min.css">
  <link rel="stylesheet" href="style/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="style/css/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="style/css/jqvmap.min.css">
  <link rel="stylesheet" href="style/css/adminlte.min.css">
  <link rel="stylesheet" href="style/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="style/css/daterangepicker.css">
</head>

<body class="font-[\'Source Sans Pro\'] bg-gray-50">

  <!-- Navbar -->
  <header class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
    <img src="asset/img/logo_2.webp" alt="logo" class="h-14 md:h-20" loading="lazy">
      <nav>
        <ul class="flex space-x-6 text-sm mb-0 items-center font-medium text-gray-700">
          <li><a href="#features" class="hover:text-blue-600 transition">Fitur</a></li>
          <li><a href="#demo" class="hover:text-blue-600 transition">Demo</a></li>
          <li><a href="#about" class="hover:text-blue-600 transition">Tentang</a></li>
          <li>
            <?php include 'login.php';?>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Hero -->
  <section class="bg-blue-100 py-16">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-5xl font-bold mb-4 text-blue-600">Kelola Proyekmu Tanpa Ribet</h2>
      <p class="text-lg mb-6 text-gray-700">Dashboard ringan, cepat, dan fokus pada produktivitas.</p>
      <button href="register.php" data-bs-toggle="modal" data-bs-target="#login" class="mt-8 inline-block bg-blue-600 text-white px-8 py-3 rounded-full hover:bg-blue-700 transition duration-300 shadow-md">Masuk Dashboard</button>
    </div>
  </section>

  <!-- Features -->
  <section id="features" class="py-20">
    <div class="max-w-5xl mx-auto px-4">
      <h3 class="text-3xl font-bold mb-10 text-center text-gray-800">Fitur Utama</h3>
      <div class="grid md:grid-cols-3 gap-8">

        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition text-center">
          <img src="asset/img/feature_1.webp" alt="Minimalism" class="mx-auto h-20 mb-4">
          <h4 class="font-semibold text-xl mb-2 text-gray-800">Minimalism</h4>
          <p class="text-sm text-gray-600">Less is more, diperpadukan dengan gaya minimalistik yang indah.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition text-center">
          <img src="asset/img/feature_2.webp" alt="Kanban Style" class="mx-auto h-20 mb-4">
          <h4 class="font-semibold text-xl mb-2 text-gray-800">Kanban Style</h4>
          <p class="text-sm text-gray-600">Memudahkan organisasi tugas dan capaian.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition text-center">
          <img src="asset/img/feature_3.webp" alt="Kolaborasi Mudah" class="mx-auto h-20 mb-4">
          <h4 class="font-semibold text-xl mb-2 text-gray-800">Kolaborasi Mudah</h4>
          <p class="text-sm text-gray-600">Undang teman, buat tim, dan selesaikan task bareng-bareng.</p>
        </div>

      </div>
    </div>
  </section>

  <!-- Demo -->
  <section id="demo" class="bg-gray-100 py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
      <h3 class="text-3xl font-bold mb-6 text-gray-800">Preview Langsung</h3>
      <p class="mb-6 text-gray-600">Penasaran seperti apa? Lihat preview dashboard kami.</p>
      <iframe src="asset/img/dashboard_preview.webp" class="w-full h-[80vh] border rounded-xl shadow-inner"></iframe>
    </div>
  </section>

  <!-- About -->
  <section id="about" class="py-20">
    <div class="max-w-3xl mx-auto px-4 text-center">
      <h3 class="text-3xl font-bold mb-4 text-gray-800">Tentang Kami</h3>
      <p class="text-gray-600 leading-relaxed">Kami mahasiswa yang lelah dengan UI ribet. Jadi kami buat solusi yang sederhana dan to the point.</p>
    </div>
  </section>

  <!-- Footer -->
  <div class="h-20"></div>
  <footer class="bg-white border-t py-4 text-center shadow-inner">
    <div class="text-gray-600 text-sm">
      <strong>&copy; 2025 <a href="../" class="text-blue-600 hover:underline">tasklyze.com</a>.</strong> All rights reserved.
    </div>
    <div class="text-xs text-gray-400 mt-1">
      <b>Version</b> 1.2.0
    </div>
  </footer>

</body>
</html>
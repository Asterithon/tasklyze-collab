<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="container mb-5">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">➕ Tambah Proyek Baru</h5>
          </div>
          <div class="card-body">
            <form action="config/aksi_new_project.php" method="POST">
              <!-- Nama Proyek -->
              <div class="mb-3">
                <label for="projectName" class="form-label fw-semibold">Nama Proyek</label>
                <input type="text" class="form-control" id="projectName" name="projectName"
                  placeholder="Masukkan nama proyek" required>
              </div>

              <!-- Deskripsi Proyek -->
              <div class="mb-3">
                <label for="projectDesc" class="form-label fw-semibold">Deskripsi Proyek</label>
                <textarea class="form-control" id="projectDesc" name="projectDesc" rows="4"
                  placeholder="Tuliskan deskripsi singkat proyek" required></textarea>
              </div>

              <!-- Tombol Submit -->
              <button type="submit" class="btn btn-success w-100">
                Simpan Proyek 🚀
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
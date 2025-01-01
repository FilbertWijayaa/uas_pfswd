<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pekerjaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menambahkan link untuk Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #F0F8FF;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #B1F0F7;
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: #000;
        }

        .navbar-nav .nav-link:hover {
            color: #007BFF;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 50px;
            color: #333;
        }

        .section-intro {
            font-size: 1.5rem; /* Ukuran font yang lebih besar */
            text-align: center; /* Membuat teks berada di tengah */
            color: #555; /* Mengubah warna teks jika diperlukan */
            margin-bottom: 30px; /* Memberikan jarak bawah yang lebih besar */
        }       

        .search-bar {
            margin-bottom: 30px;
        }

        .card-columns {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .empty-message {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-top: 30px;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease; /* Menambahkan transisi untuk perubahan pada hover */
        }

        .card:hover {
            transform: translateY(-10px); /* Card bergerak ke atas */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3); /* Bayangan lebih tajam saat di-hover */
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand">FreelanceGo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto d-flex align-items-center"> <!-- Menambahkan d-flex dan align-items-center -->
        <?php if ($this->session->userdata('user_id')): ?> <!-- Cek login -->
            <li class="nav-item d-flex align-items-center"> <!-- Menambahkan d-flex dan align-items-center pada li -->
                <span class="nav-link me-2">
                    Selamat datang kembali, <?= htmlspecialchars($this->session->userdata('username') ?? 'Guest'); ?>!
                </span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('profile'); ?>">
                    <!-- Ikon profil bulat dengan Bootstrap Icons -->
                    <i class="bi bi-person-circle" style="font-size: 30px;"></i>  <!-- Bootstrap Icon -->
                </a> <!-- Link ke halaman profil -->
            </li>
        <?php else: ?>
            <!-- Tidak menampilkan tombol Sign In dan Sign Up lagi -->
        <?php endif; ?>
    </ul>
</div>

    </div>
</nav>

<div class="container mt-5">
    <h1 class="section-title">Pekerjaan Freelance Terbaru</h1>
    <p class="section-intro">Temukan berbagai pekerjaan freelance dengan berbagai keahlian yang bisa Anda pilih.</p>

    <div class="card-columns">
        <?php foreach ($pekerjaan as $job): ?>
            <div class="card">
                <img src="<?= base_url('assets/images/' . $job['image_url']); ?>" class="card-img-top" alt="<?= $job['title']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $job['title']; ?></h5>
                    <p class="card-text"><?= substr($job['description'], 0, 100); ?>...</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jobDetailsModal" 
                            data-job-id="<?= $job['id']; ?>"
                            data-job-title="<?= $job['title']; ?>"
                            data-job-description="<?= $job['description']; ?>"
                            data-job-client="<?= $job['username']; ?>"
                            data-job-image="<?= $job['image_url']; ?>">
                        Pelajari Lebih Lanjut
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal Detail Pekerjaan -->
<div class="modal fade" id="jobDetailsModal" tabindex="-1" aria-labelledby="jobDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="jobDetailsModalLabel">Detail Pekerjaan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 id="jobTitle"></h4>
        <p><strong>Deskripsi:</strong> <span id="jobDescription"></span></p>
        <p><strong>Client:</strong> <span id="jobClient"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="takeJobBtn">Ambil Pekerjaan Ini</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mengambil data dari tombol dan menampilkannya di modal
    const jobDetailsModal = document.getElementById('jobDetailsModal');
    jobDetailsModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Tombol yang memicu modal
        const jobId = button.getAttribute('data-job-id');
        const jobTitle = button.getAttribute('data-job-title');
        const jobDescription = button.getAttribute('data-job-description');
        const jobClient = button.getAttribute('data-job-client');
        
        // Isi modal dengan data
        document.getElementById('jobTitle').textContent = jobTitle;
        document.getElementById('jobDescription').textContent = jobDescription;
        document.getElementById('jobClient').textContent = jobClient;
        
        // Menambahkan aksi untuk tombol "Ambil Pekerjaan Ini"
        const takeJobBtn = document.getElementById('takeJobBtn');
        takeJobBtn.onclick = function() {
            window.location.href = "<?= site_url('ambil_pekerjaan'); ?>/" + jobId; // Ganti URL sesuai dengan route yang sesuai
        };
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pekerjaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F0F8FF;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #B1F0F7;
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: #000; /* Mengubah warna teks navbar menjadi hitam */
        }

        .navbar-nav .nav-link:hover {
            color: #007BFF;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .card img {
            border-radius: 15px 15px 0 0;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 25px;
        }

        .card-title {
            font-size: 1.6rem;
            font-weight: bold;
            color: #333;
        }

        .card-text {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 20px;
        }

        .btn-learn-more {
            background-color: #007BFF;
            color: #fff;
            padding: 12px 25px;
            border-radius: 25px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            transition: background-color 0.3s ease;
            text-decoration: none; /* Menghilangkan underline */
        }

.btn-learn-more:hover {
    background-color: #0056b3;
}


        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 50px;
            color: #333;
        }

        .card-columns {
            column-count: 3;
            column-gap: 30px;
        }

        @media (max-width: 768px) {
            .card-columns {
                column-count: 1;
            }
        }

        .section-intro {
            text-align: center;
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 30px;
        }

        .search-bar {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="Home.php">FreelanceGo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Menampilkan pesan selamat datang jika pengguna sudah login -->
                <li class="nav-item">
                    <a class="nav-link" href="#">Selamat Datang Kembali, <?= isset($data['user']) ? $data['user'] : 'Guest' ?></a>
                </li>
                <!-- Jika pengguna sudah login, tampilkan logo profil, jika tidak tampilkan tombol Sign In dan Sign Up -->
                <?php if (isset($data['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="ProfilePage.php">
                            <img src="path_to_profile_logo.png" alt="Profile Logo" style="width: 30px; height: 30px; border-radius: 50%;">
                        </a>
                    </li>
                <?php else: ?>
                    <a class="nav-link" href="<?= site_url('signin'); ?>">Sign In</a>
                    <a class="nav-link" href="<?= site_url('signup'); ?>">Sign Up</a>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


<div class="container mt-5">
    <h1 class="section-title">Pekerjaan Freelance Terbaru</h1>
    <p class="section-intro">Temukan berbagai pekerjaan freelance dengan berbagai keahlian yang bisa Anda pilih. Setiap pekerjaan sudah disesuaikan dengan tingkat kesulitan dan pengalaman yang dibutuhkan.</p>

    <!-- Pencarian Pekerjaan -->
    <div class="search-bar text-center">
        <input type="text" class="form-control" placeholder="Cari pekerjaan..." id="searchInput" onkeyup="searchJobs()">
    </div>

    <div class="card-columns" id="jobList">
        <!-- Pekerjaan 1 -->
        <div class="card">
            <img src="images/pekerjaan1.jpg" class="card-img-top" alt="Pekerjaan 1">
            <div class="card-body">
                <h5 class="card-title">Desain Grafis</h5>
                <p class="card-text">Bergabung dengan proyek desain grafis untuk membuat logo kreatif dan branding untuk startup yang sedang berkembang.</p>
                <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
            </div>
        </div>

        <!-- Pekerjaan 2 -->
        <div class="card">
            <img src="images/pekerjaan2.jpg" class="card-img-top" alt="Pekerjaan 2">
            <div class="card-body">
                <h5 class="card-title">Pengembangan Web</h5>
                <p class="card-text">Membutuhkan pengembang untuk membuat situs e-commerce yang user-friendly dan responsif di berbagai perangkat.</p>
                <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
            </div>
        </div>

        <!-- Pekerjaan 3 -->
        <div class="card">
            <img src="images/pekerjaan3.jpg" class="card-img-top" alt="Pekerjaan 3">
            <div class="card-body">
                <h5 class="card-title">Penulisan Konten</h5>
                <p class="card-text">Pekerjaan menulis artikel SEO untuk blog tentang teknologi dan inovasi terbaru di dunia digital.</p>
                <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
            </div>
        </div>

        <!-- Pekerjaan 4 -->
        <div class="card">
            <img src="images/pekerjaan4.jpg" class="card-img-top" alt="Pekerjaan 4">
            <div class="card-body">
                <h5 class="card-title">Manajemen Media Sosial</h5>
                <p class="card-text">Bergabung dengan tim untuk mengelola dan membuat konten kreatif untuk akun media sosial perusahaan.</p>
                <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
            </div>
        </div>

        <!-- Pekerjaan 5 -->
        <div class="card">
            <img src="images/pekerjaan5.jpg" class="card-img-top" alt="Pekerjaan 5">
            <div class="card-body">
                <h5 class="card-title">Penerjemah Bahasa</h5>
                <p class="card-text">Menerjemahkan dokumen dari bahasa Inggris ke bahasa Indonesia atau sebaliknya untuk perusahaan internasional.</p>
                <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
            </div>
        </div>

        <!-- Pekerjaan 6 -->
        <div class="card">
            <img src="images/pekerjaan6.jpg" class="card-img-top" alt="Pekerjaan 6">
            <div class="card-body">
                <h5 class="card-title">Fotografer</h5>
                <p class="card-text">Mencari fotografer berpengalaman untuk proyek foto pernikahan dan acara corporate.</p>
                <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
            </div>
        </div>
    </div>
</div>

<script>
    function searchJobs() {
        let input = document.getElementById('searchInput').value.toLowerCase();
        let jobList = document.getElementById('jobList');
        let jobs = jobList.getElementsByClassName('card');

        for (let i = 0; i < jobs.length; i++) {
            let jobTitle = jobs[i].getElementsByClassName('card-title')[0].textContent.toLowerCase();
            if (jobTitle.indexOf(input) > -1) {
                jobs[i].style.display = "";
            } else {
                jobs[i].style.display = "none";
            }
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

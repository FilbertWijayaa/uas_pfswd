<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
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
            margin-bottom: 30px;
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
            padding: 20px;
        }

        .card-title {
            font-size: 1.6rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .card-text {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 15px;
        }

        .btn-learn-more {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            text-transform: uppercase;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-learn-more:hover {
            background-color: #0056b3;
        }

        .btn-post-job {
            background-color: #28a745;
            color: #fff;
            padding: 12px 25px;
            border-radius: 25px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            transition: background-color 0.3s ease;
            margin-bottom: 30px;
            text-decoration: none; /* Menghilangkan underline */
        }


        .btn-post-job:hover {
            background-color: #218838;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 50px;
            color: #333;
        }

        .section-intro {
            text-align: center;
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 30px;
        }

        .card-columns {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('home'); ?>">FreelanceGo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <a class="nav-link" href="<?= site_url('home'); ?>">Home</a>
                <a class="nav-link" href="<?= site_url('freelancer_dashboard'); ?>">Pekerjaan</a>
                <a class="nav-link" href="<?= site_url('about'); ?>">About</a>
                <a class="nav-link" href="<?= site_url('signin'); ?>">Sign In</a>
                <a class="nav-link" href="<?= site_url('signup'); ?>">Sign Up</a>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="section-title">Dashboard Client</h1>
    <p class="section-intro">Di sini Anda bisa mengelola pekerjaan yang ingin Anda tawarkan. Untuk memulai, buatlah pekerjaan yang sesuai dengan kebutuhan Anda.</p>

    <!-- Button untuk membuat pekerjaan baru -->
    <div class="text-center mb-4">
        <a href="PostJob.php" class="btn-post-job">Post Pekerjaan Baru</a>
    </div>

    <div class="section-title mb-4">Pekerjaan Yang Telah Diposting</div>

    <div class="card-columns">
        <!-- Pekerjaan 1 -->
        <div class="card">
            <img src="images/pekerjaan1.jpg" class="card-img-top" alt="Pekerjaan 1">
            <div class="card-body">
                <h5 class="card-title">Desain Grafis</h5>
                <p class="card-text">Mencari freelancer untuk mendesain logo dan materi branding untuk perusahaan baru.</p>
                <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
            </div>
        </div>

        <!-- Pekerjaan 2 -->
        <div class="card">
            <img src="images/pekerjaan2.jpg" class="card-img-top" alt="Pekerjaan 2">
            <div class="card-body">
                <h5 class="card-title">Pengembangan Web</h5>
                <p class="card-text">Membutuhkan pengembang untuk membuat aplikasi berbasis web dengan fitur e-commerce.</p>
                <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
            </div>
        </div>

        <!-- Pekerjaan 3 -->
        <div class="card">
            <img src="images/pekerjaan3.jpg" class="card-img-top" alt="Pekerjaan 3">
            <div class="card-body">
                <h5 class="card-title">Penulisan Konten</h5>
                <p class="card-text">Pekerjaan untuk menulis artikel SEO tentang teknologi terbaru.</p>
                <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
            </div>
        </div>

        <!-- Pekerjaan 4 -->
        <div class="card">
            <img src="images/pekerjaan4.jpg" class="card-img-top" alt="Pekerjaan 4">
            <div class="card-body">
                <h5 class="card-title">Fotografer</h5>
                <p class="card-text">Butuh fotografer profesional untuk acara pernikahan.</p>
                <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

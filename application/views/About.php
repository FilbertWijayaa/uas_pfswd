<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #81BFDA;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #B1F0F7;
        }

        /* Mengubah warna teks navbar menjadi hitam */
        .navbar-brand {
            color: #000;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: #000; /* Warna hitam untuk teks navbar */
            font-weight: 500;
        }

        /* Animasi hover tidak berubah */
        .navbar-nav .nav-link:hover {
            color: #007BFF;
        }

        .about-container {
            margin-top: 50px;
        }

        .about-text {
            color: #333;
            font-size: 1.1rem;
            line-height: 1.6;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .about-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
        }

        .about-img {
            background-image: url('images/tes.png');
            background-size: cover;
            background-position: center;
            height: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            position: relative; /* Tambahkan ini untuk memastikan gambar tidak menutupi elemen lain */
        }

        .about-img::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.2); /* Ubah opacity menjadi 0.2 untuk tidak terlalu gelap */
            border-radius: 10px;
        }

        .about-img-text {
            position: absolute;
            bottom: 10%;
            left: 20px;
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .btn-learn-more {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .btn-learn-more:hover {
            background-color: #0056b3;
            color: #fff;
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
                <a class="nav-link" href="<?= site_url('pekerjaan'); ?>">Pekerjaan</a>
                <a class="nav-link" href="<?= site_url('about'); ?>">About</a>
                <a class="nav-link" href="<?= site_url('signin'); ?>">Sign In</a>
                <a class="nav-link" href="<?= site_url('signup'); ?>">Sign Up</a>
            </ul>
        </div>
    </div>
</nav>

<div class="container about-container">
    <div class="row">
        <div class="col-md-6">
            <h2 class="about-title">Tentang Kami</h2>
            <div class="about-text">
                <p>Selamat datang di aplikasi kami! Kami adalah platform yang berfokus pada menyediakan layanan terbaik bagi freelancer dan klien. Di sini, Anda bisa menemukan berbagai pekerjaan freelance yang sesuai dengan keahlian Anda, atau mencari freelancer untuk membantu kebutuhan proyek Anda.</p>
                <p>Visi kami adalah menjadi jembatan antara profesional dan klien, menciptakan peluang baru dalam dunia pekerjaan jarak jauh.</p>
                <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="about-img">
                <div class="about-img-text">Inovasi tanpa batas</div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

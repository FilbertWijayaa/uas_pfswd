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
            color: #000;
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

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 50px;
            color: #333;
        }

        .section-intro {
    font-size: 1.5rem; /* Increase font size */
    text-align: center; /* Center the text */
    margin-bottom: 40px; /* Add some spacing below the text */
    color: #333; /* Ensure the text color stands out */
}


        .btn-post-job {
            background-color: #28a745;
            color: #fff;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: bold;
            text-decoration: none;
            margin-bottom: 30px;
        }

        .btn-post-job:hover {
            background-color: #218838;
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
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('home'); ?>">FreelanceGo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if ($this->session->userdata('user_id')): ?> <!-- Check if logged in -->
                    <li class="nav-item d-flex align-items-center">
                        <span class="nav-link me-2">
                            Selamat datang kembali, <?= htmlspecialchars($this->session->userdata('username') ?? 'Guest'); ?>!
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('profile'); ?>">
                            <i class="bi bi-person-circle" style="font-size: 30px;"></i> 
                        </a>
                    </li>
                <?php else: ?>
                    <!-- Optionally add sign-in/sign-up links if the user is not logged in -->
                <?php endif; ?>
                <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Akun Saya
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
    <li><a class="dropdown-item" href="<?= site_url('profile'); ?>">Profile</a></li>
        <li><a class="dropdown-item" href="<?= site_url('client_dashboard/inbox'); ?>">Inbox</a></li>
    </ul>
</li>

            </ul>
        </div>
    </div>
</nav>



<div class="container mt-5">
    <h1 class="section-title">Dashboard Client</h1>
    <p class="section-intro">Di sini Anda bisa mengelola pekerjaan yang ingin Anda tawarkan. Untuk memulai, buatlah pekerjaan yang sesuai dengan kebutuhan Anda.</p>

    <!-- Menampilkan flash message jika ada error -->
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <!-- Button untuk membuat pekerjaan baru -->
    <div class="text-center mb-4">
        <button class="btn-post-job" data-bs-toggle="modal" data-bs-target="#postJobModal">Post Pekerjaan Baru</button>
    </div>

    <div class="section-title mb-4">Pekerjaan Yang Telah Diposting</div>

    <div class="card-columns" id="jobList">
        <?php if (empty($jobs)): ?>
            <div class="empty-message">Belum ada pekerjaan yang diposting.</div>
        <?php else: ?>
            <?php foreach ($jobs as $job): ?>
                <div class="card">
                    <img src="<?= base_url('assets/images/' . $job['image_url']); ?>" class="card-img-top" alt="<?= $job['title']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $job['title']; ?></h5>
                        <p class="card-text"><?= $job['description']; ?></p>
                        <p><strong>Status:</strong> <?= $job['status']; ?></p> <!-- Menampilkan status pekerjaan -->
                        <!-- Tombol Edit -->
                        <button 
                            class="btn btn-warning" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editJobModal" 
                            data-id="<?= $job['id']; ?>" 
                            data-title="<?= $job['title']; ?>" 
                            data-description="<?= $job['description']; ?>" 
                            data-image="<?= $job['image_url']; ?>">
                            Edit
                        </button>
                        <!-- Tombol Hapus -->
                        <button 
                            class="btn btn-danger" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteJobModal" 
                            data-id="<?= $job['id']; ?>" 
                            data-title="<?= $job['title']; ?>">
                            Hapus
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>


    <!-- Modal Form untuk Post Pekerjaan Baru -->
    <div class="modal fade" id="postJobModal" tabindex="-1" role="dialog" aria-labelledby="postJobModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postJobModalLabel">Post Pekerjaan Baru</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Post Pekerjaan Baru -->
                    <form action="<?= site_url('client_dashboard/create_job'); ?>" method="POST">
                        <div class="form-group">
                            <label for="jobTitle">Judul Pekerjaan</label>
                            <input type="text" class="form-control" id="jobTitle" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="jobDescription">Deskripsi Pekerjaan</label>
                            <textarea class="form-control" id="jobDescription" name="description" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="jobImage">Pilih Gambar</label>
                            <select class="form-control" id="jobImage" name="image_url">
                                <?php foreach ($images as $image): ?>
                                    <option value="<?= $image; ?>"><?= $image; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" name="status" value="open"> <!-- Menambahkan status default "open" -->
                        <button type="submit" class="btn btn-primary">Post Pekerjaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form untuk Edit Pekerjaan -->
    <div class="modal fade" id="editJobModal" tabindex="-1" role="dialog" aria-labelledby="editJobModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editJobModalLabel">Edit Pekerjaan</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Edit Pekerjaan -->
                    <form action="<?= site_url('client_dashboard/edit_job'); ?>" method="POST">
                        <input type="hidden" id="editJobId" name="id">
                        <div class="form-group">
                            <label for="editJobTitle">Judul Pekerjaan</label>
                            <input type="text" class="form-control" id="editJobTitle" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="editJobDescription">Deskripsi Pekerjaan</label>
                            <textarea class="form-control" id="editJobDescription" name="description" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editJobImage">Pilih Gambar</label>
                            <select class="form-control" id="editJobImage" name="image_url">
                                <?php foreach ($images as $image): ?>
                                    <option value="<?= $image; ?>"><?= $image; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Konfirmasi Hapus Pekerjaan -->
    <div class="modal fade" id="deleteJobModal" tabindex="-1" role="dialog" aria-labelledby="deleteJobModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteJobModalLabel">Hapus Pekerjaan</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pekerjaan <strong id="deleteJobTitle"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <form action="<?= site_url('client_dashboard/delete_job'); ?>" method="POST">
                        <input type="hidden" id="deleteJobId" name="id">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mengisi data ke dalam modal Edit
        var editJobModal = document.getElementById('editJobModal');
        editJobModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Tombol yang diklik
            var id = button.getAttribute('data-id');
            var title = button.getAttribute('data-title');
            var description = button.getAttribute('data-description');
            var image = button.getAttribute('data-image');

            // Mengisi data ke input form
            editJobModal.querySelector('#editJobId').value = id;
            editJobModal.querySelector('#editJobTitle').value = title;
            editJobModal.querySelector('#editJobDescription').value = description;
            editJobModal.querySelector('#editJobImage').value = image;
        });

        // Mengisi data ke dalam modal Hapus
        var deleteJobModal = document.getElementById('deleteJobModal');
        deleteJobModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var title = button.getAttribute('data-title');
            deleteJobModal.querySelector('#deleteJobId').value = id;
            deleteJobModal.querySelector('#deleteJobTitle').textContent = title;
        });
    </script>
</body>
</html>

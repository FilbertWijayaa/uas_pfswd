<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox - Client Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .notification {
            padding: 10px;
            margin-bottom: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .notification-unread {
            background-color: #e0f7fa; /* Warna untuk notifikasi yang belum dibaca */
        }

        .notification-read {
            background-color: #ffffff; /* Warna untuk notifikasi yang sudah dibaca */
        }

        .notification-message {
            font-size: 1.1rem;
            color: #333;
        }

        .notification-time {
            font-size: 0.8rem;
            color: #888;
        }

        table th, table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<!-- Container -->
<div class="container mt-5">
    <!-- Tombol Kembali -->
    <a href="<?= site_url('client_dashboard'); ?>" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

    <h2>Inbox Anda</h2>

    <!-- Tabel Notifikasi -->
    <?php if (empty($notifications)): ?>
    <div class="alert alert-info" role="alert">
        Belum ada notifikasi baru.
    </div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Freelancer</th>
                    <th>ID Pekerjaan</th>
                    <th>Status</th>
                    <th>Diterima/Tidak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notifications as $notification): ?>
                    <tr>
                        <td><?= $notification['freelancer_id']; ?></td>
                        <td><?= $notification['job_id']; ?></td>
                        <td><?= $notification['status']; ?></td>
                        <td>
                            <select class="form-select status-dropdown" data-notification-id="<?= $notification['id']; ?>" data-freelancer-id="<?= $notification['freelancer_id']; ?>" data-job-id="<?= $notification['job_id']; ?>">
                                <option value="Menunggu" <?= ($notification['is_accepted'] == 'Menunggu') ? 'selected' : ''; ?>>Menunggu</option>
                                <option value="Diterima" <?= ($notification['is_accepted'] == 'Diterima') ? 'selected' : ''; ?>>Diterima</option>
                                <option value="Tidak diterima" <?= ($notification['is_accepted'] == 'Tidak diterima') ? 'selected' : ''; ?>>Tidak diterima</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm update-status-btn" data-notification-id="<?= $notification['id']; ?>">Perbarui Status</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Fungsi untuk memperbarui status notifikasi
    $(document).on('click', '.update-status-btn', function() {
    var button = $(this);
    var notificationId = button.data('notification-id');
    var freelancerId = button.closest('tr').find('.status-dropdown').data('freelancer-id');
    var jobId = button.closest('tr').find('.status-dropdown').data('job-id');
    var newStatus = button.closest('tr').find('.status-dropdown').val(); // Ambil status yang dipilih

    // Debug: Pastikan status yang dikirim benar
    console.log('Status yang dipilih:', newStatus);

    // Kirim AJAX untuk memperbarui status
    $.ajax({
        url: '<?= site_url("client_dashboard/update_notification_status"); ?>',
        method: 'POST',
        data: {
            notification_id: notificationId,
            freelancer_id: freelancerId,
            job_id: jobId,
            status: newStatus  // Pastikan newStatus adalah salah satu dari 'Menunggu', 'Diterima', atau 'Tidak diterima'
        },
        success: function(response) {
            var data = JSON.parse(response);
            alert(data.message); // Menampilkan pesan keberhasilan atau kegagalan
        },
        error: function() {
            alert('Gagal memperbarui status.');
        }
    });
});

</script>
</body>
</html>

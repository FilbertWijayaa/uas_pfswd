<?php
date_default_timezone_set('Asia/Jakarta');
class Client_Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'file']); // Muat helper URL dan File
        $this->load->model('Job_model'); // Muat model Job_model
        $this->load->library('session'); // Memuat library session
        $this->load->model('Notification_model'); // Memuat model Notification_model
    }

    public function index()
    {
        // Memastikan user sudah login sebagai client
        if (!$this->session->userdata('freelancer_id') || $this->session->userdata('role') !== 'client') {
            redirect('signin'); // Redirect jika tidak login atau bukan client
        }

        // Ambil semua data pekerjaan dari database
        $data['jobs'] = $this->Job_model->get_all_jobs();

        // Ambil daftar gambar dari folder assets/images
        $image_dir = FCPATH . 'assets/images';
        $images = array_diff(scandir($image_dir), ['.', '..']);
        $data['images'] = $images;

        // Tampilkan view Client_Dashboard
        $this->load->view('Client_Dashboard', $data);
    }

    public function create_job()
    {
        // Memastikan user sudah login
        if (!$this->session->userdata('freelancer_id')) {
            redirect('signin'); // Redirect jika tidak login
        }

        // Ambil data dari form
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $image_url = $this->input->post('image_url');
        $client_id = $this->session->userdata('freelancer_id'); // ID client dari session

        // Siapkan data untuk disimpan
        $data = [
            'title' => $title,
            'description' => $description,
            'image_url' => $image_url,
            'client_id' => $client_id,
            'status' => 'open', // Status pekerjaan baru adalah "open"
        ];

        // Masukkan data pekerjaan baru ke database
        if ($this->Job_model->add_job($data)) {
            redirect('client_dashboard'); // Redirect setelah sukses
        } else {
            echo "Gagal menambahkan pekerjaan baru.";
        }
    }

    public function edit_job()
    {
        // Memastikan user sudah login
        if (!$this->session->userdata('freelancer_id')) {
            redirect('signin'); // Redirect jika tidak login
        }
    
        // Ambil data dari form
        $job_id = $this->input->post('id'); // ID pekerjaan yang akan diubah
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $image_url = $this->input->post('image_url');
        $client_id = $this->session->userdata('freelancer_id'); // ID client dari session
    
        // Pastikan pekerjaan tersebut milik client yang sedang login
        $job = $this->Job_model->get_job_by_id($job_id);
        if ($job['client_id'] != $client_id) {
            // Set flashdata untuk pesan error
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengedit pekerjaan ini.');
            redirect('client_dashboard'); // Redirect ke dashboard client
            return;
        }
    
        // Siapkan data untuk diperbarui
        $data = [
            'title' => $title,
            'description' => $description,
            'image_url' => $image_url,
        ];
    
        // Perbarui data pekerjaan di database
        if ($this->Job_model->update_job($job_id, $data)) {
            redirect('client_dashboard'); // Redirect setelah sukses
        } else {
            echo "Gagal memperbarui pekerjaan.";
        }
    }
    
    public function delete_job()
    {
        // Memastikan user sudah login
        if (!$this->session->userdata('freelancer_id')) {
            redirect('signin'); // Redirect jika tidak login
        }
    
        // Ambil ID pekerjaan yang akan dihapus
        $job_id = $this->input->post('id');
        $client_id = $this->session->userdata('freelancer_id'); // ID client dari session
    
        // Pastikan pekerjaan tersebut milik client yang sedang login
        $job = $this->Job_model->get_job_by_id($job_id);
        if ($job['client_id'] != $client_id) {
            // Set flashdata untuk pesan error
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk menghapus pekerjaan ini.');
            redirect('client_dashboard'); // Redirect ke dashboard client
            return;
        }
    
        // Hapus pekerjaan dari database
        if ($this->Job_model->delete_job($job_id)) {
            // Menghapus file gambar yang terkait dengan pekerjaan
            $image_path = FCPATH . 'assets/images/' . $job['image_url'];
            if (file_exists($image_path)) {
                unlink($image_path); // Menghapus file gambar
            }
    
            redirect('client_dashboard'); // Redirect setelah sukses
        } else {
            echo "Gagal menghapus pekerjaan.";
        }
    }

    public function inbox() {
        // Ambil client_id dari sesi atau autentikasi
        $client_id = $this->session->userdata('freelancer_id');
    
        // Cek apakah client_id ada
        if (empty($client_id)) {
            show_error('Client tidak ditemukan atau belum login.', 404);
            return;
        }
    
        // Ambil data notifikasi berdasarkan client_id
        $data['notifications'] = $this->Notification_model->get_notifications2($client_id);
    
        // Load tampilan inbox
        $this->load->view('inbox_client', $data);
    }
    

    // Fungsi untuk memperbarui status notifikasi
    public function update_notification_status() {
        // Ambil data dari POST
        $notification_id = $this->input->post('notification_id');
        $status = $this->input->post('status');
    
        // Pastikan status yang diterima adalah integer atau boolean
        $valid_status = ['Menunggu', 'Diterima', 'Tidak diterima'];
        if (!in_array($status, $valid_status)) {
            // Status tidak valid, kirimkan respons error
            echo json_encode(['message' => 'Status tidak valid']);
            exit;  // Menghentikan eksekusi lebih lanjut
        }
    
        // Update status notifikasi
        $result = $this->Notification_model->update_status($notification_id, $status);
    
        // Berikan respons sesuai dengan hasil update
        if ($result) {
            echo json_encode(['message' => 'Status berhasil diperbarui.']);
        } else {
            echo json_encode(['message' => 'Gagal memperbarui status.']);
        }
    }
    
    
}
?>

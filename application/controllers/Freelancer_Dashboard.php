<?php
date_default_timezone_set('Asia/Jakarta');

class Freelancer_Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('User_model');
        $this->load->model('Job_model');
        $this->load->model('Notification_model');

        // Memastikan user login dan memiliki role freelancer
        if (!$this->session->userdata('freelancer_id') || $this->session->userdata('role') !== 'freelancer') {
            redirect('signin');  // Jika tidak login atau bukan freelancer, redirect ke halaman login
        }
    }

    public function index()
    {
        $freelancer_id = $this->session->userdata('freelancer_id');

        // Retrieve user by freelancer ID
        $user = $this->User_model->get_user_by_id($freelancer_id);
        if (!$user) {
            show_error('User tidak ditemukan!', 404, 'Error');
        }

        $data['user'] = $user['username'];

        // Get available jobs (status = 'Tersedia')
        $data['pekerjaan'] = $this->Job_model->get_all_jobs();

        if (empty($data['pekerjaan'])) {
            $data['message'] = 'Tidak ada pekerjaan yang tersedia saat ini.';
        }

        $this->load->view('Freelancer_Dashboard', $data);
    }

    public function ambil_pekerjaan()
    {
        $freelancer_id = $this->session->userdata('freelancer_id');
        log_message('debug', 'Freelancer ID: ' . $freelancer_id);

        if (!$freelancer_id) {
            echo json_encode(['status' => 'error', 'message' => 'ID freelancer tidak valid.']);
            return;
        }

        $job_id = $this->input->post('job_id');
        log_message('debug', 'Job ID: ' . $job_id);

        if (!$job_id) {
            echo json_encode(['status' => 'error', 'message' => 'ID pekerjaan tidak valid.']);
            return;
        }

        // Retrieve job from database
        $job = $this->Job_model->get_job_by_id($job_id);
        log_message('debug', 'Job details: ' . print_r($job, true));

        if (!$job) {
            echo json_encode(['status' => 'error', 'message' => 'Pekerjaan tidak ditemukan.']);
            return;
        }

        // Check if job is available
        if ($job['status'] != 'Tersedia') {
            echo json_encode(['status' => 'error', 'message' => 'Pekerjaan ini sudah diambil atau tidak tersedia.']);
            return;
        }

        // Update job status to 'Tidak tersedia' (Taken)
        $update = $this->Job_model->update_job_status($job_id, 'Tidak tersedia');
        if (!$update) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui status pekerjaan.']);
            return;
        }

        // Send notification to client
        $message = "Freelancer '{$freelancer_id}' telah mengambil pekerjaan '{$job['title']}'. Klien perlu mengonfirmasi.";
        $notification_sent = $this->send_notification($job['client_id'], $freelancer_id, $job_id, $message);

        if (!$notification_sent) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim notifikasi.']);
            return;
        }

        echo json_encode(['status' => 'success', 'message' => 'Pekerjaan berhasil diambil!']);
    }

    private function send_notification($client_id, $freelancer_id, $job_id, $message)
    {
        $data = [
            'client_id' => $client_id,
            'freelancer_id' => $freelancer_id,
            'job_id' => $job_id,
            'status' => 'new', // Status default
            'is_accepted' => 'Menunggu', // Default status in the table
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Insert notification into the database
        return $this->insert_notification($data);
    }

    public function insert_notification($data)
    {
        $this->db->insert('notifications', $data);

        if ($this->db->affected_rows() > 0) {
            log_message('debug', 'Notification saved successfully: ' . print_r($data, true));
            return true;
        } else {
            log_message('error', 'Failed to save notification. Data: ' . print_r($data, true));
            return false;
        }
    }

    public function inbox()
    {
        $freelancer_id = $this->session->userdata('freelancer_id');

        if (empty($freelancer_id)) {
            show_error('Freelancer tidak ditemukan atau belum login.', 404);
            return;
        }

        // Fetch notifications for the freelancer
        $data['notifications'] = $this->Notification_model->get_notifications($freelancer_id);

        // Load the inbox view
        $this->load->view('inbox_freelancer', $data);
    }

    public function update_notification_status()
    {
        $notification_id = $this->input->post('notification_id');
        $status = $this->input->post('status');
        $valid_statuses = ['New', 'Completed']; // Valid statuses

        if (!in_array($status, $valid_statuses)) {
            echo json_encode(['status' => 'error', 'message' => 'Status tidak valid']);
            return;
        }

        // Update notification status in the database
        $this->db->where('id', $notification_id);
        $update = $this->db->update('notifications', ['status' => $status]);

        if ($update) {
            echo json_encode(['status' => 'success', 'message' => 'Status berhasil diperbarui']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui status']);
        }
    }
}

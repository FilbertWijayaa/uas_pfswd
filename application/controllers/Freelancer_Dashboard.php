<?php
class Freelancer_Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // Memuat library session
        $this->load->library('session');

        // Memuat helper URL
        $this->load->helper('url');

        // Memuat model User_model
        $this->load->model('User_model');  // Pastikan model User_model dimuat

        // Memuat model Job_model
        $this->load->model('Job_model');

        // Memastikan user login dan memiliki role freelancer
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') !== 'freelancer') {
            redirect('signin');  // Jika tidak login atau bukan freelancer, redirect ke halaman login
        }
    }

    public function index()
    {
        // Ambil user_id dari session
        $user_id = $this->session->userdata('user_id');

        // Ambil informasi user berdasarkan user_id
        $user = $this->User_model->get_user_by_id($user_id);

        // Mengirim data username ke view
        $data['user'] = $user['username'];

        // Ambil semua pekerjaan yang telah diposting oleh client
        $data['pekerjaan'] = $this->Job_model->get_all_jobs(); // Mengambil semua pekerjaan

        // Load the Freelancer Dashboard view
        $this->load->view('Freelancer_Dashboard', $data);
    }
}




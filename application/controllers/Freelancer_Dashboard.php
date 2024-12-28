<?php
class Freelancer_Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // Memuat library session
        $this->load->library('session');

        // Memuat helper URL
        $this->load->helper('url');

        // Memastikan user login dan memiliki role freelancer
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') !== 'freelancer') {
            redirect('signin');  // Jika tidak login atau bukan freelancer, redirect ke halaman login
        }
    }

    public function index()
    {
        // Menampilkan halaman freelancer dashboard
        $this->load->view('Freelancer_Dashboard');
    }
}




<?php
class SignInPage extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Memuat model User_model untuk autentikasi
        $this->load->model('User_model');
        // Memuat library session untuk menyimpan data login
        $this->load->library('session');
        // Memuat helper URL
        $this->load->helper('url');
    }

    // Menampilkan halaman login
    public function index()
    {
        $this->load->view('SignInPage');
    }

    public function login()
    {
        // Mengambil data dari form
        $email = $this->input->post('email');
        $role = $this->input->post('role');
    
        // Cek apakah email ada di database
        $user = $this->User_model->get_user_by_email($email);
        
        if ($user) {
            // Periksa apakah role yang dipilih berbeda dengan yang ada di database
            if ($user['role'] !== $role) {
                // Update role di database jika berbeda
                $this->User_model->update_user_role($user['id'], $role);
            }

            // Simpan informasi user ke session
            $this->session->set_userdata('user_id', $user['id']);
            $this->session->set_userdata('role', $role);
            
            // Redirect ke halaman berdasarkan role
            if ($role == 'freelancer') {
                redirect('freelancer_dashboard');  // Redirect ke halaman freelancer dashboard
            } elseif ($role == 'client') {
                redirect('client_dashboard');  // Redirect ke halaman client dashboard
            }
        } else {
            // Jika email tidak ditemukan
            $this->session->set_flashdata('error', 'Email tidak terdaftar');
            redirect('signin');
        }
    }
}



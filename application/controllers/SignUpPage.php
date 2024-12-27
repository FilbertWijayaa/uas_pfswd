<?php
class SignUpPage extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Memuat helper URL
        $this->load->helper('url');
    }

    public function index()
    {
        // Memanggil view Home.php yang ada di folder views
        $this->load->view('SignUpPage');
    }
}

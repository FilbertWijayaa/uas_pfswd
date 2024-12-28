<?php
class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Memuat database
        $this->load->database();
    }

    // Mendapatkan data user berdasarkan email
    public function get_user_by_email($email)
    {
        $query = $this->db->get_where('users', ['email' => $email]);
        return $query->row_array();  // Mengembalikan data user dalam bentuk array
    }

    // Memperbarui role user berdasarkan ID
    public function update_user_role($user_id, $role)
    {
        $this->db->set('role', $role);
        $this->db->where('id', $user_id);
        return $this->db->update('users');
    }

    // Cek apakah email sudah terdaftar
    public function check_email_exists($email)
    {
        $query = $this->db->get_where('users', ['email' => $email]);
        return $query->num_rows() > 0;
    }

    // Cek apakah username sudah terdaftar
    public function check_username_exists($username)
    {
        $query = $this->db->get_where('users', ['username' => $username]);
        return $query->num_rows() > 0;
    }

    // Menyimpan user ke database
    public function create_user($data)
    {
        return $this->db->insert('users', $data); // Menambahkan data ke tabel 'users'
    }
}


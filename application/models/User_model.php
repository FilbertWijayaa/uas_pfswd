<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_user($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('users')->row();
    }

    public function create_user($data)
    {
        return $this->db->insert('users', $data);
    }
}

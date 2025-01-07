<?php

class Job_model extends CI_Model {

public function __construct()
{
    parent::__construct();
    $this->load->database();
}

// Ambil semua pekerjaan yang tersedia (status = 'Tersedia')
public function get_all_jobs()
{
    $this->db->select('jobs.*, users.username');
    $this->db->from('jobs');
    $this->db->join('users', 'jobs.client_id = users.id');
    $this->db->where('jobs.status', 'Tersedia');  // Pastikan hanya pekerjaan dengan status 'Tersedia' yang diambil
    $this->db->order_by('jobs.created_at', 'DESC');
    $query = $this->db->get();
    return $query->result_array();  // Mengembalikan pekerjaan yang tersedia
}

// Ambil semua pekerjaan tanpa filter status
public function get_all_jobs2()
{
    $this->db->select('jobs.*, users.username');
    $this->db->from('jobs');
    $this->db->join('users', 'jobs.client_id = users.id');
    $this->db->order_by('jobs.created_at', 'DESC');
    $query = $this->db->get();
    return $query->result_array();  // Mengembalikan semua pekerjaan
}

// Ambil pekerjaan berdasarkan ID (untuk keperluan detail)
public function get_job_by_id($job_id)
{
    $this->db->select('jobs.*, users.username');
    $this->db->from('jobs');
    $this->db->join('users', 'jobs.client_id = users.id');
    $this->db->where('jobs.id', $job_id);
    $query = $this->db->get();

    if ($query->num_rows() == 0) {
        return false;  // Pekerjaan tidak ditemukan
    }

    return $query->row_array();  // Mengembalikan data pekerjaan
}

// Fungsi untuk menambah pekerjaan baru
public function add_job($data)
{
    return $this->db->insert('jobs', $data);  // Menambahkan pekerjaan baru
}

// Fungsi untuk mengupdate status pekerjaan
public function update_job_status($job_id, $status)
{
    // Pastikan hanya mengupdate jika status yang valid
    $valid_statuses = ['Tersedia', 'Tidak tersedia', 'Diterima'];
    if (!in_array($status, $valid_statuses)) {
        return false;  // Jika status tidak valid, kembalikan false
    }

    $this->db->set('status', $status);
    $this->db->where('id', $job_id);
    
    if ($this->db->update('jobs')) {
        return true;
    }

    return false;  // Gagal mengupdate status
}

// Update data pekerjaan berdasarkan ID
public function update_job($job_id, $data)
{
    $this->db->where('id', $job_id);
    return $this->db->update('jobs', $data);  // Update pekerjaan berdasarkan ID
}

// Fungsi untuk menghapus pekerjaan
public function delete_job($job_id)
{
    $this->db->where('id', $job_id);
    return $this->db->delete('jobs');  // Menghapus pekerjaan berdasarkan ID
}

}

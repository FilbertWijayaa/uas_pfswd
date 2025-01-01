<?php
class Job_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Ambil semua pekerjaan
    public function get_all_jobs()
    {
        $this->db->select('jobs.*, users.username');
        $this->db->from('jobs');
        $this->db->join('users', 'jobs.client_id = users.id');
        $this->db->order_by('jobs.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Tambahkan pekerjaan baru
    public function add_job($data)
    {
        return $this->db->insert('jobs', $data);
    }

    // Fungsi untuk mengupdate status pekerjaan
    public function update_job_status($job_id, $status)
    {
        $this->db->set('status', $status);
        $this->db->where('id', $job_id);
        return $this->db->update('jobs');
    }

    // Ambil pekerjaan berdasarkan ID
    public function get_job_by_id($id)
    {
        $this->db->select('jobs.*');
        $this->db->from('jobs');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Mengembalikan satu baris data
    }

    // Update data pekerjaan berdasarkan ID
    public function update_job($job_id, $data)
    {
        $this->db->where('id', $job_id);
        return $this->db->update('jobs', $data);
    }

     // Fungsi untuk menghapus pekerjaan
    public function delete_job($job_id)
    {
        $this->db->where('id', $job_id);
         return $this->db->delete('jobs'); // Menghapus data pekerjaan berdasarkan ID
    }
}

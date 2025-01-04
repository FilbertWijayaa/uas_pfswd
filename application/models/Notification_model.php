<?php

class Notification_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_notifications1($freelancer_id)
    {
        $this->db->where('freelancer_id', $freelancer_id);
        $query = $this->db->get('notifications');
        return $query->result_array();
    }

    // Fungsi untuk mendapatkan notifikasi berdasarkan client_id
    public function get_notifications2($client_id) {
        // Pastikan client_id adalah angka yang valid (menghindari SQL Injection)
        $client_id = (int) $client_id;

        // Ambil semua data notifikasi yang relevan untuk client tersebut
        $this->db->select('*');
        $this->db->from('notifications');
        $this->db->where('client_id', $client_id); // Filter berdasarkan client_id
        $query = $this->db->get();

        // Mengecek jika ada error dalam query
        if ($this->db->error()['code'] != 0) {
            log_message('error', 'Error SQL: ' . $this->db->last_query());
            return false; // Jika ada error, kembalikan false
        }

        return $query->result_array(); // Mengembalikan hasil query sebagai array
    }

    // Fungsi untuk memperbarui status notifikasi
    public function update_status($notification_id, $status) {
        // Pastikan notification_id adalah angka yang valid
        $notification_id = (int) $notification_id;
    
        // Validasi status, pastikan hanya nilai 'Menunggu', 'Diterima', atau 'Tidak diterima' yang diterima
        $valid_status = ['Menunggu', 'Diterima', 'Tidak diterima'];
    
        // Cek apakah status yang diberikan valid
        if (!in_array($status, $valid_status)) {
            log_message('error', 'Status yang diberikan tidak valid. ID: ' . $notification_id . ', Status: ' . $status);
            return json_encode(['message' => 'Status tidak valid.']);  // Mengembalikan pesan kesalahan
        }
    
        // Update status notifikasi berdasarkan ID notifikasi
        $this->db->set('is_accepted', $status); // Set nilai kolom is_accepted
        $this->db->where('id', $notification_id); // Filter berdasarkan ID notifikasi
        $update = $this->db->update('notifications');
    
        // Mengecek jika ada error dalam query
        if ($this->db->error()['code'] != 0) {
            log_message('error', 'Error SQL: ' . $this->db->last_query());
            return json_encode(['message' => 'Gagal memperbarui status.']);  // Mengembalikan pesan kesalahan
        }
    
        return json_encode(['message' => 'Status berhasil diperbarui.']);  // Mengembalikan pesan sukses
    }
    
    
    
}

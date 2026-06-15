<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    // Mengambil semua data dokter beserta jadwal prakteknya
    public function get_all_dokter() {
        $this->db->select('dokter.*, id_jadwal, hari, jam_mulai, jam_selesai');
        $this->db->from('dokter');
        $this->db->join('jadwal_dokter', 'dokter.id_dokter = jadwal_dokter.id_dokter', 'left');
        return $this->db->get()->result();
    }

    // Mengambil semua daftar pasien
    public function get_all_pasien() {
        return $this->db->get('pasien')->result();
    }

    // Mengambil antrean konsultasi yang berstatus 'menunggu' (diurutkan dari yang paling dulu mendaftar)
    public function get_antrean_menunggu() {
        $this->db->select('konsultasi.*, pasien.nama_pasien, dokter.nama_dokter');
        $this->db->from('konsultasi');
        $this->db->join('pasien', 'konsultasi.id_pasien = pasien.id_pasien');
        $this->db->join('dokter', 'konsultasi.id_dokter = dokter.id_dokter');
        $this->db->where('status_konsultasi', 'menunggu');
        $this->db->order_by('konsultasi.id_konsultasi', 'ASC');
        return $this->db->get()->result();
    }

    // Aksi CRUD: Simpan data dokter dan otomatis buat data jadwalnya
    public function insert_dokter($data_dokter, $data_jadwal) {
        // Gunakan database transaction agar jika salah satu insert gagal, data tidak rusak
        $this->db->trans_start();

        $this->db->insert('dokter', $data_dokter);
        $id_dokter = $this->db->insert_id(); // Mengambil ID dokter yang baru terbuat

        $data_jadwal['id_dokter'] = $id_dokter;
        $this->db->insert('jadwal_dokter', $data_jadwal);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // Mengambil baris jadwal dokter berdasarkan ID jadwal
    public function get_jadwal_by_id($id_jadwal) {
        return $this->db->get_where('jadwal_dokter', array('id_jadwal' => $id_jadwal))->row();
    }

    // Aksi CRUD: Menyimpan log pendaftaran konsultasi baru
    public function insert_konsultasi($data_konsultasi) {
        return $this->db->insert('konsultasi', $data_konsultasi);
    }

    // Aksi CRUD: Menyimpan rekam medis dan merubah status konsultasi menjadi selesai
    public function update_selesai_konsultasi($id_konsultasi, $data_rekam) {
        $this->db->trans_start();

        // 1. Masukkan data ke rekam medis
        $this->db->insert('rekam_medis', $data_rekam);

        // 2. Update status konsultasi menjadi 'selesai'
        $this->db->where('id_konsultasi', $id_konsultasi);
        $this->db->update('konsultasi', array('status_konsultasi' => 'selesai'));

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // Aksi CRUD: Update data dokter beserta jadwalnya
    public function update_dokter($id_dokter, $data_dokter, $data_jadwal) {
        $this->db->trans_start();

        $this->db->where('id_dokter', $id_dokter);
        $this->db->update('dokter', $data_dokter);

        $this->db->where('id_dokter', $id_dokter);
        $this->db->update('jadwal_dokter', $data_jadwal);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // Aksi CRUD: Hapus dokter beserta jadwal prakteknya
    public function delete_dokter($id_dokter) {
        $this->db->trans_start();

        $this->db->where('id_dokter', $id_dokter);
        $this->db->delete('jadwal_dokter');

        $this->db->where('id_dokter', $id_dokter);
        $this->db->delete('dokter');

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // Aksi CRUD: Hapus / batalkan antrean konsultasi
    public function delete_konsultasi($id_konsultasi) {
        $this->db->where('id_konsultasi', $id_konsultasi);
        return $this->db->delete('konsultasi');
    }
}
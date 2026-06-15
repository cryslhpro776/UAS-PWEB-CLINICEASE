<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model
{

    private $hari_valid   = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
    private $status_valid = array('tersedia','sibuk');

    // Ambil data dokter beserta jadwalnya
    public function getDokterList()
    {
        $this->db->select('dokter.*, id_jadwal, hari, jam_mulai, jam_selesai');
        $this->db->from('dokter');
        $this->db->join('jadwal_dokter', 'dokter.id_dokter = jadwal_dokter.id_dokter', 'left');
        return $this->db->get()->result();
    }

    // Ambil seluruh data pasien
    public function getPasienList()
    {
        return $this->db->get('pasien')->result();
    }

    // Ambil antrean konsultasi yang berstatus 'menunggu', urut berdasarkan ID terkecil
    public function getAntrean()
    {
        $this->db->select('konsultasi.*, pasien.nama_pasien, dokter.nama_dokter');
        $this->db->from('konsultasi');
        $this->db->join('pasien', 'konsultasi.id_pasien = pasien.id_pasien');
        $this->db->join('dokter', 'konsultasi.id_dokter = dokter.id_dokter');
        $this->db->where('status_konsultasi', 'menunggu');
        $this->db->order_by('konsultasi.id_konsultasi', 'ASC');
        return $this->db->get()->result();
    }

    // Simpan data dokter baru, kembalikan ID dokter
    public function tambahDokter($data_dokter)
    {
        $this->db->insert('dokter', $data_dokter);
        return $this->db->insert_id();
    }

    // Simpan jadwal dokter (dengan validasi ENUM hari & status)
    public function tambahJadwal($data_jadwal)
    {
        if (!in_array($data_jadwal['hari'], $this->hari_valid)) {
            return false; // hari tidak valid
        }

        if (!in_array($data_jadwal['status'], $this->status_valid)) {
            $data_jadwal['status'] = 'tersedia'; // fallback default
        }

        $this->db->insert('jadwal_dokter', $data_jadwal);
        return true;
    }

    // Ambil data jadwal berdasarkan id_jadwal
    public function getJadwalById($id_jadwal)
    {
        return $this->db->get_where('jadwal_dokter', array('id_jadwal' => $id_jadwal))->row();
    }

    // Tambahkan pasien ke antrean konsultasi
    public function tambahKonsultasi($data_konsultasi)
    {
        $this->db->insert('konsultasi', $data_konsultasi);
    }

    // Simpan rekam medis hasil konsultasi
    public function simpanRekamMedis($data_rekam)
    {
        $this->db->insert('rekam_medis', $data_rekam);
    }

    // Update status konsultasi
    public function updateStatusKonsultasi($id_konsultasi, $status)
    {
        $this->db->where('id_konsultasi', $id_konsultasi);
        $this->db->update('konsultasi', array('status_konsultasi' => $status));
    }
}
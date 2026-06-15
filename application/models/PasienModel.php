<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PasienModel extends CI_Model
{
    // Ambil data profil pasien berdasarkan id_user
    public function getPasienByUserId($id_user)
    {
        return $this->db->get_where('pasien', array('id_user' => $id_user))->row();
    }

    // Ambil konsultasi aktif (status 'menunggu') milik pasien
    public function getKunjunganAktif($id_pasien)
    {
        $this->db->where('id_pasien', $id_pasien);
        $this->db->where('status_konsultasi', 'menunggu');
        return $this->db->get('konsultasi')->row();
    }

    // Hitung nomor urut antrean pasien untuk dokter tertentu
    public function getNomorUrut($id_dokter, $id_konsultasi)
    {
        $this->db->where('id_dokter', $id_dokter);
        $this->db->where('status_konsultasi', 'menunggu');
        $this->db->where('id_konsultasi <=', $id_konsultasi);
        return $this->db->count_all_results('konsultasi');
    }

    // Ambil data dokter berdasarkan id_dokter
    public function getDokterById($id_dokter)
    {
        return $this->db->get_where('dokter', array('id_dokter' => $id_dokter))->row();
    }

    // Ambil daftar dokter beserta jadwal, dengan pencarian opsional
    public function getDokterList($keyword = null)
    {
        $this->db->select('dokter.*, jadwal_dokter.hari, jadwal_dokter.jam_mulai, jadwal_dokter.jam_selesai');
        $this->db->from('dokter');
        $this->db->join('jadwal_dokter', 'dokter.id_dokter = jadwal_dokter.id_dokter', 'left');

        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('dokter.nama_dokter', $keyword);
            $this->db->or_like('dokter.spesialisasi', $keyword);
            $this->db->group_end();
        }

        return $this->db->get()->result();
    }

    // Ambil riwayat rekam medis pasien
    public function getRiwayatMedis($id_pasien)
    {
        $this->db->select('rekam_medis.*, dokter.nama_dokter, konsultasi.tanggal_konsultasi');
        $this->db->from('rekam_medis');
        $this->db->join('konsultasi', 'rekam_medis.id_konsultasi = konsultasi.id_konsultasi');
        $this->db->join('dokter', 'konsultasi.id_dokter = dokter.id_dokter');
        $this->db->where('rekam_medis.id_pasien', $id_pasien);
        $this->db->order_by('rekam_medis.tanggal_input', 'DESC');
        return $this->db->get()->result();
    }
}
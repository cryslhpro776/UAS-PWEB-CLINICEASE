<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Proteksi: Pastikan user sudah login dan perannya adalah pasien
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'pasien') {
            $this->session->set_flashdata('error', 'Silakan login sebagai pasien terlebih dahulu.');
            redirect('auth');
        }

        // Otomatis load Pasien_model untuk semua fungsi di controller ini
        $this->load->model('Pasien_model');
    }

    // Tampilan Dashboard Utama Pasien
    public function dashboard() {
        $id_user = $this->session->userdata('id_user');

        // 1. Ambil data profil pasien via Model
        $pasien = $this->Pasien_model->get_profil_pasien($id_user);
        $data['pasien'] = $pasien;

        // 2. Cari tahu info antrean AKTIF pasien ini saat ini via Model (jika ada)
        $data['info_antrean'] = null;
        if ($pasien) {
            $kunjungan_aktif = $this->Pasien_model->get_kunjungan_aktif($pasien->id_pasien);

            if ($kunjungan_aktif) {
                // Hitung nomor urut antrean lewat bantuan fungsi di Model
                $nomor_urut = $this->Pasien_model->hitung_nomor_urut($kunjungan_aktif->id_dokter, $kunjungan_aktif->id_konsultasi);

                // Ambil info nama dokter tujuan lewat Model
                $dokter = $this->Pasien_model->get_dokter_by_id($kunjungan_aktif->id_dokter);

                $data['info_antrean'] = array(
                    'nomor_urut'  => $nomor_urut,
                    'nama_dokter' => $dokter->nama_dokter
                );
            }
        }

        // 3. Fitur Pencarian Dokter dan Jadwal via Model
        $keyword = $this->input->get('keyword');
        $data['dokter_list'] = $this->Pasien_model->cari_dokter_dan_jadwal($keyword);

        // 4. Ambil Riwayat Rekam Medis Pasien via Model
        if ($pasien) {
            $data['riwayat_medis'] = $this->Pasien_model->get_riwayat_rekam_medis($pasien->id_pasien);
        } else {
            $data['riwayat_medis'] = array();
        }

        // Lempar data bersih ke komponen View
        $this->load->view('pasien/dashboard_view', $data);
    }
}
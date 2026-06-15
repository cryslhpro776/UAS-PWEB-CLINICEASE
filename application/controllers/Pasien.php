<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PasienModel');

        // Proteksi: Pastikan user sudah login dan perannya adalah pasien
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'pasien') {
            $this->session->set_flashdata('error', 'Silakan login sebagai pasien terlebih dahulu.');
            redirect('auth');
        }
    }

    // Tampilan Dashboard Utama Pasien
    public function dashboard()
    {
        $id_user = $this->session->userdata('id_user');

        // 1. Ambil data profil pasien
        $pasien = $this->PasienModel->getPasienByUserId($id_user);
        $data['pasien'] = $pasien;

        // 2. Cari tahu info antrean AKTIF pasien ini saat ini (jika ada)
        $data['info_antrean'] = null;
        if ($pasien) {
            $kunjungan_aktif = $this->PasienModel->getKunjunganAktif($pasien->id_pasien);

            if ($kunjungan_aktif) {
                // Hitung nomor urut antrean untuk dokter yang sama
                $nomor_urut = $this->PasienModel->getNomorUrut(
                    $kunjungan_aktif->id_dokter,
                    $kunjungan_aktif->id_konsultasi
                );

                // Ambil nama dokter tujuan
                $dokter = $this->PasienModel->getDokterById($kunjungan_aktif->id_dokter);

                $data['info_antrean'] = array(
                    'nomor_urut'  => $nomor_urut,
                    'nama_dokter' => $dokter->nama_dokter
                );
            }
        }

        // 3. Fitur Pencarian Dokter
        $keyword = $this->input->get('keyword');
        $data['dokter_list'] = $this->PasienModel->getDokterList($keyword);

        // 4. Ambil Riwayat Rekam Medis Pasien
        if ($pasien) {
            $data['riwayat_medis'] = $this->PasienModel->getRiwayatMedis($pasien->id_pasien);
        } else {
            $data['riwayat_medis'] = array();
        }

        $this->load->view('pasien/dashboard_view', $data);
    }
}
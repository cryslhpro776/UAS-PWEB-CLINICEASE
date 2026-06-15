<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Proteksi Halaman: Pastikan sudah login dan rolenya adalah admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Akses ditolak! Anda bukan admin.');
            redirect('auth');
        }
        
        // Load Admin_model secara otomatis untuk semua fungsi di bawah
        $this->load->model('Admin_model');
    }

    // 1. Menampilkan Halaman Dashboard
    public function dashboard() {
        // Memanggil data dari model
        $data['dokter_list'] = $this->Admin_model->get_all_dokter();
        $data['pasien_list'] = $this->Admin_model->get_all_pasien();
        $data['antrean']     = $this->Admin_model->get_antrean_menunggu();

        $this->load->view('admin/dashboard_view', $data);
    }

    // 2. Menerima data input untuk Tambah Dokter & Jadwal
    public function tambah_dokter() {
        $data_dokter = array(
            'nama_dokter'  => $this->input->post('nama_dokter'),
            'spesialisasi' => $this->input->post('spesialisasi'),
            'nomor_sip'    => $this->input->post('nomor_sip')
        );

        $data_jadwal = array(
            'hari'        => $this->input->post('hari'),
            'jam_mulai'   => $this->input->post('jam_mulai'),
            'jam_selesai' => $this->input->post('jam_selesai'),
            'status'      => 'tersedia'
        );

        // Kirim data ke model untuk diproses ke database
        $this->Admin_model->insert_dokter($data_dokter, $data_jadwal);

        $this->session->set_flashdata('success', 'Data dokter dan jadwal berhasil ditambahkan!');
        redirect('admin/dashboard');
    }

    // 3. Menerima data input untuk Pendaftaran Konsultasi Pasien
    public function daftar_konsultasi() {
        $id_jadwal = $this->input->post('id_jadwal');
        
        // Cari info dokter berdasarkan jadwal melalui model
        $jadwal = $this->Admin_model->get_jadwal_by_id($id_jadwal);

        $data_konsultasi = array(
            'id_pasien'          => $this->input->post('id_pasien'),
            'id_dokter'          => $jadwal->id_dokter,
            'id_jadwal'          => $id_jadwal,
            'tanggal_konsultasi' => date('Y-m-d'),
            'status_konsultasi'  => 'menunggu'
        );

        // Simpan pendaftaran via model
        $this->Admin_model->insert_konsultasi($data_konsultasi);

        $this->session->set_flashdata('success', 'Pasien berhasil ditambahkan ke dalam antrean!');
        redirect('admin/dashboard');
    }

    // 4. Menerima data input untuk Penyelesaian Pemeriksaan & Rekam Medis
    public function selesaikan_konsultasi() {
        $id_konsultasi = $this->input->post('id_konsultasi');
        $id_pasien     = $this->input->post('id_pasien');

        $data_rekam = array(
            'id_konsultasi' => $id_konsultasi,
            'id_pasien'     => $id_pasien,
            'diagnosis'     => $this->input->post('diagnosis'),
            'catatan_medis' => $this->input->post('catatan_medis')
        );

        // Eksekusi penyimpanan rekam medis & update status via model
        $this->Admin_model->update_selesai_konsultasi($id_konsultasi, $data_rekam);

        $this->session->set_flashdata('success', 'Pasien selesai diperiksa dan rekam medis disimpan.');
        redirect('admin/dashboard');
    }
}
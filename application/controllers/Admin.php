<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');

        // Proteksi Halaman: Pastikan sudah login dan rolenya adalah admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Akses ditolak! Anda bukan admin.');
            redirect('auth');
        }
    }

    // 1. Tampilkan dashboard admin
    public function dashboard()
    {
        $data['dokter_list'] = $this->AdminModel->getDokterList();
        $data['pasien_list'] = $this->AdminModel->getPasienList();
        $data['antrean']     = $this->AdminModel->getAntrean();

        $this->load->view('admin/dashboard_view', $data);
    }

    // 2. Aksi CRUD: Simpan Data Dokter baru beserta jadwalnya
    public function tambah_dokter()
    {
        // Data untuk tabel dokter
        $data_dokter = array(
            'nama_dokter'  => $this->input->post('nama_dokter'),
            'spesialisasi' => $this->input->post('spesialisasi'),
            'nomor_sip'    => $this->input->post('nomor_sip')
        );
        $id_dokter = $this->AdminModel->tambahDokter($data_dokter);

        // Data untuk tabel jadwal_dokter
        $data_jadwal = array(
            'id_dokter'   => $id_dokter,
            'hari'        => $this->input->post('hari'),
            'jam_mulai'   => $this->input->post('jam_mulai'),
            'jam_selesai' => $this->input->post('jam_selesai'),
            'status'      => 'tersedia'
        );
        $berhasil = $this->AdminModel->tambahJadwal($data_jadwal);

        if (!$berhasil) {
            $this->session->set_flashdata('error', 'Hari tidak valid!');
            redirect('admin/dashboard');
            return;
        }

        $this->session->set_flashdata('success', 'Data dokter dan jadwal berhasil ditambahkan!');
        redirect('admin/dashboard');
    }

    // 3. Daftarkan pasien ke antrean konsultasi
    public function daftar_konsultasi()
    {
        $id_jadwal = $this->input->post('id_jadwal');
        $jadwal = $this->AdminModel->getJadwalById($id_jadwal);

        $data_konsultasi = array(
            'id_pasien'          => $this->input->post('id_pasien'),
            'id_dokter'          => $jadwal->id_dokter,
            'id_jadwal'          => $id_jadwal,
            'tanggal_konsultasi' => date('Y-m-d'),
            'status_konsultasi'  => 'menunggu'
        );
        $this->AdminModel->tambahKonsultasi($data_konsultasi);

        // KODE LAMA YANG MENGHAPUS / MENGUBAH STATUS JADWAL KITA HAPUS
        // Sehingga tombol daftar tidak akan hilang dan bisa diklik berkali-kali untuk pasien berbeda

        $this->session->set_flashdata('success', 'Pasien berhasil ditambahkan ke dalam antrean!');
        redirect('admin/dashboard');
    }

    // 4. Selesaikan konsultasi dan simpan rekam medis
    public function selesaikan_konsultasi()
    {
        $id_konsultasi = $this->input->post('id_konsultasi');
        $id_pasien     = $this->input->post('id_pasien');

        $data_rekam = array(
            'id_konsultasi' => $id_konsultasi,
            'id_pasien'     => $id_pasien,
            'diagnosis'     => $this->input->post('diagnosis'),
            'catatan_medis' => $this->input->post('catatan_medis')
        );
        $this->AdminModel->simpanRekamMedis($data_rekam);

        // Update status konsultasi menjadi 'selesai'
        $this->AdminModel->updateStatusKonsultasi($id_konsultasi, 'selesai');

        // KODE LAMA YANG MENGUBAH JADWAL MENJADI 'TERSEDIA' DIHAPUS karena statusnya sekarang selalu aktif

        $this->session->set_flashdata('success', 'Pasien selesai diperiksa dan rekam medis disimpan.');
        redirect('admin/dashboard');
    }
}
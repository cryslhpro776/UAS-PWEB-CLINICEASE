<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect($this->session->userdata('role') == 'admin' ? 'admin/dashboard' : 'pasien/dashboard');
        }
        $this->load->view('login_view');
    }
// LOGIN
    public function proses_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Auth_model->login($username, $password);
        if ($user) {
            $session_data = array(
                'id_user' => $user->id_user,
                'username' => $user->username,
                'role' => $user->role,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);

            if ($user->role == 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('pasien/dashboard');
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau Password salah!');
            redirect('auth');
        }
    }
        public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
 public function registrasi()
    {
        $this->load->view('registrasi_view');
    }

    public function proses_registrasi()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // 1. Simpan ke data user untuk login
        $data_user = array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT), // Enkripsi aman
            'role' => 'pasien'
        );
        $this->db->insert('user', $data_user);
        $id_user = $this->db->insert_id();

        // 2. Simpan ke data biodata pasien
        $data_pasien = array(
            'id_user' => $id_user,
            'nama_pasien' => $this->input->post('nama_pasien'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'nomor_hp' => $this->input->post('nomor_hp'),
            'alamat' => $this->input->post('alamat')
        );
        $this->db->insert('pasien', $data_pasien);

        $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
        redirect('auth');
    }
}
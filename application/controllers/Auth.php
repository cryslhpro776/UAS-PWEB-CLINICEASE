<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
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

}
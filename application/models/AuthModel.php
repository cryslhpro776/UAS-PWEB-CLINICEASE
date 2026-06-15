<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    public function login($username, $password)
    {
        $user = $this->db->get_where('user', array('username' => $username))->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }

    public function registerUser($data_user)
    {
        $this->db->insert('user', $data_user);
        return $this->db->insert_id();
    }

    public function registerPasien($data_pasien)
    {
        $this->db->insert('pasien', $data_pasien);
    }
}
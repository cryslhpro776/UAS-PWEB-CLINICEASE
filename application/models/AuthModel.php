<?php
class Auth_model extends CI_Model {
    public function login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        if ($query->num_rows() == 1) {
            $user = $query->row();
            // Menggunakan password_verify demi keamanan, atau ubah ke md5 jika sebatas prototype sederhana
            if (password_verify($password, $user->password) || $password == $user->password) {
                return $user;
            }
        }
        return FALSE;
    }
}
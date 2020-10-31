<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login_Model extends CI_Model
{
    public function check_login($data)
    {
        $datas['email'] = ['email' => $data['email'], 'password' => $data['password']];
        $datas['username'] = ['username' => $data['email'], 'password' => $data['password']];
        return $this->db->where($datas['email'])->or_where($datas['username'])->get('tb_admin')->row_array();
    }
}

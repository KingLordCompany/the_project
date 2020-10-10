<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Katering_Model extends CI_Model
{
    public function produk()
    {
        return $this->db->get('tb_produk')->result_array();
    }
    public function user_by_id($id)
    {
        return $this->db->where('id_pelanggan', $id)->get('tb_pelanggan')->row_array();
    }
    public function produk_where($id)
    {
        return $this->db->where('id_produk', $id)->get('tb_produk')->row_array();
    }
    public function login($data)
    {
        $datas = [
            'email' => $data['email'],
            'password' => $data['password']
        ];
        return $this->db->get_where('tb_pelanggan', $datas)->row_array();
    }
    public function insert_daftar($data)
    {
        $datas = [
            'nm_pelanggan' => $data['nama'], 'alamat' => $data['alamat'], 'email' => $data['email'], 'no_hp' => $data['telpon'], 'password' => $data['pass2']
        ];
        $this->db->insert('tb_pelanggan', $datas);
    }
}

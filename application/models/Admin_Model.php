<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin_Model extends CI_Model
{
    // USER
    public function get_all()
    {
        return $this->db->get('tb_admin')->result_array();
    }

    public function insert_user($data)
    {
        $datas = [
            'username' => $data['nama'],
            'email' => $data['email'],
            'no_hp' => $data['telpon'],
            'password' => $data['password'],
        ];
        $this->db->insert('tb_admin', $datas);
    }

    public function delete_user($data)
    {
        $id = $data['admin'];
        $this->db->where('id_admin', $id)->delete('tb_admin');
    }
    // END USER
    // PRODUK
    public function get_all_produk()
    {
        return $this->db->get('tb_produk')->result_array();
    }

    public function insert_produk($data)
    {
        $datas = [
            'nama_produk' => $data['nama_produk'],
            'harga' => $data['harga'],
            'minimal_pesan' => $data['minimal_pesan'],
            'foto' => $data['foto'],
            'deskripsi' => $data['deskripsi'],
        ];
        $this->db->insert('tb_produk', $datas);
    }

    public function update_produk($data)
    {
        $id = $data['produk'];
        $datas = [
            'nama_produk' => $data['nama_produk'],
            'harga' => $data['harga'],
            'minimal_pesan' => $data['minimal_pesan'],
            'foto' => $data['foto'],
            'deskripsi' => $data['deskripsi'],
        ];
        $this->db->where('id_produk', $id)->update('tb_produk', $datas);
    }

    public function delete_produk($data)
    {
        $id = $data['produk'];
        $this->db->where('id_produk', $id)->delete('tb_produk');
    }
    // END PRODUK
}

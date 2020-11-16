<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin_Model extends CI_Model
{
    // USER
    public function admin_where($data)
    {
        return $this->db->where('id_admin', $data)->get('tb_admin')->row_array();
    }
    public function get_all()
    {
        return $this->db->get('tb_admin')->result_array();
    }
    public function change_pass($data)
    {
        $id = $data['id'];
        $datas = ['password' => $data['pass1']];
        $this->db->where('id_admin', $id)->update('tb_admin', $datas);
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

    // TRANSAKSI
    public function get_transaksi()
    {
        return $this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_pemesanan.id_pelanggan')->get('tb_pemesanan')->result_array();
    }
    public function detail_where($data)
    {
        return $this->db->where('nota_produk', $data)->join('tb_produk', 'tb_produk.id_produk=tb_detail_produk.id_produk')->get('tb_detail_produk')->result_array();
    }

    public function total_harga($data)
    {
        return $this->db->select('sum(total_harga) as total')->where('nota_produk', $data)->get('tb_detail_produk')->row_array();
    }

    public function edit_status_transaksi($data)
    {
        $id = $data['transaksi'];
        $datas = [
            'status_bayar' => $data['bayar'],
            'status_antar' => $data['antar']
        ];
        $this->db->where('nota_pemesanan', $id)->update('tb_pemesanan', $datas);
    }
    // END TRANSAKSI
}

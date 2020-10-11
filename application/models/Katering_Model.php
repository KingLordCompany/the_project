<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Katering_Model extends CI_Model
{
    public function produk()
    {
        return $this->db->get('tb_produk')->result_array();
    }
    public function produk_once($id)
    {
        return $this->db->where('id_produk', $id)->get('tb_produk')->row_array();
    }
    public function user_by_id($id)
    {
        return $this->db->where('id_pelanggan', $id)->get('tb_pelanggan')->row_array();
    }
    public function insert_pemmesanan($data)
    {
        $datas = [
            'id_pelanggan' => $data['pelanggan'],
            'tgl_antar' => $data['antar'],
            'status_bayar' => 'belum',
            'status_antar' => 'belum'
        ];
        $this->db->insert('tb_pemesanan', $datas);
    }
    public function insert_daftar_pesan($data)
    {
        $datas = [
            'id_produk' => $data['pesan'],
            'nota_produk' => $data['nota'],
            'total_harga' => $data['total'],
            'catatan' => $data['catatan'],
            'jumlah_pesan' => $data['jumlah']
        ];
        $this->db->insert('tb_detail_produk', $datas);
    }

    public function get_nota($id)
    {
        return $this->db->select("max(nota_pemesanan) as nota")->where('id_pelanggan', $id)->get('tb_pemesanan')->row_array();
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

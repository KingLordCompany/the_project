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

    public function detail_where($data)
    {
        return $this->db->where('nota_produk', $data)->join('tb_produk', 'tb_produk.id_produk=tb_detail_produk.id_produk')->get('tb_detail_produk')->result_array();
    }
    public function insert_pemmesanan($data)
    {
        $datas = [
            'nota_pemesanan' => $data['nota'],
            'id_pelanggan' => $data['pelanggan'],
            'tgl_antar' => $data['antar'],
            'gambar' => 'belum',
            'tipe_bayar' => $data['bayar'],
            'status_bayar' => 'belum',
            'status_antar' => 'belum'
        ];
        $this->db->insert('tb_pemesanan', $datas);
    }
    public function insert_daftar_pesan($data)
    {
        $datas = [
            'id_produk' => $data['id_produk'],
            'nota_produk' => $data['nota'],
            'total_harga' => $data['total'],
            'catatan' => $data['catatan'],
            'jumlah_pesan' => $data['jumlah_pesan']
        ];
        $this->db->insert('tb_detail_produk', $datas);
    }

    public function transaksi_by_id($id)
    {
        return $this->db->where('id_pelanggan', $id)->get('tb_pemesanan')->result_array();
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
    public function insert_keranjang($data)
    {
        $datas = [
            'id_keranjang' => random_string('numeric', 5),
            'id_pelanggan' => $data['pelanggan'],
            'id_produk' => $data['pesan'],
            'jumlah_pesan' => $data['jumlah'],
            'total_harga' => $data['total'],
            'catatan' => $data['catatan']
        ];
        $this->db->insert('tb_keranjang', $datas);
    }
    public function keranjang_where($data)
    {
        return $this->db->where('id_pelanggan', $data)->get('tb_keranjang')->result_array();
    }

    public function delete_keranjang($data)
    {
        $this->db->where('id_pelanggan', $data)->delete('tb_keranjang');
    }

    public function edit_pesanan($data)
    {
        $id =  $data['pesan'];
        $datas = [
            'jumlah_pesan' => $data['jumlah'],
            'catatan' => $data['catatan']
        ];
        $this->db->where('id_keranjang', $id)->update('tb_keranjang', $datas);
    }

    public function hapus_pesanan($data)
    {
        $this->db->where('id_keranjang', $data['pesan'])->delete('tb_keranjang');
    }
    public function upload_validation($data)
    {
        $datas = ['gambar' => $data['file']];
        $this->db->where('nota_pemesanan', $data['transaksi'])->update('tb_pemesanan', $datas);
    }
    public function get_all_bayar()
    {
        return $this->db->get('tb_bayar')->result_array();
    }
}

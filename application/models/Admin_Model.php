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
            'satuan' => $data['satuan'],
            'kategori' => $data['kategori'],
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
            'satuan' => $data['satuan'],
            'kategori' => $data['kategori'],
        ];
        $this->db->where('id_produk', $id)->update('tb_produk', $datas);
    }

    public function delete_produk($data)
    {
        $id = $data['produk'];
        $this->db->where('id_produk', $id)->delete('tb_produk');
    }
    // END PRODUK

    // STATUS BAYAR
    public function get_status_bayar()
    {
        return $this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_pemesanan.id_pelanggan')->where('status_bayar', 'dp')->or_where('status_bayar', 'lunas')->get('tb_pemesanan')->result_array();
    }
    // END STATUS bAYAR

    // STATUS ANTAR
    public function get_status_antar()
    {
        return $this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_pemesanan.id_pelanggan')->where('status_antar', 'selesai')->get('tb_pemesanan')->result_array();
    }
    // END STATUS ANTAR

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

    // BAYAR
    public function get_all_bayar()
    {
        return $this->db->get('tb_bayar')->result_array();
    }

    public function insert_bayar($data)
    {
        $datas = ['tipe_bayar' => $data['bayar'], 'nama_rekening' => $data['nama'], 'no_rekening' => $data['no']];
        $this->db->insert('tb_bayar', $datas);
    }

    public function update_bayar($data)
    {
        $id = $data['id'];
        $datas = ['tipe_bayar' => $data['bayar'], 'nama_rekening' => $data['nama'], 'no_rekening' => $data['no']];
        $this->db->where('tipe_bayar', $id)->update('tb_bayar', $datas);
    }
    public function delete_bayar($data)
    {
        $id = $data['id'];
        $this->db->where('tipe_bayar', $id)->delete('tb_bayar');
    }

    public function count_transaksi()
    {
        return $this->db->select('count(nota_pemesanan) as transaksi')->get('tb_pemesanan')->row_array();
    }
    public function count_bayar()
    {
        return $this->db->select('count(nota_pemesanan) as bayar')->where('status_bayar', 'lunas')->or_where('status_bayar', 'dp')->get('tb_pemesanan')->row_array();
    }
    public function count_antar()
    {
        return $this->db->select('count(nota_pemesanan) as antar')->where('status_antar', 'selesai')->get('tb_pemesanan')->row_array();
    }
    // END BAYAR

    // PELANGGAN
    public function get_all_pelanggan()
    {
        return $this->db->get('tb_pelanggan')->result_array();
    }
    public function delete_pelanggan($data)
    {
        $id = $data['id'];
        $this->db->where('id_pelanggan', $id)->delete('tb_pelanggan');
    }
    public function insert_pelanggan($data)
    {
        $datas = [
            'nm_pelanggan' => $data['nama'],
            'email' => $data['email'],
            'no_hp' => $data['telpon'],
            'alamat' => $data['alamat'],
            'password' => $data['password'],
        ];
        $this->db->insert('tb_pelanggan', $datas);
    }
    public function update_pelanggan($data)
    {
        $id = $data['id'];
        $datas = [
            'nm_pelanggan' => $data['nama'],
            'email' => $data['email'],
            'no_hp' => $data['telpon'],
            'alamat' => $data['alamat'],
            'password' => $data['password'],
        ];
        $this->db->where('id_pelanggan', $id)->update('tb_pelanggan', $datas);
    }
    // END PElANGGAN
}

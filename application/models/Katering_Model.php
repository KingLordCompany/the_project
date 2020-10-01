<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Katering_Model extends CI_Model
{
    public function produk()
    {
        return $this->db->get('tb_produk')->result_array();
    }
    public function produk_where($id)
    {
        return $this->db->where('id_produk', $id)->get('tb_produk')->row_array();
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katering extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Katering_Model');
    }

    public function index()
    {
        $data['produk'] = $this->Katering_Model->produk();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar_f');
        $this->load->view('katering/index', $data);
        $this->load->view('templates/footer');
    }
    public function pesan($id = "")
    {
        $id = $this->Katering_Model->produk_where($id);
        if ($id['id_produk']) {
            $data['pesan'] = $id;
            $this->load->view('templates/header');
            $this->load->view('templates/topbar_f');
            $this->load->view('katering/pesan', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('katering/index');
        }
    }

    public function add_pesan()
    {
        $id = $this->input->post('pesan');
        $this->form_validation->set_rules('pesan', 'Pesan', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal dihapus
          </div>');
            redirect('admin/pesan/' . $id);
        } else {
            $data = $this->input->post();
            $this->Admin_Model->delete_produk($data);

            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                Data berhasil dihapus
              </div>');
            redirect('admin/produk');
        }
    }
}

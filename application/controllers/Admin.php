<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Model');
    }

    public function template()
    {
    }
    public function profile()
    {
        $data['judul'] = 'King Lord';
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/profile', $data);
        $this->load->view('template_admin/footer');
    }
    public function index()
    {
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/index');
        $this->load->view('template_admin/footer');
    }

    // USER
    public function user()
    {
        $data['judul'] = 'User';
        $data['admin'] = $this->Admin_Model->get_all();

        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/user', $data);
        $this->load->view('template_admin/footer');
    }
    public function insert_user()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_admin.email]|valid_email');
        $this->form_validation->set_rules('telpon', 'Telpon', 'required|is_natural|min_length[10]|is_unique[tb_admin.no_hp]');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal dimasukan
          </div>');
            redirect('admin/user');
        } else {
            $data = $this->input->post();
            $this->Admin_Model->insert_user($data);

            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                Data berhasil masukan
              </div>');
            redirect('admin/user');
        }
        $data = $this->input->post();
        $this->Admin_Model->insert_user($data);
    }

    public function delete_admin()
    {
        $this->form_validation->set_rules('admin', 'Admin', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal dihapus
          </div>');
            redirect('admin/user');
        } else {
            $data = $this->input->post();
            $this->Admin_Model->delete_user($data);

            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                Data berhasil dihapus
              </div>');
            redirect('admin/user');
        }
    }



    // USER
    public function produk()
    {
        $data['judul'] = 'Produk';
        $data['produk'] = $this->Admin_Model->get_all_produk();

        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/produk', $data);
        $this->load->view('template_admin/footer');
    }
    public function insert_produk()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|is_natural');
        $this->form_validation->set_rules('minimal_pesan', 'Minimal Pesan', 'required|is_natural');
        // $this->form_validation->set_rules('file', 'Foto', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal dimasukan
          </div>');
            redirect('admin/produk');
        } else {
            $files = $_FILES['file']['name'];
            if ($files) {
                $config['upload_path']          = './assets/img/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file')) {
                    $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
                    Data gagal dimasukan
                  </div>');
                    redirect('admin/produk');
                } else {
                    $data = $this->input->post();
                    $data['foto'] = $this->upload->data('file_name');
                    $this->Admin_Model->insert_produk($data);
                    $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                        Data berhasil dimasukan
                    </div>');
                    redirect('admin/produk');
                }
            }
        }
    }
    public function update_produk()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|is_natural');
        $this->form_validation->set_rules('minimal_pesan', 'Minimal Pesan', 'required|is_natural');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal dimasukan
          </div>');
            redirect('admin/produk');
        } else {
            $data = $this->input->post();
            $produk = $this->db->where('id_produk', $data['produk'])->get('tb_produk')->row_array();
            $files = $_FILES['file']['name'];
            if ($files) {
                $config['upload_path']          = './assets/img/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file')) {
                    $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
                    Data gagal dimasukan
                  </div>');
                    redirect('admin/produk');
                } else {
                    $data = $this->input->post();
                    $data['foto'] = $this->upload->data('file_name');
                    $this->Admin_Model->insert_produk($data);
                    $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                        Data berhasil dimasukan
                    </div>');
                    redirect('admin/produk');
                }
            } else {
                $data = $this->input->post();
                $data['foto'] = $produk['foto'];
                $this->Admin_Model->update_produk($data);
                $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                    Data berhasil dimasukan
                </div>');
                redirect('admin/produk');
            }
        }
    }
    public function delete_produk()
    {
        $this->form_validation->set_rules('produk', 'Produk', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal dihapus
          </div>');
            redirect('admin/produk');
        } else {
            $data = $this->input->post();
            $this->Admin_Model->delete_produk($data);

            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                Data berhasil dihapus
              </div>');
            redirect('admin/produk');
        }
    }
    // END USER


    // END USER

    // USER
    // public function kategori()
    // {
    //     $data['judul'] = 'Kategori';
    //     $this->load->view('templates/header');
    //     $this->load->view('admin/kategori', $data);
    //     $this->load->view('templates/footer');
    // }
    // public function insert_kategori()
    // {
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->load->view('myform');
    //     } else {
    //         $this->load->view('formsuccess');
    //     }
    //     # code...
    // }

    // public function update_kategori()
    // {
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->load->view('myform');
    //     } else {
    //         $this->load->view('formsuccess');
    //     }
    //     # code...
    // }

    // public function delete_kategori()
    // {
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->load->view('myform');
    //     } else {
    //         $this->load->view('formsuccess');
    //     }
    //     # code...
    // }
    // END USER

}

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
            $user = $this->session->userdata('id_pelanggan');
            if ($user) {
                $data['pesan'] = $id;
                $this->load->view('templates/header');
                $this->load->view('templates/topbar_f');
                $this->load->view('katering/pesan', $data);
                $this->load->view('templates/footer');
            } else {
                $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
                Login Terlebih Dahulu
              </div>');
                redirect('katering/index');
            }
        } else {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
                Login Terlebih Dahulu
              </div>');
            redirect('katering/index');
        }
    }

    public function add_pesan()
    {
        $id = $this->input->post('pesan');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal dimasukan
          </div>');
            redirect('katering/pesan/' . $id);
        } else {
            $number = $this->session->userdata('number');
            if (isset($number)) {
                $number += 1;
                $number = $this->session->set_userdata('number', $number);
            } else {
                $number =  $this->session->set_userdata('number', 1);
            }
            $number = $this->session->userdata('number');
            $data = $this->input->post();
            $_SESSION['daftar'][$number] = $data;
            $info =  $this->session->userdata('daftar');
            print_r($info);
        }
    }

    public function daftar()
    {
        $this->form_validation->set_rules('nama', 'Pesan', 'required');
        $this->form_validation->set_rules('email', 'Pesan', 'required|valid_email|is_unique[tb_pelanggan.email]');
        $this->form_validation->set_rules('telpon', 'Pesan', 'required|min_length[10]|is_unique[tb_pelanggan.no_hp]');
        $this->form_validation->set_rules('alamat', 'Pesan', 'required');
        $this->form_validation->set_rules('pass1', 'Pesan', 'required');
        $this->form_validation->set_rules('pass2', 'Pesan', 'required|matches[pass1]');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Gagal Mendaftar
          </div>');
            redirect('katering/index');
        } else {
            $data = $this->input->post();
            $this->Katering_Model->insert_daftar($data);

            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                Berhasil Mendaftar
              </div>');
            redirect('katering/index');
        }
    }
    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Gagal Login
          </div>');
            redirect('katering/index');
        } else {
            $data = $this->input->post();
            $check = $this->Katering_Model->login($data);

            if ($check) {
                if ($check['email'] == $data['email']) {
                    if ($check['password'] == $data['password']) {
                        $this->session->set_userdata('id_pelanggan', $check['id_pelanggan']);
                        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                            Berhasil Login
                        </div>');
                        redirect('katering/index');
                    } else {
                        $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
                            Gagal Login
                        </div>');
                        redirect('katering/index');
                    }
                } else {
                    $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
                    Gagal Login
                </div>');
                    redirect('katering/index');
                }
            } else {
                $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Gagal Login
          </div>');
                redirect('katering/index');
            }
        }
    }
    public function pesanan()
    {
        $data['produk'] = $this->Katering_Model->produk();
        $data['detail'] = $this->session->userdata('daftar');
        $this->load->view('templates/header');
        $this->load->view('templates/topbar_f');
        $this->load->view('katering/pesanan', $data);
        $this->load->view('templates/footer');
    }
}

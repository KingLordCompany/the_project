<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_Model');
        $id = $this->session->userdata('id_admin');
        if ($id) {
            redirect('admin');
        }
    }
    public function index()
    {
        $this->load->view('template_admin/header');
        $this->load->view('login/login');
        $this->load->view('template_admin/footer');
    }

    public function check_login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal dimasukan
          </div>');
            redirect('login/login');
        } else {
            $data = $this->input->post();
            $check = $this->Login_Model->check_login($data);
            if (isset($check)) {
                if ($check['email'] == $data['email'] && $check['password'] == $data['password']) {
                    $data = $this->session->set_userdata('id_admin', $check['id_admin']);
                    redirect('admin');
                } else {
                    $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
                    Data gagal dimasukan
                  </div>');
                    redirect('login/login');
                }
            } else {
                $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
                Data gagal dimasukan
              </div>');
                redirect('login/login');
            }
        }
    }
}

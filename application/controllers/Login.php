<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $this->load->view('template_admin/header');
        $this->load->view('login/login');
        $this->load->view('template_admin/footer');
    }
}

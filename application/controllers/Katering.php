<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katering extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Katering_Model');
        require APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
    }

    public function index($kategori = null)
    {
        $data['produk'] = $this->Katering_Model->produk($kategori);
        $data['title'] = $kategori == null ? "Semua Produk" : ucfirst($kategori);

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
            $data = $this->input->post();
            $id_pesan = $data['pesan'];
            $pesan = $this->Katering_Model->produk_where($id_pesan);
            $data['total'] = $pesan['harga'] * $data['jumlah'];
            $data['pelanggan'] = $this->session->userdata('id_pelanggan');
            $this->Katering_Model->insert_keranjang($data);
            redirect('katering/pesanan');
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
        $user = $this->session->userdata('id_pelanggan');
        $data['user'] = $this->Katering_Model->user_by_id($user);
        $data['produk'] = $this->Katering_Model->produk();
        $data['detail'] = $this->Katering_Model->keranjang_where($user);
        $data['bayar'] = $this->Katering_Model->get_all_bayar();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar_f');
        $this->load->view('katering/pesanan', $data);
        $this->load->view('templates/footer');
    }
    public function transaksi()
    {

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('waktu', 'Waktu', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Gagal Melakukan Transaksi
          </div>');
            redirect('katering/pesanan');
        } else {
            $data = $this->input->post();
            $nota = idate('d') . idate('m') . idate('Y') . random_string('alnum', 5);
            $date = $data['tanggal'];
            $waktu = $data['waktu'];
            $tanggal = date('Y-m-d H:i:s', strtotime("$date $waktu"));
            $user = $this->session->userdata('id_pelanggan');
            $data['nota'] = $nota;
            $data['pelanggan'] =  $user;
            $data['antar'] = $tanggal;
            $this->Katering_Model->insert_pemmesanan($data);
            $daftar = $this->Katering_Model->keranjang_where($user);
            foreach ($daftar as $data_detail) {
                $data_detail['nota'] = $nota;
                $produk = $this->Katering_Model->produk_once($data_detail['id_produk']);
                $data_detail['total'] =  $produk['harga'] * $data_detail['jumlah_pesan'];
                $this->Katering_Model->insert_daftar_pesan($data_detail);
            }
            $this->Katering_Model->delete_keranjang($user);
            // $this->_invoice();
            redirect('katering/keranjang');
        }
    }

    public function keranjang()
    {
        $id = $this->session->userdata('id_pelanggan');
        $data['keranjang'] = $this->Katering_Model->transaksi_by_id($id);
        $this->load->view('templates/header');
        $this->load->view('templates/topbar_f');
        $this->load->view('katering/keranjang', $data);
        $this->load->view('templates/footer');
    }

    public function tampil($id_transaksi)
    {
        $dompdf = new DOMPDF();
        $data['transaksi'] = $this->Katering_Model->transaksi_by_nota($id_transaksi);
        $data['pelanggan'] = $this->Katering_Model->user_by_id($data['transaksi']['id_pelanggan']);
        $html = $this->load->view('laporan/invoice', $data, true);
        $dompdf->load_html($html);
        $dompdf->set_paper('A4', 'landscape');
        $dompdf->render();
        // $pdf = $dompdf->output();
        $dompdf->stream('invoice.pdf', ['Attachmment' => false]);
    }

    public function hapus_pesanan()
    {
        $this->form_validation->set_rules('pesan', 'Pesan', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Gagal Menghapus Data
          </div>');
            redirect('katering/pesanan');
        } else {
            $data = $this->input->post();
            $this->Katering_Model->hapus_pesanan($data);
            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
            Berhasil Menghapus Data
          </div>');
            redirect('katering/pesanan');
        }
    }

    public function edit_pesanan()
    {
        $this->form_validation->set_rules('pesan', 'Pesan', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('catatan', 'Catatn', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Gagal Mengubah Data
          </div>');
            redirect('katering/pesanan');
        } else {
            $data = $this->input->post();
            $this->Katering_Model->edit_pesanan($data);
            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
            Berhasil Mengubah Data
          </div>');
            redirect('katering/pesanan');
        }
    }
    public function upload_validation()
    {
        $this->form_validation->set_rules('transaksi', 'Transaksi', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Gagal Mengubah Data
          </div>');
            redirect('katering/pesanan');
        } else {
            $data = $_FILES['file'];
            if ($data) {
                $config['upload_path']          = './assets/img/validation_img/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file')) {
                    $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
                Gagal Mengupload Data
              </div>');
                    redirect('katering/keranjang');
                } else {
                    $data['file'] = $this->upload->data('file_name');
                    $data['transaksi'] = $this->input->post('transaksi');
                    $this->Katering_Model->upload_validation($data);
                    $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
                        Berhasil Mengupload Data
                      </div>');
                    redirect('katering/keranjang');
                }
            }
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('katering');
    }

    public function pesan_invoice()
    {
        $id = $this->session->userdata('id_pelanggan');
        $data['keranjang'] = $this->Katering_Model->transaksi_by_id($id);
        $this->load->view('templates/header');
        $this->load->view('templates/topbar_f');
        $this->load->view('katering/invoice', $data);
        $this->load->view('templates/footer');
    }
}

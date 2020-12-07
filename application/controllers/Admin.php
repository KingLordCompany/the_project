<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        require APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
        $this->load->model('Admin_Model');
        $id = $this->session->userdata('id_admin');
        if (empty($id)) {
            redirect('katering');
        }
    }

    public function profile()
    {
        $user = $this->session->userdata('id_admin');
        $admin = $this->Admin_Model->admin_where($user);
        $data['judul'] = $admin['username'];
        $data['admin'] = $admin;
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/profile', $data);
        $this->load->view('template_admin/footer');
    }
    public function change_pass()
    {
        $this->form_validation->set_rules('pass1', 'Password', 'required');
        $this->form_validation->set_rules('pass2', 'Confirm pass', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal diubah
          </div>');
            redirect('admin/profile');
        } else {
            $data = $this->input->post();
            $this->Admin_Model->change_pass($data);

            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                Data berhasil diubah
              </div>');
            redirect('admin/profile');
        }
    }
    public function index()
    {
        $data['transaksi'] = $this->Admin_Model->count_transaksi();
        $data['bayar'] = $this->Admin_Model->count_bayar();
        $data['antar'] = $this->Admin_Model->count_antar();

        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/index', $data);
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

    // END USER


    // PRODUK
    public function produk()
    {
        $data['judul'] = 'Produk';
        $data['produk'] = $this->Admin_Model->get_all_produk();
        $data['satuan'] = [
            'Porsi' => 'porsi',
            'Kotak' => 'kotak'
        ];
        $data['kategori'] = [
            'Prasmanan' => 'prasmanan',
            'Paket' => 'paket'
        ];

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
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
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
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
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
    // END PRODUK

    // BANK


    public function bayar()
    {
        $data['judul'] = 'Bayar';
        $data['produk'] = $this->Admin_Model->get_all_bayar();

        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/bank', $data);
        $this->load->view('template_admin/footer');
    }

    public function insert_bayar()
    {
        $this->form_validation->set_rules('bayar', 'Bayar', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('no', 'Nomor', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal dimasukan
          </div>');
            redirect('admin/bayar');
        } else {
            $data = $this->input->post();
            $this->Admin_Model->insert_bayar($data);

            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                Data berhasil dimasukan
              </div>');
            redirect('admin/bayar');
        }
    }

    public function update_bayar()
    {
        $this->form_validation->set_rules('bayar', 'Bayar', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('no', 'Nomor', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal dimasukan
          </div>');
            redirect('admin/bayar');
        } else {
            $data = $this->input->post();
            $this->Admin_Model->update_bayar($data);

            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                Data berhasil dimasukan
              </div>');
            redirect('admin/bayar');
        }
    }

    public function delete_bayar()
    {
        $this->form_validation->set_rules('id', 'Bayar', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal dimasukan
          </div>');
            redirect('admin/bayar');
        } else {
            $data = $this->input->post();
            $this->Admin_Model->delete_bayar($data);

            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                Data berhasil dimasukan
              </div>');
            redirect('admin/bayar');
        }
    }

    // END BANK

    // END PELANGGAN
    public function pelanggan()
    {
        $data['judul'] = 'pelanggan';
        $data['admin'] = $this->Admin_Model->get_all_pelanggan();

        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/pelanggan', $data);
        $this->load->view('template_admin/footer');
    }
    public function insert_pelanggan()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_admin.email]|valid_email');
        $this->form_validation->set_rules('telpon', 'Telpon', 'required|is_natural|min_length[10]|is_unique[tb_admin.no_hp]');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal dimasukan
          </div>');
            redirect('admin/pelanggan');
        } else {
            $data = $this->input->post();
            $this->Admin_Model->insert_pelanggan($data);

            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                Data berhasil masukan
              </div>');
            redirect('admin/pelanggan');
        }
    }
    public function update_pelanggan()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_admin.email]|valid_email');
        $this->form_validation->set_rules('telpon', 'Telpon', 'required|is_natural|min_length[10]|is_unique[tb_admin.no_hp]');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal edit
          </div>');
            redirect('admin/pelanggan');
        } else {
            $data = $this->input->post();
            $this->Admin_Model->update_pelanggan($data);

            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                Data berhasil edit
              </div>');
            redirect('admin/pelanggan');
        }
    }
    public function delete_pelanggan()
    {
        $this->form_validation->set_rules('id', 'Pelanggan', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal dihapus
          </div>');
            redirect('admin/pelanggan');
        } else {
            $data = $this->input->post();
            $this->Admin_Model->delete_pelanggan($data);

            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                Data berhasil dihapus
              </div>');
            redirect('admin/pelanggan');
        }
    }
    // END PELANGGAN


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

    // BAYAR
    // public function bayar()
    // {
    //     $this->load->view('template_admin/header');
    //     $this->load->view('template_admin/sidebar');
    //     $this->load->view('admin/transaksi', $data);
    //     $this->load->view('template_admin/footer');
    // }
    // END BAYAR

    // STATUS BAYAR
    public function status_bayar()
    {
        $data['bayar'] = [
            'Belum' => 'belum',
            'DP' => 'dp',
            'Lunas' => 'lunas'
        ];
        $data['antar'] = [
            'Belum' => 'belum',
            'Antar' => 'antar'
        ];
        $data['judul'] = 'Status Bayar';
        $data['transaksi'] = $this->Admin_Model->get_status_bayar();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/status_bayar', $data);
        $this->load->view('template_admin/footer');
    }

    // END STATUS BAYAR
    // MENUNGGU DIANTAR
    public function menunggu_diantar()
    {
        $data['bayar'] = [
            'Belum' => 'belum',
            'DP' => 'dp',
            'Lunas' => 'lunas'
        ];
        $data['antar'] = [
            'Belum' => 'belum',
            'Antar' => 'antar'
        ];
        $data['judul'] = 'Menunggu Diantar';
        $data['transaksi'] = $this->Admin_Model->get_status_bayar();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/menunggu', $data);
        $this->load->view('template_admin/footer');
    }

    // END MENUNGGU DIANTAR

    // STATUS ANTAR
    public function status_antar()
    {
        $data['bayar'] = [
            'Belum' => 'belum',
            'DP' => 'dp',
            'Lunas' => 'lunas'
        ];
        $data['antar'] = [
            'Belum' => 'belum',
            'Antar' => 'antar'
        ];
        $data['judul'] = 'Status Antar';
        $data['transaksi'] = $this->Admin_Model->get_status_antar();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/status_antar', $data);
        $this->load->view('template_admin/footer');
    }
    // END STATUS ANTAR

    // TRANSAKSI
    public function transaksi()
    {
        $data['bayar'] = [
            'Belum' => 'belum',
            'DP' => 'dp',
            'Lunas' => 'lunas'
        ];
        $data['antar'] = [
            'Belum' => 'belum',
            'Selesai' => 'selesai'
        ];
        $data['judul'] = 'Transaksi';
        $data['transaksi'] = $this->Admin_Model->get_transaksi();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/transaksi', $data);
        $this->load->view('template_admin/footer');
    }

    public function edit_status_transaksi()
    {
        $this->form_validation->set_rules('bayar', 'Bayar', 'required');
        $this->form_validation->set_rules('antar', 'Antar', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            Data gagal diubah
          </div>');
            redirect('admin/transaksi');
        } else {
            $data = $this->input->post();
            $this->Admin_Model->edit_status_transaksi($data);

            $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
                Data berhasil diubah
              </div>');
            redirect('admin/transaksi');
        }
    }

    public function laporan()
    {
        $data = $this->input->post();
        $data['laporan'] = $this->db->where('tgl_order >=', $data['dari'])->where('tgl_order <=', $data['sampai'])->get('tb_pemesanan')->result_array();
        $dompdf = new DOMPDF();
        $html = $this->load->view('laporan/laporan', $data, true);
        $dompdf->load_html($html);
        $dompdf->set_paper('A4', 'landscape');
        $dompdf->render();
        $pdf = $dompdf->output();
        $dompdf->stream('laporan.pdf', ['Attachmment' => false]);
    }
    // END TRANSAKSI

}

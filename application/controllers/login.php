<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login extends CI_Controller
{
    public function index()
    {
        $this->load->view('login');
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('materi_security_model');
    }
    public function ceklogin()
    {
        $post = $this->input->post();
        if (isset($post['username']) && isset($post['password'])) {
            //cek user
            $user = $this->materi_security_model;
            $data = $user->getByUsernamePassword();

            if ($data != null) {
                $username = $data->username;
                $nama = $data->nama;
                $password = $data->password;
                $role = $data->role;

                $newdata = array(
                    'username' => $username,
                    'nama' => $nama,
                    'password' => $password,
                    'role' => $role,
                );
                $this->session->set_userdata($newdata);

                if ($role == 'admin') {
                    redirect(site_url('Halo'));
                } else if ($role == 'user') {
                    echo "<script>alert('Selamat datang dosen');</script>";
                }
            } else {
                echo "<script>alert('Login Gagal');</script>";
            }
        } else {
            $this->load->view('login');
        }
    }
}

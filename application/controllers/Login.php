<?php
/* halaman login utama 
   author by Kassandra Production
*/

class Login extends CI_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Login_m');
        $this->load->model('m_pengaturan');
    }

    public function index()
    {
        if (isset($_POST['login'])) {
            $nama = $this->input->post('email');
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Cek data login
            $superadmin = $this->Login_m->Superadmin($nama, $email, md5($password));
            $admin = $this->Login_m->Admin($nama, $email, md5($password));
            $dosen = $this->Login_m->Dosen($nama, $email, md5($password));

            if ($superadmin->num_rows() > 0) {
                // Handle jika login sebagai superadmin
                $DataSuperAdmin = $superadmin->row_array();
                $sessionSuperAdmin = array(
                    'superadmin'        => TRUE,
                    'id_pengguna'       => $DataSuperAdmin['id_pengguna'],
                    'email'             => $DataSuperAdmin['email'],
                    'password'          => $DataSuperAdmin['password'],
                    'nama'              => $DataSuperAdmin['nama'],
                    'keterangan'        => $DataSuperAdmin['keterangan'],
                    'level'             => $DataSuperAdmin['id_level'],
                );
                $this->session->set_userdata($sessionSuperAdmin);
                $this->session->set_flashdata('pesan', '<div class="btn btn-primary">Anda Berhasil Login .....</div>');
                redirect(base_url('superadmin/home'));
            } elseif ($admin->num_rows() > 0) {
                // Handle jika login sebagai admin
                $DataAdmin = $admin->row_array();
                $sessionAdmin = array(
                    'admin'             => TRUE,
                    'id_pengguna'       => $DataAdmin['id_pengguna'],
                    'email'             => $DataAdmin['email'],
                    'password'          => $DataAdmin['password'],
                    'nama'              => $DataAdmin['nama'],
                    'keterangan'        => $DataAdmin['keterangan'],
                    'level'             => $DataAdmin['id_level'],
                );
                $this->session->set_userdata($sessionAdmin);
                $this->session->set_flashdata('pesan', '<div class="btn btn-success">Anda Berhasil Login .....</div>');
                redirect(base_url('admin/home'));
            } elseif ($dosen->num_rows() > 0) {
                // Handle jika login sebagai dosen
                $DataDosen = $dosen->row_array();
                $sessionDosen = array(
                    'dosen'             => TRUE,
                    'id_pengguna'       => $DataDosen['id_pengguna'],
                    'email'             => $DataDosen['email'],
                    'password'          => $DataDosen['password'],
                    'nama'              => $DataDosen['nama'],
                    'keterangan'        => $DataDosen['keterangan'],
                    'level'             => $DataDosen['id_level'],
                );
                $this->session->set_userdata($sessionDosen);
                $this->session->set_flashdata('pesan', '<div class="btn btn-success">Anda Berhasil Login .....</div>');
                redirect(base_url('dosen/home'));
            } else {
                // Periksa apakah email/username benar
                $isEmailValid = $this->Login_m->IsEmailValid($email);
                if ($isEmailValid->num_rows() > 0) {
                    // Jika email benar, maka password salah
                    $pesan = '<script>
                    swal({
                        title: "Password Salah",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    });
                    </script>';
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect(base_url('login'));
                  } else {
                    // Jika email salah, maka email tidak terdaftar
                    $pesan = '<script>
                    swal({
                        title: "Email Salah atau Tidak Terdaftar",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    });
                    </script>';
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect(base_url('login'));
                  }
            }
        } else {
            $data = $this->m_pengaturan->view()->row_array();
            $x = array(
                'judul' =>'Login Aplikasi',
                'nama_judul' => $data['nama_judul'],
                'meta_keywords' => $data['meta_keywords'],
                'meta_description' => $data['meta_description'],
                'background' => $data['background'],
            );

            $this->load->view('login-v2', $x);
        }
    }
}

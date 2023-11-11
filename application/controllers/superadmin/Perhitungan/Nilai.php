<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Nilai extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      $this->load->library('form_validation');
      
	 // error_reporting(0);
	 if($this->session->userdata('superadmin') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('M_perhitungan_AHP');
    $this->load->model('m_event');
    $this->load->model('m_medsos');
    $this->load->model('m_website');
    $this->load->model('m_sanksi');
	}

    //Lihat Data
    public function nilai_asli($value='')
    {
     $view = array('judul'      =>'Data Anggota KIM',
                    'aksi'      =>'lihat',
                    'data'      =>$this->M_perhitungan_AHP->view()->result_array(),
                  );

      $this->load->view('superadmin/perhitungan/nilai_asli',$view);
    }

    public function hitungBobotAHP() {
      $data['judul'] = 'Perhitungan Bobot AHP';
      $data['criteria'] = ['K1', 'K2', 'K3', 'K4'];
      
    //   $datavalues = [1, 4, 3, 4]; // Masukkan nilai dari input

      //mengambil data dari database
        $data['data'] = $this->M_perhitungan_AHP->view()->row_array();

        $datavalues = array(
                            $data['data']['bobot_event'], 
                            $data['data']['bobot_medsos'], 
                            $data['data']['bobot_website'], 
                            $data['data']['bobot_sanksi']
                        );

        // Membuat matriks perbandingan dari nilai yang dimasukkan
        $matriksPerbandingan = [];
        $a = $datavalues[0];
        $b = $datavalues[1];
        $c = $datavalues[2];
        $d = $datavalues[3];

        //row 1
        $matriksPerbandingan[0][0] = $a;
        $matriksPerbandingan[0][1] = $b;
        $matriksPerbandingan[0][2] = $c;
        $matriksPerbandingan[0][3] = $d;

        //row 2
        $matriksPerbandingan[1][0] = 1 / $b;
        $matriksPerbandingan[1][1] = $a;
        $matriksPerbandingan[1][2] = $b;
        $matriksPerbandingan[1][3] = $c;

        //row 3
        $matriksPerbandingan[2][0] = 1 / $c;
        $matriksPerbandingan[2][1] = 1 / $b;
        $matriksPerbandingan[2][2] = $a;
        $matriksPerbandingan[2][3] = $b;

        //row 4
        $matriksPerbandingan[3][0] = 1 / $d;
        $matriksPerbandingan[3][1] = 1 / $c;
        $matriksPerbandingan[3][2] = 1 / $b;
        $matriksPerbandingan[3][3] = $a;

                        
  
      // Menghitung jumlah setiap kolom
      $jumlahKolom = array();
      foreach ($matriksPerbandingan as $row) {
          foreach ($row as $kolom => $nilai) {
              if (!isset($jumlahKolom[$kolom])) {
                  $jumlahKolom[$kolom] = 0;
              }
              $jumlahKolom[$kolom] += $nilai;
          }
      }
  
      // Menghitung nilai eigen
      $nilaiEigen = array();
      foreach ($matriksPerbandingan as $row) {
          $kriteriaEigen = array();
          foreach ($row as $kolom => $nilai) {
              $eigen = $nilai / $jumlahKolom[$kolom];
              $kriteriaEigen[] = $eigen;
          }
          $nilaiEigen[] = $kriteriaEigen;
      }
  
      // Tampilkan hasil perhitungan dalam tampilan
      $data['matriksPerbandingan'] = $matriksPerbandingan;
      $data['jumlahKolom'] = $jumlahKolom;
      $data['nilaiEigen'] = $nilaiEigen;
      $data['nama_kim'] = $data['data']['nama_kim'];
  
      // Tampilkan hasil ke dalam view
      $this->load->view('superadmin/perhitungan/ahp', $data);
  }
  
	
}
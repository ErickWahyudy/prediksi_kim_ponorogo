<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Nilai_perbandingan extends CI_controller
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
    public function index()
    {
      $data['judul'] = 'Perhitungan Perbandingan';
      $data['criteria'] = ['K1', 'K2', 'K3', 'K4'];

      foreach ($data['criteria'] as $key => $value) {
          $data['data_kim'] = $this->M_perhitungan_AHP->view()->result_array();
      }

      foreach ($data['data_kim'] as $data_kim) {
          $datavalues = [
              $data_kim['bobot_event'],
              $data_kim['bobot_medsos'],
              $data_kim['bobot_website'],
              $data_kim['bobot_sanksi']
          ];

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

      $this->load->view('superadmin/perhitungan/nilai_perbandingan', $data);
    }

    //Detail Data
    Public Function detail($id_anggota='')
    {
       $data['judul'] = 'Detail Perhitungan';
       $data['criteria'] = ['K1', 'K2', 'K3', 'K4'];

      //mengambil data dari database
        $data['data'] = $this->M_perhitungan_AHP->view_id($id_anggota)->row_array();

        for ($i=0; $i < count($data['data']); $i++) { 
            $datavalues = array(
                $data['data']['bobot_event'], 
                $data['data']['bobot_medsos'], 
                $data['data']['bobot_website'], 
                $data['data']['bobot_sanksi']
            );
        }

           // Membuat matriks perbandingan dari nilai yang dimasukkan
           $a = $datavalues[0];
           $b = $datavalues[1];
           $c = $datavalues[2];
           $d = $datavalues[3];
           
           $matriksPerbandingan = [
            [$a, $b, $c, $d],
            [1 / $b, $a, $b, $c],
            [1 / $c, 1 / $b, $a, $b],
            [1 / $d, 1 / $c, 1 / $b, $a]
        ];
           
 
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

     //perangkingan untuk menentukan urutan peringkat
      $data['data']['bobot_event'] = $nilaiEigen[0][0];
      $data['data']['bobot_medsos'] = $nilaiEigen[1][0];
      $data['data']['bobot_website'] = $nilaiEigen[2][0];
      $data['data']['bobot_sanksi'] = $nilaiEigen[3][0];
      $data['data']['peringkat'] = $nilaiEigen[0][0] + $nilaiEigen[1][0] + $nilaiEigen[2][0] + $nilaiEigen[3][0];
      
 
     // Tampilkan hasil perhitungan dalam tampilan
     $data['matriksPerbandingan'] = $matriksPerbandingan;
     $data['jumlahKolom'] = $jumlahKolom;
     $data['nilaiEigen'] = $nilaiEigen;
     $data['perangkingan'] = $data['data']['peringkat'];

      $this->load->view('superadmin/perhitungan/nilai_perbandingan_detail', $data);
    }

	
}
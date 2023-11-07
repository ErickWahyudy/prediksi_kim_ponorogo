<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Hasil extends CI_controller
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
    
        $data['data_kim'] = $this->M_perhitungan_AHP->view()->result_array();
    
        // Array untuk menyimpan nilai eigen dari setiap data
        $nilaiEigenSetiapData = [];
    
        foreach ($data['data_kim'] as $data_kim) {
            $datavalues = [
                $data_kim['bobot_event'],
                $data_kim['bobot_medsos'],
                $data_kim['bobot_website'],
                $data_kim['bobot_sanksi']
            ];

            $total_bobot = array_sum($datavalues);

            foreach ($datavalues as $key => $value) {
                $datavalues[$key] /= $total_bobot;
            }
    
            // Membuat matriks perbandingan dari nilai yang dimasukkan
            $matriksPerbandingan = [];
    
            $a = $datavalues[0];
            $b = $datavalues[1];
            $c = $datavalues[2];
            $d = $datavalues[3];
    
            // Row 1
            $matriksPerbandingan[0][0] = $a;
            $matriksPerbandingan[0][1] = $b;
            $matriksPerbandingan[0][2] = $c;
            $matriksPerbandingan[0][3] = $d;
    
            // Row 2
            $matriksPerbandingan[1][0] = 1 / $b;
            $matriksPerbandingan[1][1] = $a;
            $matriksPerbandingan[1][2] = $b;
            $matriksPerbandingan[1][3] = $c;
    
            // Row 3
            $matriksPerbandingan[2][0] = 1 / $c;
            $matriksPerbandingan[2][1] = 1 / $b;
            $matriksPerbandingan[2][2] = $a;
            $matriksPerbandingan[2][3] = $b;
    
            // Row 4
            $matriksPerbandingan[3][0] = 1 / $d;
            $matriksPerbandingan[3][1] = 1 / $c;
            $matriksPerbandingan[3][2] = 1 / $b;
            $matriksPerbandingan[3][3] = $a;
    
            // Menghitung jumlah setiap kolom
            $jumlahKolom = [];
            foreach ($matriksPerbandingan as $row) {
                foreach ($row as $kolom => $nilai) {
                    if (!isset($jumlahKolom[$kolom])) {
                        $jumlahKolom[$kolom] = 0;
                    }
                    $jumlahKolom[$kolom] += $nilai;
                }
            }
    
            // Menghitung nilai eigen
            $nilaiEigen = [];
            foreach ($matriksPerbandingan as $row) {
                $kriteriaEigen = [];
                foreach ($row as $kolom => $nilai) {
                    $eigen = $nilai / $jumlahKolom[$kolom];
                    $kriteriaEigen[] = $eigen;
                }
                $nilaiEigen[] = $kriteriaEigen;
            }
            
              // Hitung total nilai rata-rata setiap kriteria
              $total_rata_kriteria = array_sum($datavalues) / count($datavalues);

              // Hitung nilai setiap KIM berdasarkan rumus yang diberikan
              $nilai_kim = [];
              for ($i = 0; $i < count($datavalues); $i++) {
                  $nilai_kim[$i] = $total_rata_kriteria * $nilaiEigen[$i][0];
                }
              // Hitung total bobot kriteria
              $total_bobot_kriteria = array_sum($datavalues);

              // Simpan nilai KIM, total bobot kriteria, dan nama_kim ke dalam array $nilaiEigenSetiapData
              $nama_kim = $data_kim['nama_kim']; // Pastikan ini sesuai dengan kolom 'nama_kim' di database

              $nilaiEigenSetiapData[] = [
                  'nama_kim' => $nama_kim,
                  'bobot_event' => $data_kim['bobot_event'],
                  'bobot_medsos' => $data_kim['bobot_medsos'],
                  'bobot_website' => $data_kim['bobot_website'],
                  'bobot_sanksi' => $data_kim['bobot_sanksi'],
                  'total_bobot_kriteria' => $total_bobot_kriteria,
                  'nilai_kim' => $nilai_kim,
                  'total_nilai_kim' => array_sum($nilai_kim), // Jumlahkan nilai KIM
              ];
              }

              // Urutkan berdasarkan total_nilai_kim dari yang terbesar ke terkecil
              usort($nilaiEigenSetiapData, function ($a, $b) {
              return $b['total_nilai_kim'] <=> $a['total_nilai_kim'];
              });
    
        $data['nilaiEigenSetiapData'] = $nilaiEigenSetiapData;
    
        $this->load->view('superadmin/perhitungan/hasil', $data);
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
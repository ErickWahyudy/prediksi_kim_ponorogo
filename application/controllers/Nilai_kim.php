<?php
/**
 * PHP for Codeigniter
 *
 * @package        	CodeIgniter
 * @pengembang		Kassandra Production (https://kassandra.my.id)
 * @Author			@erikwahyudy
 * @version			3.0
 */

defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Nilai_kim extends CI_controller
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
	//  if($this->session->userdata('admin') != TRUE){
    //  redirect(base_url(''));
    //  exit;
	// };
   $this->load->model('M_perhitungan_AHP');
    $this->load->model('m_event');
    $this->load->model('m_medsos');
    $this->load->model('m_website');
    $this->load->model('m_sanksi');
	}

    //Lihat Data
    public function index()
    {
        
            $data['judul'] = 'Nilai KIM';
            $criteria = ['bobot_event', 'bobot_medsos', 'bobot_website', 'bobot_sanksi'];
            $data['criteria'] = ['K1', 'K2', 'K3', 'K4'];
        
        
            // Ambil data dari database
            $data['data_kim'] = $this->M_perhitungan_AHP->view()->result_array();

            // Array untuk menyimpan semua hasil perhitungan
            $all_calculations = array();
        
            // Lakukan perhitungan untuk setiap baris data
            foreach ($data['data_kim'] as $data_kim) {
                $matriksPerbandingan = array();
        
                // Dapatkan 'nama_kim' dari hasil query
                $nama_kim = $data_kim['nama_kim'];
                $wilayah = $data_kim['wilayah'];
        
                // Ganti nilai a, b, c, dan d dengan nilai dari database yang sesuai
                $a = $data_kim['bobot_event'];
                $b = $data_kim['bobot_medsos'];
                $c = $data_kim['bobot_website'];
                $d = $data_kim['bobot_sanksi'];
        
                // Membuat matriks perbandingan dari nilai yang dimasukkan
                $matriksPerbandingan = [
                    [1, $a, 1 / $c, $b],
                    [1 / $a, 1, 1 / $d, $c],
                    [$c, $d, 1, $a],
                    [1 / $b, 1 / $c, 1 / $a, 1]
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
        
                //Rata rata nilai eigen
                $rataRataEigen = array();
                foreach ($nilaiEigen as $row) {
                    $rataRataEigen[] = array_sum($row) / count($row);
                }
        
                // Simpan hasil perhitungan untuk baris data saat ini ke dalam $all_calculations
                $calculations = [
                    'nama_kim' => $nama_kim,
                    'wilayah' => $wilayah,
                    'matriksPerbandingan' => $matriksPerbandingan,
                    'jumlahKolom' => $jumlahKolom,
                    'nilaiEigen' => $nilaiEigen,
                    'rataRataEigen' => $rataRataEigen,
                    'rataRataEigen_sorted' => $rataRataEigen,
                    'criteria'	=> $data['criteria']
                ];
        
                $all_calculations[] = $calculations;
            }

            // Tampilkan hasil perhitungan dalam tampilan
            $data['all_calculations'] = $all_calculations;
        $this->load->view('template/nilai_kim', $data);
    }


	
}
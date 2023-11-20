<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Anggota_kim extends CI_controller
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
	 if($this->session->userdata('admin') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_anggota_kim');
    $this->load->model('m_event');
    $this->load->model('m_medsos');
    $this->load->model('m_website');
    $this->load->model('m_sanksi');
	}

    //Lihat Data
    public function lihat($value='')
    {
     $view = array('judul'      =>'Data Anggota KIM',
                    'aksi'      =>'lihat',
                    'data'      =>$this->m_anggota_kim->view()->result_array(),
                  );

      $this->load->view('admin/anggota_kim/lihat',$view);
    }

    private function acak_id($panjang)
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{$pos};
        }
        return $string;
    }
    
      //mengambil id urut terakhir anggota_kim
      private function id_anggota_urut($value='')
      {
      $this->m_anggota_kim->id_urut();
      $query   = $this->db->get();
      $data    = $query->row_array();
      $id      = $data['id_anggota'];
      $karakter= $this->acak_id(6);
      $urut    = substr($id, 1, 3);
      $tambah  = (int) $urut + 1;
      
      if (strlen($tambah) == 1){
      $newID = "K"."00".$tambah.$karakter;
          }else if (strlen($tambah) == 2){
          $newID = "K"."0".$tambah.$karakter;
              }else (strlen($tambah) == 3){
              $newID = "K".$tambah.$karakter
              };
          return $newID;
      }

      //mengambil id urut terakhir event
      private function id_event_urut($value='')
      {
      $this->m_event->id_urut();
      $query   = $this->db->get();
      $data    = $query->row_array();
      $id      = $data['id_event'];
      $karakter= $this->acak_id(6);
      $urut    = substr($id, 1, 3);
      $tambah  = (int) $urut + 1;

      if (strlen($tambah) == 1){
      $newID = "E"."00".$tambah.$karakter;
          }else if (strlen($tambah) == 2){
          $newID = "E"."0".$tambah.$karakter;
              }else (strlen($tambah) == 3){
              $newID = "E".$tambah.$karakter
              };
          return $newID;
      }

      //mengambil id urut terakhir medsos
      private function id_medsos_urut($value='')
      {
      $this->m_medsos->id_urut();
      $query   = $this->db->get();
      $data    = $query->row_array();
      $id      = $data['id_medsos'];
      $karakter= $this->acak_id(6);
      $urut    = substr($id, 1, 3);
      $tambah  = (int) $urut + 1;

      if (strlen($tambah) == 1){
      $newID = "M"."00".$tambah.$karakter;
          }else if (strlen($tambah) == 2){
          $newID = "M"."0".$tambah.$karakter;
              }else (strlen($tambah) == 3){
              $newID = "M".$tambah.$karakter
              };
          return $newID;
      }

      //mengambil id urut terakhir website
      private function id_website_urut($value='')
      {
      $this->m_website->id_urut();
      $query   = $this->db->get();
      $data    = $query->row_array();
      $id      = $data['id_website'];
      $karakter= $this->acak_id(6);
      $urut    = substr($id, 1, 3);
      $tambah  = (int) $urut + 1;

      if (strlen($tambah) == 1){
      $newID = "W"."00".$tambah.$karakter;
          }else if (strlen($tambah) == 2){
          $newID = "W"."0".$tambah.$karakter;
              }else (strlen($tambah) == 3){
              $newID = "W".$tambah.$karakter
              };
          return $newID;
      }

      //mengambil id urut terakhir sanksi
      private function id_sanksi_urut($value='')
      {
      $this->m_sanksi->id_urut();
      $query   = $this->db->get();
      $data    = $query->row_array();
      $id      = $data['id_sanksi'];
      $karakter= $this->acak_id(6);
      $urut    = substr($id, 1, 3);
      $tambah  = (int) $urut + 1; 

      if (strlen($tambah) == 1){
      $newID = "S"."00".$tambah.$karakter;
          }else if (strlen($tambah) == 2){
          $newID = "S"."0".$tambah.$karakter;
              }else (strlen($tambah) == 3){
              $newID = "S".$tambah.$karakter
              };
          return $newID;
      }

      
  //API add
  public function api_add($value='')
  {
    $rules = array(
      array(
        'field' => 'nama_kim',
        'label' => 'Nama KIM',
        'rules' => 'required|is_unique[tb_anggota_kim.nama_kim]',
        'errors' => array(
            'required' => 'Nama KIM tidak boleh kosong',
            'is_unique' => 'Nama KIM sudah ada',
        ),
      ),
      array(
        'field' => 'wilayah',
        'label' => 'Wilayah',
        'rules' => 'required',
        'errors' => array(
            'required' => 'Wilayah tidak boleh kosong',
          ),
        ),
    );
    $this->form_validation->set_rules($rules);
      if ($this->form_validation->run() == FALSE) {
        $response = [
          'status' => false,
          'message' => validation_errors(),
        ];
      } else {
        $id_anggota = $this->id_anggota_urut();
        $id_event = $this->id_event_urut();
        $id_medsos = $this->id_medsos_urut();
        $id_website = $this->id_website_urut();
        $id_sanksi = $this->id_sanksi_urut();

        //menyimpan nama event jika checkbox event di centang lebih dari satu
        $nama_event = $this->input->post('nama_event[]');
        $nama_event_json = json_encode($nama_event);
        $nama_event_array = json_decode($nama_event_json);
        $nama_event_simpan = implode(", ", $nama_event_array);
        //menyiapkan bobot event dari inputan nama event yang setiap nama event nilai bobotnya 1
        $bobot_event = count($nama_event_array);

        //menyimpan nama medsos jika checkbox event di centang lebih dari satu
        $nama_medsos = $this->input->post('nama_medsos[]');
        $nama_medsos_json = json_encode($nama_medsos);
        $nama_medsos_array = json_decode($nama_medsos_json);
        $nama_medsos_simpan = implode(", ", $nama_medsos_array);
        $bobot_medsos = count($nama_medsos_array);

        $bobot_website = $this->input->post('bobot_website');
        $bobot_sanksi = $this->input->post('bobot_sanksi');

        $SQLinsert1 = [
          'id_anggota'            =>$id_anggota,
          'nama_kim'              =>$this->input->post('nama_kim'),
          'wilayah'               =>$this->input->post('wilayah'),
          'id_event'              =>$id_event,
          'id_medsos'             =>$id_medsos,
          'id_website'            =>$id_website,
          'id_sanksi'             =>$id_sanksi
        ];

        $SQLinsert2 = [
          'id_event'              => $id_event,
          'id_anggota'            => $id_anggota,
          'bobot_event'           => $bobot_event,
          'nama_event'            => $nama_event_simpan,
        ];
        
        $SQLinsert3 = [
          'id_medsos'             => $id_medsos,
          'id_anggota'            => $id_anggota,
          'bobot_medsos'          => $bobot_medsos,
          'nama_medsos'           => $nama_medsos_simpan
        ];

        $SQLinsert4 = [
          'id_website'            => $id_website,
          'id_anggota'            => $id_anggota,
          'bobot_website'         => $bobot_website
        ];

        $SQLinsert5 = [
          'id_sanksi'             => $id_sanksi,
          'id_anggota'            => $id_anggota,
          'bobot_sanksi'          => $bobot_sanksi
        ];

        if ($this->m_anggota_kim->add($SQLinsert1) && $this->m_event->add($SQLinsert2) && $this->m_medsos->add($SQLinsert3) && $this->m_website->add($SQLinsert4) && $this->m_sanksi->add($SQLinsert5)) {
          $response = [
            'status' => true,
            'message' => 'Berhasil menambahkan data'
          ];
        } else {
          $response = [
            'status' => false,
            'message' => 'Gagal menambahkan data'
          ];
        }
    }
    
    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
  }

      
      //API hapus
      public function api_hapus($id='')
      {
        if(empty($id)){
          $response = [
            'status' => false,
            'message' => 'Data kosong'
          ];
        }else{
          if ($this->m_anggota_kim->delete($id)) {
            $response = [
              'status' => true,
              'message' => 'Berhasil menghapus data'
            ];
          } else {
            $response = [
              'status' => false,
              'message' => 'Gagal menghapus data'
            ];
          }
        }
        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($response));
      }
	
}
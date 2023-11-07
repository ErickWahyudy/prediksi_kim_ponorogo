<?php 

/**
* 
*/
class M_perhitungan_AHP extends CI_Model
{
    private $table = 'tb_anggota_kim';
    private $table2 = 'tb_event';
    private $table3 = 'tb_medsos';
    private $table4 = 'tb_website';
    private $table5 = 'tb_sanksi';

    //View
      public function view()
      {
          $this->db->select('*');
          $this->db->from($this->table);
          $this->db->join($this->table2, 'tb_anggota_kim.id_event = tb_event.id_event');
          $this->db->join($this->table3, 'tb_anggota_kim.id_medsos = tb_medsos.id_medsos');
          $this->db->join($this->table4, 'tb_anggota_kim.id_website = tb_website.id_website');
          $this->db->join($this->table5, 'tb_anggota_kim.id_sanksi = tb_sanksi.id_sanksi');
          $this->db->order_by($this->table.'.id_anggota', 'ASC');
          return $this->db->get();
      }

    //view_id
    public function view_id($id_anggota)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->table2, 'tb_anggota_kim.id_event = tb_event.id_event');
        $this->db->join($this->table3, 'tb_anggota_kim.id_medsos = tb_medsos.id_medsos');
        $this->db->join($this->table4, 'tb_anggota_kim.id_website = tb_website.id_website');
        $this->db->join($this->table5, 'tb_anggota_kim.id_sanksi = tb_sanksi.id_sanksi');
        $this->db->where('tb_anggota_kim.id_anggota', $id_anggota);
        return $this->db->get();
    }

      public function getKriteriaTabel1() {
        $this->db->select('bobot_event');
        $this->db->from($this->table2);
        return $this->db->get()->result_array();
    }

    public function getKriteriaTabel2() {
        $this->db->select('bobot_medsos');
        $this->db->from($this->table3);
        return $this->db->get()->result_array();
    }

    public function getKriteriaTabel3() {
        $this->db->select('bobot_website');
        $this->db->from($this->table4);
        return $this->db->get()->result_array();
    }

    public function getKriteriaTabel4() {
        $this->db->select('bobot_sanksi');
        $this->db->from($this->table5);
        return $this->db->get()->result_array();
    }

    public function getKriteria() {
        $kriteria1 = $this->getKriteriaTabel1();
        $kriteria2 = $this->getKriteriaTabel2();
        $kriteria3 = $this->getKriteriaTabel3();
        $kriteria4 = $this->getKriteriaTabel4();

        $kriteria = array_merge($kriteria1, $kriteria2, $kriteria3, $kriteria4);

        return $kriteria;
    }
    
    public function hitungBobotAHP($matriksPerbandingan) {
      // Hitung jumlah kolom untuk setiap kriteria
      $jumlahKolomK1 = array_sum($matriksPerbandingan[0]);
      $jumlahKolomK2 = array_sum($matriksPerbandingan[1]);
      $jumlahKolomK3 = array_sum($matriksPerbandingan[2]);
      $jumlahKolomK4 = array_sum($matriksPerbandingan[3]);
  
      // Hitung bobot relatif kriteria
      $bobotK1 = $jumlahKolomK1 / ($jumlahKolomK1 + $jumlahKolomK2 + $jumlahKolomK3 + $jumlahKolomK4);
      $bobotK2 = $jumlahKolomK2 / ($jumlahKolomK1 + $jumlahKolomK2 + $jumlahKolomK3 + $jumlahKolomK4);
      $bobotK3 = $jumlahKolomK3 / ($jumlahKolomK1 + $jumlahKolomK2 + $jumlahKolomK3 + $jumlahKolomK4);
      $bobotK4 = $jumlahKolomK4 / ($jumlahKolomK1 + $jumlahKolomK2 + $jumlahKolomK3 + $jumlahKolomK4);
  
      // Kembalikan bobot relatif kriteria
      $bobotKriteria = [
          'K1' => $bobotK1,
          'K2' => $bobotK2,
          'K3' => $bobotK3,
          'K4' => $bobotK4,
      ];
  
      return $bobotKriteria;
  }
  
  
}

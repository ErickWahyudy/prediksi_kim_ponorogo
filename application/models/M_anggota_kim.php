<?php 

/**
* 
*/
class M_anggota_kim extends CI_model
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

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_anggota', $id)->get ();
}

//mengambil id urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_anggota');
  $this->db->from ($this->table);
}

public function add($SQLinsert1){
  return $this -> db -> insert($this->table, $SQLinsert1);
}

public function update($id='',$SQLupdate1){
  $this->db->where('id_anggota', $id);
  return $this->db-> update($this->table, $SQLupdate1);
}

public function delete($id=''){
  $this->db->where('id_anggota', $id);
  return $this->db-> delete($this->table);
}

}
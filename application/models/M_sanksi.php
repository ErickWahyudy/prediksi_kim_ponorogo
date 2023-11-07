<?php 

/**
* 
*/
class M_sanksi extends CI_model
{

private $table = 'tb_sanksi';

//View
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->order_by('id_sanksi', 'ASC');
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_sanksi', $id)->get ();
}

//mengambil id urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_sanksi');
  $this->db->from ($this->table);
}

public function add($SQLinsert5){
  return $this -> db -> insert($this->table, $SQLinsert5);
}

public function update($id='',$SQLupdate5){
  $this->db->where('id_anggota', $id);
  return $this->db-> update($this->table, $SQLupdate5);
}

public function delete($id=''){
  $this->db->where('id_sanksi', $id);
  return $this->db-> delete($this->table);
}

}
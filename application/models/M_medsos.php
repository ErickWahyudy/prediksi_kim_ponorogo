<?php 

/**
* 
*/
class M_medsos extends CI_model
{

private $table = 'tb_medsos';

//View
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->order_by('id_medsos', 'ASC');
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_medsos', $id)->get ();
}

//mengambil id urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_medsos');
  $this->db->from ($this->table);
}

public function add($SQLinsert3){
  return $this -> db -> insert($this->table, $SQLinsert3);
}

public function update($id='',$SQLupdate3){
  $this->db->where('id_anggota', $id);
  return $this->db-> update($this->table, $SQLupdate3);
}

public function delete($id=''){
  $this->db->where('id_anggota', $id);
  return $this->db-> delete($this->table);
}

}
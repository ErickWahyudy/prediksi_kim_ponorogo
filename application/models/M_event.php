<?php 

/**
* 
*/
class M_event extends CI_model
{

private $table = 'tb_event';

//View
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->order_by('id_event', 'ASC');
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_event', $id)->get ();
}

//mengambil id urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_event');
  $this->db->from ($this->table);
}

public function add($SQLinsert2){
  return $this -> db -> insert($this->table, $SQLinsert2);
}

public function update($id='',$SQLupdate2){
  $this->db->where('id_anggota', $id);
  return $this->db-> update($this->table, $SQLupdate2);
}

public function delete($id=''){
  $this->db->where('id_anggota', $id);
  return $this->db-> delete($this->table);
}

}
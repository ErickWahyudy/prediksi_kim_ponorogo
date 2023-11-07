<?php 

/**
* 
*/
class M_website extends CI_model
{

private $table = 'tb_website';

//View
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->order_by('id_website', 'ASC');
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_website', $id)->get ();
}

//mengambil id urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_website');
  $this->db->from ($this->table);
}

public function add($SQLinsert4){
  return $this -> db -> insert($this->table, $SQLinsert4);
}

public function update($id='',$SQLupdate4){
  $this->db->where('id_anggota', $id);
  return $this->db-> update($this->table, $SQLupdate4);
}

public function delete($id=''){
  $this->db->where('id_anggota', $id);
  return $this->db-> delete($this->table);
}

}
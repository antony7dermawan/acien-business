<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_p_position extends CI_Model {
    
  

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_P_POSITION', $data);
}

public function select_id($id)
{
  $this->db->select('ID');
  $this->db->from('T_P_POSITION');
  $this->db->where('POSITION', $id);
  $akun = $this->db->get ();
  return $akun->result ();
}





  public function select()
  {
    $this->db->select('*');
    $this->db->from('T_P_POSITION');

    if($this->session->userdata('t_p_position_delete_logic')==0)
    {
      $this->db->where('MARK_FOR_DELETE',FALSE);
    }
    $this->db->order_by("ID", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_P_POSITION');
  }

  function tambah($data)
  {
    $this->db->insert('T_P_POSITION', $data);
    return TRUE;
  }

}



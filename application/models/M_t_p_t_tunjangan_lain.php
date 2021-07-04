<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_p_t_tunjangan_lain extends CI_Model {
    
  

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_P_T_TUNJANGAN_LAIN', $data);
}

public function select_id($id)
{
  $this->db->select('ID');
  $this->db->from('T_P_T_TUNJANGAN_LAIN');
  $this->db->where('ANGGOTA', $id);
  $akun = $this->db->get ();
  return $akun->result ();
}





  public function select()
  {
    $this->db->select('T_P_T_TUNJANGAN_LAIN.ID');

    $this->db->select('T_P_T_TUNJANGAN_LAIN.DATE');
    $this->db->select('T_P_T_TUNJANGAN_LAIN.KET');
    $this->db->select('T_P_T_TUNJANGAN_LAIN.VALUE');
    $this->db->select('T_P_T_TUNJANGAN_LAIN.CREATED_BY');
    $this->db->select('T_P_T_TUNJANGAN_LAIN.UPDATED_BY');
    $this->db->select('T_P_T_TUNJANGAN_LAIN.MARK_FOR_DELETE');
  
    $this->db->select('T_M_D_ANGGOTA.ANGGOTA');




    $this->db->from('T_P_T_TUNJANGAN_LAIN');

    $this->db->join('T_M_D_ANGGOTA', 'T_M_D_ANGGOTA.ID = T_P_T_TUNJANGAN_LAIN.ANGGOTA_ID', 'left');

   


    if($this->session->userdata('t_p_t_tunjangan_lain_delete_logic')==0)
    {
      $this->db->where('T_P_T_TUNJANGAN_LAIN.MARK_FOR_DELETE',FALSE);
    }
    $this->db->order_by("T_P_T_TUNJANGAN_LAIN.ID", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_P_T_TUNJANGAN_LAIN');
  }

  function tambah($data)
  {
    $this->db->insert('T_P_T_TUNJANGAN_LAIN', $data);
    return TRUE;
  }

}



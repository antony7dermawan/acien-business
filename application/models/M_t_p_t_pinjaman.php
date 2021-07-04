<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_p_t_pinjaman extends CI_Model {
    
  

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_P_T_PINJAMAN', $data);
}

public function select_id($id)
{
  $this->db->select('ID');
  $this->db->from('T_P_T_PINJAMAN');
  $this->db->where('ANGGOTA', $id);
  $akun = $this->db->get ();
  return $akun->result ();
}





  public function select()
  {
    $this->db->select('T_P_T_PINJAMAN.ID');

    $this->db->select('T_P_T_PINJAMAN.DATE');
    $this->db->select('T_P_T_PINJAMAN.KET');
    $this->db->select('T_P_T_PINJAMAN.VALUE');
    $this->db->select('T_P_T_PINJAMAN.SISA_VALUE');
    $this->db->select('T_P_T_PINJAMAN.CREATED_BY');
    $this->db->select('T_P_T_PINJAMAN.UPDATED_BY');
    $this->db->select('T_P_T_PINJAMAN.MARK_FOR_DELETE');
  
    $this->db->select('T_M_D_ANGGOTA.ANGGOTA');




    $this->db->from('T_P_T_PINJAMAN');

    $this->db->join('T_M_D_ANGGOTA', 'T_M_D_ANGGOTA.ID = T_P_T_PINJAMAN.ANGGOTA_ID', 'left');

   


    if($this->session->userdata('t_p_t_pinjaman_delete_logic')==0)
    {
      $this->db->where('T_P_T_PINJAMAN.MARK_FOR_DELETE',FALSE);
    }
    $this->db->order_by("T_P_T_PINJAMAN.ID", "desc");
    $akun = $this->db->get ();
    return $akun->result ();
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_P_T_PINJAMAN');
  }

  function tambah($data)
  {
    $this->db->insert('T_P_T_PINJAMAN', $data);
    return TRUE;
  }

}



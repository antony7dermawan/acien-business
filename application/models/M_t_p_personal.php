<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_p_personal extends CI_Model {
    
  

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_M_D_ANGGOTA', $data);
}

public function select_id($id)
{
  $this->db->select('ID');
  $this->db->from('T_M_D_ANGGOTA');
  $this->db->where('ANGGOTA', $id);
  $akun = $this->db->get ();
  return $akun->result ();
}





  public function select()
  {
    $this->db->select('T_M_D_ANGGOTA.ID');

    $this->db->select('T_M_D_ANGGOTA.DOB');
    $this->db->select('T_M_D_ANGGOTA.POB');
    $this->db->select('T_M_D_ANGGOTA.JOINED_DATE');
    $this->db->select('T_M_D_ANGGOTA.RESIGNED_DATE');

    $this->db->select('T_M_D_ANGGOTA.RELIGION_ID');
    $this->db->select('T_M_D_ANGGOTA.GENDER_ID');
    $this->db->select('T_M_D_ANGGOTA.MARITAL_ID');
    $this->db->select('T_M_D_ANGGOTA.PERMANEN_ID');
    $this->db->select('T_M_D_ANGGOTA.DEPARTMEN_ID');
    $this->db->select('T_M_D_ANGGOTA.BANK_ID');
    $this->db->select('T_M_D_ANGGOTA.POSITION_ID');
    $this->db->select('T_M_D_ANGGOTA.BPJS_TK_ID');
    $this->db->select('T_M_D_ANGGOTA.BPJS_KES_ID');


    $this->db->select('T_M_D_ANGGOTA.NIK_KTP');
    $this->db->select('T_M_D_ANGGOTA.EMAIL');
    $this->db->select('T_M_D_ANGGOTA.ADDRESS');
    $this->db->select('T_M_D_ANGGOTA.PHONE_NUMBER');
    $this->db->select('T_M_D_ANGGOTA.BANK_ACCOUNT_NUMBER');
    $this->db->select('T_M_D_ANGGOTA.CREATED_BY');
    $this->db->select('T_M_D_ANGGOTA.UPDATED_BY');
    $this->db->select('T_M_D_ANGGOTA.MARK_FOR_DELETE');
    $this->db->select('T_M_D_ANGGOTA.ANGGOTA');

    $this->db->select('T_P_RELIGION.RELIGION');
    $this->db->select('T_P_GENDER.GENDER');
    $this->db->select('T_P_MARITAL.MARITAL');
    $this->db->select('T_P_PERMANEN.PERMANEN');
    $this->db->select('T_P_DEPARTMEN.DEPARTMEN');
    $this->db->select('T_P_BANK.BANK');
    $this->db->select('T_P_POSITION.POSITION');
    $this->db->select('T_P_BPJS_TK.BPJS_TK');
    $this->db->select('T_P_BPJS_KES.BPJS_KES');


    $this->db->from('T_M_D_ANGGOTA');

    $this->db->join('T_P_RELIGION', 'T_P_RELIGION.ID = T_M_D_ANGGOTA.RELIGION_ID', 'left');

    $this->db->join('T_P_GENDER', 'T_P_GENDER.ID = T_M_D_ANGGOTA.GENDER_ID', 'left');

    $this->db->join('T_P_MARITAL', 'T_P_MARITAL.ID = T_M_D_ANGGOTA.MARITAL_ID', 'left');
    $this->db->join('T_P_PERMANEN', 'T_P_PERMANEN.ID = T_M_D_ANGGOTA.PERMANEN_ID', 'left');
    $this->db->join('T_P_DEPARTMEN', 'T_P_DEPARTMEN.ID = T_M_D_ANGGOTA.DEPARTMEN_ID', 'left');
    $this->db->join('T_P_POSITION', 'T_P_POSITION.ID = T_M_D_ANGGOTA.POSITION_ID', 'left');
    $this->db->join('T_P_BANK', 'T_P_BANK.ID = T_M_D_ANGGOTA.BANK_ID', 'left');
    $this->db->join('T_P_BPJS_TK', 'T_P_BPJS_TK.ID = T_M_D_ANGGOTA.BPJS_TK_ID', 'left');
    $this->db->join('T_P_BPJS_KES', 'T_P_BPJS_KES.ID = T_M_D_ANGGOTA.BPJS_KES_ID', 'left');


    if($this->session->userdata('t_p_personal_delete_logic')==0)
    {
      $this->db->where('T_M_D_ANGGOTA.MARK_FOR_DELETE',FALSE);
    }
    $this->db->order_by("ID", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_M_D_ANGGOTA');
  }

  function tambah($data)
  {
    $this->db->insert('T_M_D_ANGGOTA', $data);
    return TRUE;
  }

}



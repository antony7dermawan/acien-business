<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_p_t_angsuran extends CI_Model {
    
  

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_P_T_ANGSURAN', $data);
}

public function select_id($id)
{
  $this->db->select('ID');
  $this->db->from('T_P_T_ANGSURAN');
  $this->db->where('ANGGOTA', $id);
  $akun = $this->db->get ();
  return $akun->result ();
}




  public function sum_value_by_date($from_date,$to_date)
  {
    $this->db->select("sum (\"VALUE\") as \"SUM_ANGSURAN\"");
    $this->db->from('T_P_T_ANGSURAN');


    $this->db->where('MARK_FOR_DELETE',FALSE);
    $this->db->where("DATE<='{$to_date}' and DATE>='{$from_date}'");
    
    $akun = $this->db->get ();
    return $akun->result ();
  }



  public function select_by_id($id)
  {
    $this->db->select('T_P_T_ANGSURAN.ID');

    $this->db->select('T_P_T_ANGSURAN.DATE');
    $this->db->select('T_P_T_ANGSURAN.KET');
    $this->db->select('T_P_T_ANGSURAN.ANGGOTA_ID');
    $this->db->select('T_P_T_ANGSURAN.VALUE');
    $this->db->select('T_P_T_ANGSURAN.CREATED_BY');
    $this->db->select('T_P_T_ANGSURAN.UPDATED_BY');
    $this->db->select('T_P_T_ANGSURAN.MARK_FOR_DELETE');
  
    $this->db->select('T_M_D_ANGGOTA.ANGGOTA');




    $this->db->from('T_P_T_ANGSURAN');

    $this->db->join('T_M_D_ANGGOTA', 'T_M_D_ANGGOTA.ID = T_P_T_ANGSURAN.ANGGOTA_ID', 'left');

   

    $this->db->where('T_P_T_ANGSURAN.ID',$id);
    $akun = $this->db->get ();
    return $akun->result ();
  }


  public function select()
  {
    $this->db->select('T_P_T_ANGSURAN.ID');

    $this->db->select('T_P_T_ANGSURAN.DATE');
    $this->db->select('T_P_T_ANGSURAN.KET');
    $this->db->select('T_P_T_ANGSURAN.VALUE');
    $this->db->select('T_P_T_ANGSURAN.CREATED_BY');
    $this->db->select('T_P_T_ANGSURAN.UPDATED_BY');
    $this->db->select('T_P_T_ANGSURAN.MARK_FOR_DELETE');
  
    $this->db->select('T_M_D_ANGGOTA.ANGGOTA');




    $this->db->from('T_P_T_ANGSURAN');

    $this->db->join('T_M_D_ANGGOTA', 'T_M_D_ANGGOTA.ID = T_P_T_ANGSURAN.ANGGOTA_ID', 'left');

   


    if($this->session->userdata('t_p_t_angsuran_delete_logic')==0)
    {
      $this->db->where('T_P_T_ANGSURAN.MARK_FOR_DELETE',FALSE);
    }
    $this->db->order_by("T_P_T_ANGSURAN.ID", "desc");
    $akun = $this->db->get ();
    return $akun->result ();
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_P_T_ANGSURAN');
  }

  function tambah($data)
  {
    $this->db->insert('T_P_T_ANGSURAN', $data);
    return TRUE;
  }

}



<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_p_t_potongan_lain extends CI_Model {
    
  

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_P_T_POTONGAN_LAIN', $data);
}

public function select_id($id)
{
  $this->db->select('ID');
  $this->db->from('T_P_T_POTONGAN_LAIN');
  $this->db->where('ANGGOTA', $id);
  $akun = $this->db->get ();
  return $akun->result ();
}


  public function sum_value_by_date($from_date,$to_date,$anggota_id)
  {
    $this->db->select("sum (\"VALUE\") as \"SUM_POTONGAN_LAIN\"");
    $this->db->from('T_P_T_POTONGAN_LAIN');


    $this->db->where('MARK_FOR_DELETE',FALSE);
    $this->db->where("DATE<='{$to_date}' and DATE>='{$from_date}'");

    $this->db->where('ANGGOTA_ID',$anggota_id);
    
    $akun = $this->db->get ();
    return $akun->result ();
  }


  public function select()
  {
    $this->db->select('T_P_T_POTONGAN_LAIN.ID');

    $this->db->select('T_P_T_POTONGAN_LAIN.DATE');
    $this->db->select('T_P_T_POTONGAN_LAIN.KET');
    $this->db->select('T_P_T_POTONGAN_LAIN.VALUE');
    $this->db->select('T_P_T_POTONGAN_LAIN.CREATED_BY');
    $this->db->select('T_P_T_POTONGAN_LAIN.UPDATED_BY');
    $this->db->select('T_P_T_POTONGAN_LAIN.MARK_FOR_DELETE');
  
    $this->db->select('T_M_D_ANGGOTA.ANGGOTA');




    $this->db->from('T_P_T_POTONGAN_LAIN');

    $this->db->join('T_M_D_ANGGOTA', 'T_M_D_ANGGOTA.ID = T_P_T_POTONGAN_LAIN.ANGGOTA_ID', 'left');

   


    if($this->session->userdata('t_p_t_potongan_lain_delete_logic')==0)
    {
      $this->db->where('T_P_T_POTONGAN_LAIN.MARK_FOR_DELETE',FALSE);
    }
    $this->db->order_by("T_P_T_POTONGAN_LAIN.ID", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  }



  public function select_by_anggota_id($anggota_id,$r_from_date)
  {
    $this->db->select('T_P_T_POTONGAN_LAIN.ID');

    $this->db->select('T_P_T_POTONGAN_LAIN.DATE');
    $this->db->select('T_P_T_POTONGAN_LAIN.KET');
    $this->db->select('T_P_T_POTONGAN_LAIN.VALUE');
    $this->db->select('T_P_T_POTONGAN_LAIN.CREATED_BY');
    $this->db->select('T_P_T_POTONGAN_LAIN.UPDATED_BY');
    $this->db->select('T_P_T_POTONGAN_LAIN.MARK_FOR_DELETE');
  
    $this->db->select('T_M_D_ANGGOTA.ANGGOTA');




    $this->db->from('T_P_T_POTONGAN_LAIN');

    $this->db->join('T_M_D_ANGGOTA', 'T_M_D_ANGGOTA.ID = T_P_T_POTONGAN_LAIN.ANGGOTA_ID', 'left');

   


   
    $this->db->where('T_P_T_POTONGAN_LAIN.MARK_FOR_DELETE',FALSE);
    $this->db->where("T_P_T_POTONGAN_LAIN.DATE >='{$r_from_date}'");
    $this->db->where('T_P_T_POTONGAN_LAIN.ANGGOTA_ID',$anggota_id);


    $this->db->order_by("T_P_T_POTONGAN_LAIN.DATE", "asc");
    
    $akun = $this->db->get ();
    return $akun->result ();
  }


  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_P_T_POTONGAN_LAIN');
  }

  function tambah($data)
  {
    $this->db->insert('T_P_T_POTONGAN_LAIN', $data);
    return TRUE;
  }

}



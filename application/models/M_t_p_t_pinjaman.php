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

  public function select_sisa_value_for_1_angsuran_id($anggota_id)
  {
    $this->db->select('SUM_SISA_VALUE');
    $this->db->from('T_M_D_ANGGOTA');
    $this->db->join("(select \"ANGGOTA_ID\",sum(\"SISA_VALUE\")\"SUM_SISA_VALUE\" from \"T_P_T_PINJAMAN\" where \"MARK_FOR_DELETE\"=false group by \"ANGGOTA_ID\") as t_sum_1", 'T_M_D_ANGGOTA.ID = t_sum_1.ANGGOTA_ID', 'left');
    $this->db->where('T_M_D_ANGGOTA.ID',$anggota_id);
    $akun = $this->db->get ();
    return $akun->result ();
  }



  public function select_inv_int()
  {
    $this_year = date('Y-m').'-01';
    $this->db->limit(1);
    $this->db->select("INV_INT");
    $this->db->from('T_P_T_PINJAMAN');

    $this->db->where("DATE>='{$this_year}'");
    $this->db->order_by("ID", "desc");

    $akun = $this->db->get ();
    return $akun->result ();
  }




  public function select_sisa_value($anggota_id)
  {
      $this->db->select('*');




      $this->db->from('T_P_T_PINJAMAN');

      

      $this->db->where('ANGGOTA_ID',$anggota_id);
      $this->db->where('MARK_FOR_DELETE',false);

      $this->db->order_by("ID", "asc");



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
    $this->db->select('T_P_T_PINJAMAN.COA_ID');
    $this->db->select('T_P_T_PINJAMAN.INV');
    $this->db->select('T_P_T_PINJAMAN.INV_INT');
  
    $this->db->select('T_M_D_ANGGOTA.ANGGOTA');

    $this->db->select("AK_M_COA.NO_AKUN_1");
    $this->db->select("AK_M_COA.NO_AKUN_2");
    $this->db->select("AK_M_COA.NO_AKUN_3");
    $this->db->select("AK_M_COA.NAMA_AKUN");


    $this->db->from('T_P_T_PINJAMAN');

    $this->db->join('T_M_D_ANGGOTA', 'T_M_D_ANGGOTA.ID = T_P_T_PINJAMAN.ANGGOTA_ID', 'left');

    


    $this->db->join('AK_M_COA', 'AK_M_COA.ID = T_P_T_PINJAMAN.COA_ID', 'left');


    if($this->session->userdata('t_p_t_pinjaman_delete_logic')==0)
    {
      $this->db->where('T_P_T_PINJAMAN.MARK_FOR_DELETE',FALSE);
    }
    $this->db->order_by("T_P_T_PINJAMAN.ID", "desc");
    $akun = $this->db->get ();
    return $akun->result ();
  }





  public function select_by_id($id)
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

    $this->db->select('T_P_T_PINJAMAN.COA_ID');
    $this->db->select('T_P_T_PINJAMAN.INV');
    $this->db->select('T_P_T_PINJAMAN.INV_INT');


    $this->db->from('T_P_T_PINJAMAN');

    $this->db->join('T_M_D_ANGGOTA', 'T_M_D_ANGGOTA.ID = T_P_T_PINJAMAN.ANGGOTA_ID', 'left');

    $this->db->where('T_P_T_PINJAMAN.ID',$id);


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



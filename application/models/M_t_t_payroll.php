<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_t_payroll extends CI_Model {
    
  

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_T_PAYROLL', $data);
}

public function select_id($id)
{
  $this->db->select('ID');
  $this->db->from('T_T_PAYROLL');
  $this->db->where('POSITION', $id);
  $akun = $this->db->get ();
  return $akun->result ();
}


public function update_done_payment($data, $anggota_id,$date_before)
{
    $this->db->where('ANGGOTA_ID', $anggota_id);

    $this->db->where("T_T_PAYROLL.FROM_DATE>='{$date_before}'");
    return $this->db->update('T_T_PAYROLL', $data);
}




  public function select($from_date,$to_date)
  {
    $this->db->select('T_T_PAYROLL.ID');
    $this->db->select('T_T_PAYROLL.ANGGOTA_ID');
    $this->db->select('T_T_PAYROLL.FROM_DATE');
    $this->db->select('T_T_PAYROLL.TO_DATE');
    $this->db->select('T_T_PAYROLL.GP_VALUE');
    $this->db->select('T_T_PAYROLL.POSITION_VALUE');
    $this->db->select('T_T_PAYROLL.TUNJANGAN_VALUE');
    $this->db->select('T_T_PAYROLL.POTONGAN_VALUE');
    $this->db->select('T_T_PAYROLL.ANGSURAN_VALUE');
    $this->db->select('T_T_PAYROLL.BPJS_VALUE');
    $this->db->select('T_T_PAYROLL.CREATED_BY');
    $this->db->select('T_T_PAYROLL.UPDATED_BY');

    $this->db->select('T_M_D_ANGGOTA.ANGGOTA');
    $this->db->select('T_M_D_ANGGOTA.BANK_ACCOUNT_NUMBER');


    $this->db->select('T_P_POSITION.POSITION');
    $this->db->select('T_P_BANK.BANK');


    $this->db->from('T_T_PAYROLL');

    $this->db->join('T_M_D_ANGGOTA', 'T_M_D_ANGGOTA.ID = T_T_PAYROLL.ANGGOTA_ID', 'left');

    $this->db->join('T_P_POSITION', 'T_P_POSITION.ID = T_M_D_ANGGOTA.POSITION_ID', 'left');
    $this->db->join('T_P_BANK', 'T_P_BANK.ID = T_M_D_ANGGOTA.BANK_ID', 'left');

    $this->db->where('T_T_PAYROLL.FROM_DATE',$from_date);
    $this->db->where('T_T_PAYROLL.TO_DATE',$to_date);
    $this->db->order_by("ANGGOTA", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  }





  public function select_personal($from_date,$to_date,$anggota_id)
  {
    $this->db->select('T_T_PAYROLL.ID');
    $this->db->select('T_T_PAYROLL.ANGGOTA_ID');
    $this->db->select('T_T_PAYROLL.FROM_DATE');
    $this->db->select('T_T_PAYROLL.TO_DATE');
    $this->db->select('T_T_PAYROLL.GP_VALUE');
    $this->db->select('T_T_PAYROLL.POSITION_VALUE');
    $this->db->select('T_T_PAYROLL.TUNJANGAN_VALUE');
    $this->db->select('T_T_PAYROLL.POTONGAN_VALUE');
    $this->db->select('T_T_PAYROLL.ANGSURAN_VALUE');
    $this->db->select('T_T_PAYROLL.BPJS_VALUE');
    $this->db->select('T_T_PAYROLL.CREATED_BY');
    $this->db->select('T_T_PAYROLL.UPDATED_BY');

    $this->db->select('T_M_D_ANGGOTA.ANGGOTA');
    $this->db->select('T_M_D_ANGGOTA.ADDRESS');
    $this->db->select('T_M_D_ANGGOTA.BANK_ACCOUNT_NUMBER');


    $this->db->select('T_P_POSITION.POSITION');
    $this->db->select('T_P_BANK.BANK');


    $this->db->from('T_T_PAYROLL');

    $this->db->join('T_M_D_ANGGOTA', 'T_M_D_ANGGOTA.ID = T_T_PAYROLL.ANGGOTA_ID', 'left');

    $this->db->join('T_P_POSITION', 'T_P_POSITION.ID = T_M_D_ANGGOTA.POSITION_ID', 'left');
    $this->db->join('T_P_BANK', 'T_P_BANK.ID = T_M_D_ANGGOTA.BANK_ID', 'left');

    $this->db->where("T_T_PAYROLL.FROM_DATE>='{$from_date}'");
    $this->db->where("T_T_PAYROLL.TO_DATE<='{$to_date}'");


    $this->db->where("T_T_PAYROLL.DONE_PAYMENT=FALSE");
    $this->db->where("T_T_PAYROLL.ANGGOTA_ID='{$anggota_id}'");
    $this->db->order_by("FROM_DATE", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  }




  public function delete_by_date($from_date,$to_date)
  {
    $this->db->where('FROM_DATE',$from_date);
    $this->db->where('TO_DATE',$to_date);
    $this->db->delete('T_T_PAYROLL');
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_P_POSITION');
  }

  function tambah($data)
  {
    $this->db->insert('T_T_PAYROLL', $data);
    return TRUE;
  }

}



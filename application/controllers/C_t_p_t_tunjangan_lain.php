<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_p_t_tunjangan_lain extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_p_personal');

    
    $this->load->model('m_t_p_t_tunjangan_lain');
  }

  public function index()
  {
    $this->session->set_userdata('t_p_t_tunjangan_lain_delete_logic', '1');
    $this->session->set_userdata('t_p_personal_delete_logic', '0');





    $data = [
      "c_t_p_t_tunjangan_lain" => $this->m_t_p_t_tunjangan_lain->select(),

      "c_t_p_personal" => $this->m_t_p_personal->select(),

     

      "title" => "Transaksi Tunjangan Lain",
      "description" => "Input semua tunjangan disini"
    ];
    $this->render_backend('template/backend/pages/t_p_t_tunjangan_lain', $data);
  }



  public function delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_p_t_tunjangan_lain->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_p_t_tunjangan_lain');
  }

  public function undo_delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => FALSE
    );
    $this->m_t_p_t_tunjangan_lain->update($data, $id);
    
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Dikembalikan!</strong></p></div>');
    redirect('/c_t_p_personal');
  }


  function tambah()
  {
    
    $anggota_id = intval($this->input->post("anggota_id"));

    $date = $this->input->post("date");
    $value = intval($this->input->post("value"));

    $joined_date = $this->input->post("joined_date");


    if($date=='')
    {
      $date= date('Y-m-d');
    }

  

    $ket = substr($this->input->post("ket"), 0, 200);
    


    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(

      'DATE' => $date,
      'ANGGOTA_ID' => $anggota_id,

      'KET' => $ket,
      'VALUE' => $value,
      

      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE
    );

    $this->m_t_p_t_tunjangan_lain->tambah($data);

    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    redirect('c_t_p_t_tunjangan_lain');
  }






  public function edit_action()
  {
    $id = $this->input->post("id");
    

    $anggota = substr($this->input->post("anggota"), 0, 100);

    $dob = $this->input->post("dob");
    $pob = $this->input->post("pob");

    $joined_date = $this->input->post("joined_date");
    $resigned_date = $this->input->post("resigned_date");


    if($dob=='')
    {
      $dob= date('Y-m-d');
    }

  


    if($joined_date=='')
    {
      $joined_date= date('Y-m-d');
    }

    if($resigned_date=='')
    {
      $resigned_date= '2099-01-01';
    }


    $religion = ($this->input->post("religion"));
    $gender = ($this->input->post("gender"));
    $marital = ($this->input->post("marital"));
    $permanen = ($this->input->post("permanen"));
    $departmen = ($this->input->post("departmen"));
    $position = ($this->input->post("position"));
    $bpjs_tk = ($this->input->post("bpjs_tk"));
    $bpjs_kes = ($this->input->post("bpjs_kes"));

    $nik_ktp = substr($this->input->post("nik_ktp"), 0, 100);
    $email = substr($this->input->post("email"), 0, 50);
    $address = substr($this->input->post("address"), 0, 100);
    $phone_number = substr($this->input->post("phone_number"), 0, 50);
    $bank = substr($this->input->post("bank_id"), 0, 50);
    $bank_account_number = substr($this->input->post("bank_account_number"), 0, 50);


    $religion_id = 0;
    $read_select = $this->m_t_p_religion->select_id($religion);
    foreach ($read_select as $key => $value) {
      $religion_id = $value->ID;
    }


    $gender_id = 0;
    $read_select = $this->m_t_p_gender->select_id($gender);
    foreach ($read_select as $key => $value) {
      $gender_id = $value->ID;
    }


    $marital_id = 0;
    $read_select = $this->m_t_p_marital->select_id($marital);
    foreach ($read_select as $key => $value) {
      $marital_id = $value->ID;
    }

    $permanen_id = 0;
    $read_select = $this->m_t_p_permanen->select_id($permanen);
    foreach ($read_select as $key => $value) {
      $permanen_id = $value->ID;
    }


    $departmen_id = 0;
    $read_select = $this->m_t_p_departmen->select_id($departmen);
    foreach ($read_select as $key => $value) {
      $departmen_id = $value->ID;
    }

    $bank_id = 0;
    $read_select = $this->m_t_p_bank->select_id($bank);
    foreach ($read_select as $key => $value) {
      $bank_id = $value->ID;
    }


    $position_id = 0;
    $read_select = $this->m_t_p_position->select_id($position);
    foreach ($read_select as $key => $value) {
      $position_id = $value->ID;
    }


    $bpjs_tk_id = 0;
    $read_select = $this->m_t_p_bpjs_tk->select_id($bpjs_tk);
    foreach ($read_select as $key => $value) {
      $bpjs_tk_id = $value->ID;
    }


    $bpjs_kes_id = 0;
    $read_select = $this->m_t_p_bpjs_kes->select_id($bpjs_kes);
    foreach ($read_select as $key => $value) {
      $bpjs_kes_id = $value->ID;
    }


     $data = array(
      'ANGGOTA' => $anggota,

      'DOB' => $dob,
      'POB' => $pob,
      'JOINED_DATE' => $joined_date,
      'RESIGNED_DATE' => $resigned_date,
      'RELIGION_ID' => $religion_id,
      'GENDER_ID' => $gender_id,
      'MARITAL_ID' => $marital_id,
      'PERMANEN_ID' => $permanen_id,
      'DEPARTMEN_ID' => $departmen_id,
      'NIK_KTP' => $nik_ktp,
      'EMAIL' => $email,
      'ADDRESS' => $address,
      'PHONE_NUMBER' => $phone_number,
      'BANK_ID' => $bank_id,
      'BANK_ACCOUNT_NUMBER' => $bank_account_number,
      'POSITION_ID' => $position_id,
      'BPJS_TK_ID' => $bpjs_tk_id,
      'BPJS_KES_ID' => $bpjs_kes_id,


      'UPDATED_BY' => $this->session->userdata('username'),

    );

    $this->m_t_p_personal->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    redirect('/c_t_p_personal');
  }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_p_t_pinjaman extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_p_personal');
    $this->load->model('m_t_ak_jurnal');
    
    $this->load->model('m_t_p_t_pinjaman');
    $this->load->model('m_ak_m_coa');
    $this->load->model('m_t_m_d_company');
    $this->load->model('m_t_m_d_anggota');
  }

  public function index()
  {
    $this->session->set_userdata('t_p_t_pinjaman_delete_logic', '1');
    $this->session->set_userdata('t_p_personal_delete_logic', '0');





    $data = [
      "c_t_p_t_pinjaman" => $this->m_t_p_t_pinjaman->select(),

      "c_t_p_personal" => $this->m_t_p_personal->select(),

      "no_akun_option" => $this->m_ak_m_coa->select_no_akun(),

      "title" => "Transaksi Pinjaman",
      "description" => "Input semua tunjangan disini"
    ];
    $this->render_backend('template/backend/pages/t_p_t_pinjaman', $data);
  }



  public function delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_p_t_pinjaman->update($data, $id);

    $read_select = $this->m_t_p_t_pinjaman->select_by_id($id);
    foreach ($read_select as $key => $value) 
    {
      $inv=$value->INV;
    }
    $this->m_t_ak_jurnal->delete_no_voucer($inv);


    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_p_t_pinjaman');
  }

  public function undo_delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => FALSE
    );
    $this->m_t_p_t_pinjaman->update($data, $id);
    
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Dikembalikan!</strong></p></div>');
    redirect('/c_t_p_personal');
  }


  function tambah()
  {
    
    $anggota_id = intval($this->input->post("anggota_id"));

    $date = $this->input->post("date");
    $nilai_hutang = intval($this->input->post("value"));

    $joined_date = $this->input->post("joined_date");
    $coa_id = intval($this->input->post("coa_id"));

    if($date=='')
    {
      $date= date('Y-m-d');
    }

    

    $ket = substr($this->input->post("ket"), 0, 200);
    
    $read_select = $this->m_t_m_d_anggota->select_by_id($anggota_id);
    foreach ($read_select as $key => $value) 
    {
        $anggota = $value->ANGGOTA;
    }

      $inv_int = 0;
      $read_select = $this->m_t_p_t_pinjaman->select_inv_int();
      foreach ($read_select as $key => $value) 
      {
        $inv_int = intval($value->INV_INT)+1;
      }

      $read_select = $this->m_t_m_d_company->select_by_company_id();
      foreach ($read_select as $key => $value) 
      {
        $inv_hutang_karyawan = $value->INV_HUTANG_KARYAWAN;
      }

      $live_inv = $inv_hutang_karyawan.date('y-m').'.'.sprintf('%05d', $inv_int);

    $created_id = strtotime(date('Y-m-d H:i:s'));

    $time_move = date('H:i:s');

    $data = array(
        'DATE' => $date,
        'TIME' => $time_move,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => '',
        'COA_ID' => $coa_id,
        'DEBIT' => 0,
        'KREDIT' => intval($nilai_hutang),
        'CATATAN' => 'Hutang : '.$anggota,
        'DEPARTEMEN' => '0',
        'NO_VOUCER' => $live_inv,
        'CREATED_ID' => $created_id,
        'CHECKED_ID' => 1,
        'SPECIAL_ID' => 0,
        'COMPANY_ID' => $this->session->userdata('company_id')
    );
    $this->m_t_ak_jurnal->tambah($data);

    $data = array(
        'DATE' => $date,
        'TIME' => $time_move,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => '',
        'COA_ID' => 666,
        'DEBIT' => intval($nilai_hutang),
        'KREDIT' => 0,
        'CATATAN' => 'Hutang : '.$anggota,
        'DEPARTEMEN' => '0',
        'NO_VOUCER' => $live_inv,
        'CREATED_ID' => $created_id,
        'CHECKED_ID' => 1,
        'SPECIAL_ID' => 0,
        'COMPANY_ID' => $this->session->userdata('company_id')
    );
    $this->m_t_ak_jurnal->tambah($data);

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(

      'DATE' => $date,
      'ANGGOTA_ID' => $anggota_id,

      'KET' => $ket,
      'VALUE' => $nilai_hutang,
      'SISA_VALUE' => $nilai_hutang,

      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE,
      'COA_ID' => $coa_id,
      'INV' => $live_inv,
      'INV_INT' => $inv_int
    );

    $this->m_t_p_t_pinjaman->tambah($data);

    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    redirect('c_t_p_t_pinjaman');
  }





}

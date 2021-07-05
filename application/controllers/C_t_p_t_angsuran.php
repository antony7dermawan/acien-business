<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_p_t_angsuran extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_p_personal');

    
    $this->load->model('m_t_p_t_angsuran');
    $this->load->model('m_t_p_t_pinjaman');
  }

  public function index()
  {
    $this->session->set_userdata('t_p_t_angsuran_delete_logic', '1');
    $this->session->set_userdata('t_p_personal_delete_logic', '0');





    $data = [
      "c_t_p_t_angsuran" => $this->m_t_p_t_angsuran->select(),

      "c_t_p_personal" => $this->m_t_p_personal->select(),

     

      "title" => "Transaksi Angsuran",
      "description" => "Input semua tunjangan disini"
    ];
    $this->render_backend('template/backend/pages/t_p_t_angsuran', $data);
  }



  public function delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_p_t_angsuran->update($data, $id);


    $read_select = $this->m_t_p_t_angsuran->select_by_id($id);
    foreach ($read_select as $key => $value) 
    {
      $r_value = $value->VALUE;
      $r_anggota_id = $value->ANGGOTA_ID;
    }

      $vivo_value = $r_value;
      $read_select = $this->m_t_p_t_pinjaman->select_sisa_value($r_anggota_id);
      foreach ($read_select as $key => $value) 
      {
        if(($vivo_value+$value->SISA_VALUE) <= $value->VALUE)
        {
          $live_sisa_value = $value->SISA_VALUE + $vivo_value;
          $data = array(
            'SISA_VALUE' => $live_sisa_value
          );
          $this->m_t_p_t_pinjaman->update($data,$value->ID);
          $vivo_value = 0; 
        }

        if(($vivo_value+$value->SISA_VALUE) > $value->VALUE)
        {
          $live_sisa_value = $value->VALUE;
          $data = array(
            'SISA_VALUE' => $live_sisa_value
          );
          $this->m_t_p_t_pinjaman->update($data,$value->ID);
          $vivo_value = $vivo_value - $value->SISA_VALUE;
        }
      }



    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_p_t_angsuran');
  }

  public function undo_delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => FALSE
    );
    $this->m_t_p_t_angsuran->update($data, $id);
    
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Dikembalikan!</strong></p></div>');
    redirect('/c_t_p_personal');
  }


  function tambah()
  {
    
    $anggota_id = intval($this->input->post("anggota_id"));

    $date = $this->input->post("date");
    $value_angsuran = intval($this->input->post("value"));

    $joined_date = $this->input->post("joined_date");


    if($date=='')
    {
      $date= date('Y-m-d');
    }

  

    $ket = substr($this->input->post("ket"), 0, 200);
    
    $sisa_value_tt = 0;
    $read_select = $this->m_t_p_t_pinjaman->select_sisa_value_for_1_angsuran_id($anggota_id);
    foreach ($read_select as $key => $value) 
    {
      $sisa_value_tt = $value->SUM_SISA_VALUE;
    }




    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    if($value_angsuran>$sisa_value_tt)
    {
      $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Gagal!</strong> Jumlah melebihi pinjaman!</p></div>');
    }
    if($value_angsuran<=$sisa_value_tt)
    {
      $data = array(

        'DATE' => $date,
        'ANGGOTA_ID' => $anggota_id,

        'KET' => $ket,
        'VALUE' => $value_angsuran,

        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => '',
        'MARK_FOR_DELETE' => FALSE
      );

      $this->m_t_p_t_angsuran->tambah($data);



      $vivo_value = $value_angsuran;
        $read_select = $this->m_t_p_t_pinjaman->select_sisa_value($anggota_id);
        foreach ($read_select as $key => $value) 
        {
          if($vivo_value<=$value->SISA_VALUE)
          {
            $live_sisa_value = $value->SISA_VALUE - $vivo_value;
            $data = array(
              'SISA_VALUE' => $live_sisa_value
            );
            $this->m_t_p_t_pinjaman->update($data,$value->ID);
            $vivo_value = 0;
          }

          if($vivo_value>$value->SISA_VALUE)
          {
            $live_sisa_value = 0;
            $data = array(
              'SISA_VALUE' => $live_sisa_value
            );
            $this->m_t_p_t_pinjaman->update($data,$value->ID);
            $vivo_value = $vivo_value - $value->SISA_VALUE;
          }
        }




      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    }
    
    redirect('c_t_p_t_angsuran');
  }





}

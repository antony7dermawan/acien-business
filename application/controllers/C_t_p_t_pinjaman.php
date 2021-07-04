<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_p_t_pinjaman extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_p_personal');

    
    $this->load->model('m_t_p_t_pinjaman');
  }

  public function index()
  {
    $this->session->set_userdata('t_p_t_pinjaman_delete_logic', '1');
    $this->session->set_userdata('t_p_personal_delete_logic', '0');





    $data = [
      "c_t_p_t_pinjaman" => $this->m_t_p_t_pinjaman->select(),

      "c_t_p_personal" => $this->m_t_p_personal->select(),

     

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
      'SISA_VALUE' => $value,

      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE
    );

    $this->m_t_p_t_pinjaman->tambah($data);

    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    redirect('c_t_p_t_pinjaman');
  }





}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_p_bpjs_tk extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_p_bpjs_tk');
  }

  public function index()
  {
    $this->session->set_userdata('t_p_bpjs_tk_delete_logic', '1');
    $data = [
      "c_t_p_bpjs_tk" => $this->m_t_p_bpjs_tk->select(),
      "title" => "Master BPJS TK",
      "description" => "BPJS TK untuk Payroll"
    ];
    $this->render_backend('template/backend/pages/t_p_bpjs_tk', $data);
  }



  public function delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_p_bpjs_tk->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_p_bpjs_tk');
  }

  public function undo_delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => FALSE
    );
    $this->m_t_p_bpjs_tk->update($data, $id);
    
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Dikembalikan!</strong></p></div>');
    redirect('/c_t_p_bpjs_tk');
  }


  function tambah()
  {
    
    $bpjs_tk = substr($this->input->post("bpjs_tk"), 0, 50);

    $value = intval($this->input->post("value"));

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'BPJS_TK' => $bpjs_tk,
      'VALUE' => $value,
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE
    );

    $this->m_t_p_bpjs_tk->tambah($data);

    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    redirect('c_t_p_bpjs_tk');
  }






  public function edit_action()
  {
    $id = $this->input->post("id");
    $bpjs_tk = substr($this->input->post("bpjs_tk"), 0, 50);

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'BPJS_TK' => $bpjs_tk,
      'UPDATED_BY' => $this->session->userdata('username')
    );

    $this->m_t_p_bpjs_tk->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    redirect('/c_t_p_bpjs_tk');
  }
}

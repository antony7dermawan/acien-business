<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_p_position extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_p_position');
  }

  public function index()
  {
    $this->session->set_userdata('t_p_position_delete_logic', '1');
    $data = [
      "c_t_p_position" => $this->m_t_p_position->select(),
      "title" => "Master Position",
      "description" => "Position untuk Payroll"
    ];
    $this->render_backend('template/backend/pages/t_p_position', $data);
  }



  public function delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_p_position->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_p_position');
  }

  public function undo_delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => FALSE
    );
    $this->m_t_p_position->update($data, $id);
    
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Dikembalikan!</strong></p></div>');
    redirect('/c_t_p_position');
  }


  function tambah()
  {
    
    $position = substr($this->input->post("position"), 0, 50);

    $nominal = intval($this->input->post("nominal"));

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'POSITION' => $position,
      'VALUE' => $nominal,
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE
    );

    $this->m_t_p_position->tambah($data);

    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    redirect('c_t_p_position');
  }






  public function edit_action()
  {
    $id = $this->input->post("id");
    $position = substr($this->input->post("position"), 0, 50);
    $nominal = intval($this->input->post("nominal"));

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'POSITION' => $position,
      'VALUE' => $nominal,
      'UPDATED_BY' => $this->session->userdata('username')
    );

    $this->m_t_p_position->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    redirect('/c_t_p_position');
  }
}

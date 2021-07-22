<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_t_payroll_personal extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_t_payroll');
    $this->load->model('m_t_p_personal');
    $this->load->model('m_t_p_t_angsuran');
    $this->load->model('m_t_p_t_potongan_lain');
    $this->load->model('m_t_p_t_tunjangan_lain');

  }

  public function index()
  {

    $anggota_id = $this->session->userdata('anggota_payroll_personal');

    $from_date = $this->session->userdata('date_from_payroll_personal');

    if($from_date=='')
    {
      $this->session->set_userdata('date_from_payroll_personal', date('Y-m-d'));
      $from_date = $this->session->userdata('date_from_payroll_personal');
    }
    $to_date = date('Y').'-12-31';

    $data = [
      "c_t_p_personal" => $this->m_t_p_personal->select(),
      "c_t_t_payroll" => $this->m_t_t_payroll->select_personal($from_date,$to_date,$anggota_id),
      "title" => "Transaksi Payroll Personal",
      "description" => "Table Payroll Personal"
    ];
    $this->render_backend('template/backend/pages/t_t_payroll_personal', $data);
  }

  public function change_data()
  {
    $date_from_payroll_personal = ($this->input->post("date_from_payroll_personal"));
    $this->session->set_userdata('date_from_payroll_personal', $date_from_payroll_personal);

    $anggota_payroll_personal = ($this->input->post("anggota_id"));
    $this->session->set_userdata('anggota_payroll_personal', $anggota_payroll_personal);

    redirect('/c_t_t_payroll_personal');
  }



  public function update_slip_gaji()
  {
    $choosed_month = $this->session->userdata('choosed_month');

    $from_cut_off = 28;
    $to_cut_off = 27;


    if($choosed_month=='')
    {
      $choosed_month = date('m');
    }
    $to_date = date('Y').'-'.$choosed_month.'-'.$to_cut_off;
    if($choosed_month>1)
    {
      $from_date = date('Y').'-'.($choosed_month-1).'-'.$from_cut_off;
    }

    if($choosed_month==1)
    {
      $from_date = (date('Y')-1).'-12-'.$from_cut_off;
    }

    $this->m_t_t_payroll->delete_by_date($from_date,$to_date);

    $read_select = $this->m_t_p_personal->select();
    foreach ($read_select as $key => $value) 
    {
      $anggota_id = $value->ID;
      $anggota = $value->ANGGOTA;


      $read_select_in = $this->m_t_p_t_angsuran->sum_value_by_date($from_date,$to_date,$anggota_id);
      foreach ($read_select_in as $key_in => $value_in) 
      {
        $sum_angsuran = $value_in->SUM_ANGSURAN;
      }

      $read_select_in = $this->m_t_p_t_potongan_lain->sum_value_by_date($from_date,$to_date,$anggota_id);
      foreach ($read_select_in as $key_in => $value_in) 
      {
        $sum_potongan = $value_in->SUM_POTONGAN_LAIN;
      }

      $read_select_in = $this->m_t_p_t_tunjangan_lain->sum_value_by_date($from_date,$to_date,$anggota_id);
      foreach ($read_select_in as $key_in => $value_in) 
      {
        $sum_tunjangan = $value_in->SUM_TUNJANGAN_LAIN;
      }

      $data = array(
        'ANGGOTA_ID' => $anggota_id,
        'FROM_DATE' => $from_date,
        'TO_DATE' => $to_date,
        'GP_VALUE' => $value->GP,
        'POSITION_VALUE' => $value->POSITION_VALUE,
        'TUNJANGAN_VALUE' => $sum_tunjangan,
        'POTONGAN_VALUE' => $sum_potongan,
        'ANGSURAN_VALUE' => $sum_angsuran,
        'BPJS_VALUE' => $value->BPJS_TK_VALUE + $value->BPJS_KES_VALUE
      );

      $this->m_t_t_payroll->tambah($data);
    }



    redirect('/c_t_t_payroll');
  }







  function tambah()
  {
    
    $position = substr($this->input->post("position"), 0, 50);

    $value = intval($this->input->post("value"));

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'POSITION' => $position,
      'VALUE' => $value,
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

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'POSITION' => $position,
      'UPDATED_BY' => $this->session->userdata('username')
    );

    $this->m_t_p_position->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    redirect('/c_t_p_position');
  }
}

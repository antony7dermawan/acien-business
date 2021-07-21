<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_dashboard extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_t_t_t_penjualan_rincian');
    $this->load->model('m_t_t_t_pembelian');
    $this->load->model('m_t_t_t_pemakaian');

    
  }

  public function index()
  {
    $data = [
      "select_rekap_pelanggan" => $this->m_t_t_t_penjualan_rincian->select_rekap_pelanggan($this->session->userdata('date_from_dashboard_1'),$this->session->userdata('date_to_dashboard_1')),

      "select_rekap_sales" => $this->m_t_t_t_penjualan_rincian->select_rekap_sales($this->session->userdata('date_from_dashboard_2'),$this->session->userdata('date_to_dashboard_2')),

      "c_t_t_t_pembelian" => $this->m_t_t_t_pembelian->select_dashboard(date('Y-m-d')),
      "c_t_t_t_pemakaian" => $this->m_t_t_t_pemakaian->select_dashboard(date('Y-m-d')),

      "title" => "Dashboard",
      "description" => "Web Version:21-01-26 22:11"
    ];

    $this->render_backend('template/backend/pages/dashboard', $data);
  }

  public function search_date_1()
  {
    $date_from_dashboard_1 = ($this->input->post("date_from_dashboard_1"));
    $this->session->set_userdata('date_from_dashboard_1', $date_from_dashboard_1);

    $date_to_dashboard_1 = ($this->input->post("date_to_dashboard_1"));
    $this->session->set_userdata('date_to_dashboard_1', $date_to_dashboard_1);
    redirect('/c_dashboard');
  }



  public function search_date_2()
  {
    $date_from_dashboard_2 = ($this->input->post("date_from_dashboard_2"));
    $this->session->set_userdata('date_from_dashboard_2', $date_from_dashboard_2);

    $date_to_dashboard_2 = ($this->input->post("date_to_dashboard_2"));
    $this->session->set_userdata('date_to_dashboard_2', $date_to_dashboard_2);
    redirect('/c_dashboard');
  }



}

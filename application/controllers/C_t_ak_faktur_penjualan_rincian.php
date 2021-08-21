<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_ak_faktur_penjualan_rincian extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_ak_faktur_penjualan_rincian');
    $this->load->model('m_t_ak_faktur_penjualan');

    $this->load->model('m_t_t_t_penjualan_jasa');
  }


  public function index($id, $pelanggan_id)
  {
    $data = [
      "c_t_ak_faktur_penjualan_rincian" => $this->m_t_ak_faktur_penjualan_rincian->select($id),
      "c_t_ak_faktur_penjualan" => $this->m_t_ak_faktur_penjualan->select_by_id($id),
      "faktur_penjualan_id" => $id,
      "pelanggan_id" => $pelanggan_id,
      
      "title" => "Rincian Transaksi Faktur Penjualan",
      "description" => ""
    ];
    $this->render_backend('template/backend/pages/t_ak_faktur_penjualan_rincian', $data);
  }



  function create_faktur_penjualan($id, $pelanggan_id)
  {
    $date_from_select_penjualan = ($this->input->post("date_from_select_penjualan"));
    $date_to_select_penjualan = ($this->input->post("date_to_select_penjualan"));

    $this->session->set_userdata('date_from_select_penjualan', $date_from_select_penjualan);
    $this->session->set_userdata('date_to_select_penjualan', $date_to_select_penjualan);


    #$this->m_t_ak_faktur_penjualan_rincian->delete_id($id);


    $read_select = $this->m_t_t_t_penjualan_jasa->select_date($pelanggan_id, $date_from_select_penjualan, $date_to_select_penjualan);
    foreach ($read_select as $key => $value) {
      $penjualan_id = $value->ID;

      $data = array(
        'DATE' => date('Y-m-d'),
        'TIME' => date('H:i:s'),
        'FAKTUR_PENJUALAN_ID' => $id,
        'PENJUALAN_ID' => $penjualan_id,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => $this->session->userdata('username'),
        'KETERANGAN' => 'PENJUALAN'
      );

      $this->m_t_ak_faktur_penjualan_rincian->tambah($data);

      $data = array(
        'ENABLE_EDIT' => 0
      );
      $this->m_t_t_t_penjualan_jasa->update($data, $penjualan_id);
    }




    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    redirect('c_t_ak_faktur_penjualan_rincian/index/' . $id . '/' . $pelanggan_id);
  }


  public function delete($id_faktur_penjualan_rincian,$penjualan_id,$id_faktur_penjualan,$pelanggan_id)
  {
    $data = array(
        'ENABLE_EDIT' => 1
      );
      $this->m_t_t_t_penjualan_jasa->update($data, $penjualan_id);

    $this->m_t_ak_faktur_penjualan_rincian->delete($id_faktur_penjualan_rincian);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('c_t_ak_faktur_penjualan_rincian/index/' . $id_faktur_penjualan . '/' . $pelanggan_id);
  }



}

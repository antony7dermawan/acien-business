<?php
defined('BASEPATH') or exit('No direct script access allowed');


class C_t_t_t_penjualan_jasa_rincian extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_t_t_penjualan_jasa');

    $this->load->model('m_t_t_t_penjualan_jasa_rincian'); 

    $this->load->model('m_t_t_t_pembelian');
    
    $this->load->model('m_t_m_d_satuan');
    $this->load->model('m_t_m_d_company');
    $this->load->model('m_t_m_d_barang');
    
    $this->load->model('m_t_t_t_pembelian_rincian'); 
  }

  public function index($penjualan_jasa_id)
  {
    $this->session->set_userdata('t_t_t_penjualan_jasa_delete_logic', '1');
    $this->session->set_userdata('t_m_d_satuan_delete_logic', '0');
    $this->session->set_userdata('t_m_d_barang_delete_logic', '0');

    $this->session->set_userdata('master_barang_kategori_id', '0');
    $this->session->set_userdata('master_barang_company_id', $this->session->userdata('company_id'));


    $data = [
      //"select_barang_with_supplier" => $this->m_t_t_t_pembelian_rincian->select_barang_with_supplier(),
      "c_t_t_t_penjualan_jasa_rincian" => $this->m_t_t_t_penjualan_jasa_rincian->select($penjualan_jasa_id),

      "c_t_t_t_penjualan_jasa_by_id" => $this->m_t_t_t_penjualan_jasa->select_by_id($penjualan_jasa_id),



      "c_t_m_d_satuan" => $this->m_t_m_d_satuan->select_option(),


      "c_t_m_d_barang" => $this->m_t_m_d_barang->select(),
      
      "penjualan_jasa_id" => $penjualan_jasa_id,
      "title" => "Transaksi Penjualan Jasa",
      "description" => "form Penjualan Jasa"
    ];
    $this->render_backend('template/backend/pages/t_t_t_penjualan_jasa_rincian', $data);
  }



  public function delete($id,$penjualan_jasa_id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_t_t_penjualan_jasa_rincian->update($data, $id);



    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');

    redirect('c_t_t_t_penjualan_jasa_rincian/index/' . $penjualan_jasa_id);
  }


 

  function tambah($penjualan_jasa_id)
  {
    $produk = substr($this->input->post("produk"), 0, 500);

    $qty = floatval($this->input->post("qty"));
    $harga_jual = floatval($this->input->post("harga_jual"));

    $satuan_id = intval($this->input->post("qty"));

    $sub_total_1 = ($qty * $harga_jual);
    $sub_total = $sub_total_1;



    $data = array(
        'PENJUALAN_JASA_ID' => $penjualan_jasa_id,
        'PRODUK' => $produk,
        'QTY' => $qty,
        'SATUAN_ID' => $satuan_id,
        'HARGA' => $harga_jual,
        'SUB_TOTAL' => $sub_total,
        'COMPANY_ID' => $this->session->userdata('company_id'),
        'MARK_FOR_DELETE' => FALSE,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => ''
    );

      $this->m_t_t_t_penjualan_jasa_rincian->tambah($data);



      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
      redirect('c_t_t_t_penjualan_jasa_rincian/index/' . $penjualan_jasa_id);
    
    

    
    redirect('c_t_t_t_penjualan_jasa_rincian/index/'.$penjualan_jasa_id);
  }




}
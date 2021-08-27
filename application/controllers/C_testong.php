<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_testong extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_t_t_t_pembelian_rincian');
  }


  public function index()
  {
    
      
    
    $time_send = date('H:i:s');

    $minute_send = (strtotime(date('Y-m-d H:i:s'))/1000000);

    echo strtotime(date('23:59:59'));
    echo "<br>";

    echo strtotime(date('H:i:s'));

    echo "<br>";
    echo intval(substr(strtotime(date('H:i:s')), -5));

    echo "<br>";

    echo strtotime(date('Y-m-d H:i:s'));
  }


}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_penjualan_jasa_print_1 extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_t_t_penjualan_jasa_rincian');
    $this->load->model('m_t_t_t_penjualan_jasa');
    $this->load->model('m_t_ak_faktur_penjualan_print_setting');
  }

  public function index($id)
  {
    $pdf = new \TCPDF();
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->AddPage('P', 'mm', 'A4');
    $pdf->SetAutoPageBreak(true, 0);
 
        // Add Header
    
    #.............................paper head
    

    
    






    $pdf->SetFont('','',12);

    $read_select = $this->m_t_t_t_penjualan_jasa->select_by_id($id);
    foreach ($read_select as $key => $value)
    {
      $no_pelanggan=$value->PELANGGAN;
      $no_faktur=$value->INV;
      $tgl_faktur=$value->DATE;
      $nama=$value->PELANGGAN;
      $alamat=$value->ALAMAT;
      $npwp=$value->NPWP;
      $telepon=$value->NO_TELP;
    }

    

    $total_kuantitas = 0;
    $total_sub = 0;
    $dpp = 0;
    $ppn = 0;
    $pph_22 = 0;
    $total_tagihan = 0;
    $total_row_1_bon = 10;
    $read_select = $this->m_t_t_t_penjualan_jasa_rincian->select($id);
    foreach ($read_select as $key => $value) 
    {
      $rmd=(float)($key/$total_row_1_bon);
      $rmd=($rmd-(int)$rmd)*$total_row_1_bon;

      if($key==0 or ($key>=$total_row_1_bon and $rmd==0))
      {
        if($key>=$total_row_1_bon and $rmd==0)
        {
          $pdf->SetPrintHeader(false);
          $pdf->SetPrintFooter(false);
          $pdf->AddPage();
        }
        //$pdf->Image('assets/images/logo-jo.jpg',10,10,0);


     

        $pdf->SetFont('','I',9);
        

        $pdf->Cell(120, 4, "", '0', 0, 'L');
        $pdf->Cell(57, 4, "PT. Cahaya Baru Gemilang", '0', 1, 'R');

        
        $pdf->Image('assets/images/logo-cbg.jpeg',186,8,14);

        $pdf->Cell(120, 4, "", '0', 0, 'L');
        $pdf->Cell(57, 4, "Pekanbaru, Riau - Indonesia", '0', 1, 'R');





        $x_value = $pdf->GetX();
        $y_value = $pdf->GetY();
        $pdf->SetXY($x_value, $y_value-10);

        $pdf->SetFont('','B',16);
    
        $pdf->Cell(190, 11, "Invoice", '0', 1, 'L');

        


        $pdf->SetFont('','B',12);
        $pdf->Cell( 190,10,'','0',1,'C'); //judul

        $pdf->SetFont('','',9);
        $pdf->Cell( 40,5,'No Invoice','0',0,'L');
        $pdf->Cell( 100,5,':  '.$no_faktur,'0',1,'L');
        $pdf->Cell( 40,5,'Tanggal Faktur','0',0,'L');
        $pdf->Cell( 100,5,':  '.date('d-m-Y', strtotime($tgl_faktur)),'0',1,'L');
        $pdf->Cell( 40,5,'Klien','0',0,'L');
        $pdf->Cell( 100,5,':  '.$nama,'0',1,'L');
        

        $pdf->Cell( 40,5,'Alamat','0',0,'L');
        $pdf->MultiCell(100, 5, ':'.substr($alamat, 0, 200), 0, 'L',0,1);



        $pdf->Cell( 100,3,'','0',1,'L');

        $pdf->SetFont('','B',9);
        $size[0]=10;
        $size[1]=60;
        $size[2]=30;
        $size[3]=15;
        $size[4]=15;
        $size[5]=30;
        $size[6]=30;
        
        $pdf->Cell( $size[0],8,'No.','1',0,'C');
        $pdf->Cell( $size[1]+$size[2],8,'Produk','1',0,'C');
        $pdf->Cell( $size[3],8,'Jumlah','1',0,'C');
        $pdf->Cell( $size[4],8,'Satuan','1',0,'C');

        $pdf->Cell( $size[5],8,'Harga (Rp.)','1',0,'C');
        $pdf->Cell( $size[6],8,'Sub Total','1',1,'C');
      }
      
      
      $pdf->SetFont('','',9);
      $pdf->Cell( $size[0],6,$key+1,'L',0,'C');
      $pdf->Cell( $size[1]+$size[2],6,$value->PRODUK,'L',0,'L');

      $pdf->Cell( $size[3],6,$value->QTY,'L',0,'C');
      $pdf->Cell( $size[4],6,$value->SATUAN,'L',0,'C');
      $pdf->Cell( $size[5],6,number_format(round($value->HARGA)),'L',0,'R');
      $pdf->Cell( $size[6]-0.1,6,number_format(round($value->SUB_TOTAL)),'L',0,'R');

      $pdf->Cell( 0.1,6,'','L',1,'R');

      $total_kuantitas = $total_kuantitas+round($value->SUB_TOTAL);

      $total_sub = $total_sub+round($value->SUB_TOTAL);
      $dpp = $total_sub;
    }

    for($i=0;$i<=1;$i++)
    {
      $pdf->Cell( $size[0],6,'','L',0,'C');
      $pdf->Cell( $size[1],6,'','L',0,'L');
      $pdf->Cell( $size[2],6,'','0',0,'C');
      $pdf->Cell( $size[3],6,'','L',0,'C');
      $pdf->Cell( $size[4],6,'','L',0,'C');
      $pdf->Cell( $size[5],6,'','L',0,'C');

      $pdf->Cell( $size[6]-0.1,6,'','L',0,'R');
      $pdf->Cell( 0.1,6,'','L',1,'R'); 
    }

    #.............................paper head end
    $total_sub = round($total_sub);

    $pdf->SetFont('','B',9);

    $pdf->Cell( $size[0]+$size[1]+$size[2]+$size[3]+$size[4]+$size[5],5,'Total','TRL',0,'R');
    $pdf->Cell( $size[6],5,number_format(intval($total_sub)),'TR',1,'R');


    $ppn = round(($total_sub * 10)/100);

    $pdf->Cell( $size[0]+$size[1]+$size[2]+$size[3]+$size[4]+$size[5],5,'PPN 10%','TRL',0,'R');
    $pdf->Cell( $size[6],5,number_format(intval($ppn)),'TR',1,'R');

    $total_harga = $total_sub  + $ppn;

    $pdf->Cell( $size[0]+$size[1]+$size[2]+$size[3]+$size[4]+$size[5],5,'Jumlah','TRL',0,'R');
    $pdf->Cell( $size[6],5,number_format(intval($total_harga)),'TR',1,'R');


    $pdf->Cell( $size[0]+$size[1]+$size[2]+$size[3]+$size[4]+$size[5],5,'Penalti','TRL',0,'R');
    $pdf->Cell( $size[6],5,number_format(intval(0)),'TR',1,'R');


    $total_tagihan = $total_harga;

    $pdf->Cell( $size[0]+$size[1]+$size[2]+$size[3]+$size[4]+$size[5],5,'Grand Total (Rp.)','TRL',0,'R');
    $pdf->Cell( $size[6],5,number_format(intval($total_tagihan)),'TR',1,'R');



    $pdf->SetFont('','',9);

    $pdf->MultiCell(190 ,20,'Terbilang : '.ucwords($this->terbilang($total_tagihan)).'.','T','L');
 

    

    
    
    $read_select = $this->m_t_ak_faktur_penjualan_print_setting->select_id(12);
    foreach ($read_select as $key => $value) 
    {
      $setting_value=$value->SETTING_VALUE;
    }
    $pdf->Cell( 140,5,'','0',0,'L');
    $pdf->Cell( 50,5,$setting_value.','.date('d-m-Y'),'0',1,'R');




    $pdf->Cell( 140,4,'','0',0,'L');
    $pdf->Cell( 50,4,'Hormat kami,','0',1,'R');

    $pdf->Cell( 140,15,'','0',1,'L');


  



    $read_select = $this->m_t_ak_faktur_penjualan_print_setting->select_id(10);
    foreach ($read_select as $key => $value) 
    {
      $setting_value=$value->SETTING_VALUE;
    }
    $pdf->Cell( 140,4,'','0',0,'L');
    $pdf->Cell( 50,4,$setting_value,'0',1,'R');



    $pdf->SetFont('','',10);
    $read_select = $this->m_t_ak_faktur_penjualan_print_setting->select_id(4);
    foreach ($read_select as $key => $value) 
    {
      $setting_value=$value->SETTING_VALUE;
    }

    $pdf->Cell( 120,5,$setting_value,'0',1,'L');



    $read_select = $this->m_t_ak_faktur_penjualan_print_setting->select_id(5);
    foreach ($read_select as $key => $value) 
    {
      $setting_value=$value->SETTING_VALUE;
    }
    $pdf->Cell( 120,5,$setting_value,'0',1,'L');


    $read_select = $this->m_t_ak_faktur_penjualan_print_setting->select_id(6);
    foreach ($read_select as $key => $value) 
    {
      $setting_value=$value->SETTING_VALUE;
    }

    $pdf->Cell( 120,5,$setting_value,'0',1,'L');




    $read_select = $this->m_t_ak_faktur_penjualan_print_setting->select_id(7);
    foreach ($read_select as $key => $value) 
    {
      $setting_value=$value->SETTING_VALUE;
    }
    $pdf->MultiCell(190 ,10,$setting_value,0,'L');

    


    $pdf->Output("penjualan_jasa_1_".$no_faktur.".pdf");
  }



  
function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = $this->penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
      $temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . $this->penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . $this->penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }

  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim($this->penyebut($nilai));
    } else {
      $hasil = trim($this->penyebut($nilai));
    }         
    return $hasil;
  }
  



}

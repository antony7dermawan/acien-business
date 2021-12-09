<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_penjualan_jasa_print_4 extends MY_Controller
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

      $no_faktur_pajak=$value->NO_FAKTUR_PAJAK;
      $blok=$value->BLOK;
      $no_bap=$value->NO_BAP;
      $no_spk=$value->NO_SPK;
    }

    


    $judul_untuk[0]='Untuk Pengusaha Kena Pajak yang
Menerima Faktur Pajak Standar 
Sebagai Bukti Pajak Masukan';
    $judul_untuk[1]='Untuk Pengusaha Kena Pajak yang
Menerbitkan Faktur Pajak Standar
Sebagai Bukti Pajak Keluaran';
    $judul_untuk[2]='Extra Copy';


    for($rangkap=0; $rangkap<=2; $rangkap++)
    { 
      if($rangkap>0)
      {
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->AddPage();
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
          $pdf->Cell(20, 4, "Lembar ke-".($rangkap+1).':', '0', 0, 'R');
          $pdf->MultiCell(60, 5, $judul_untuk[$rangkap] , 0, 'L',0,1);


          





          $pdf->SetFont('','B',12);
      
          $pdf->Cell(190, 11, "FAKTUR PAJAK", '0', 1, 'C');

          


          $pdf->SetFont('','',12);

          $pdf->SetFont('','',11);
          $pdf->Cell( 190,12,'Kode dan Nomor Seri Faktur Pajak :           '.$no_faktur_pajak,'1',1,'L');




          $pdf->Cell( 190,7,'Pengusaha Kena Pajak','1',1,'L');


          $pdf->Cell( 190,30,'','1',1,'L');


          $x_value = $pdf->GetX();
          $y_value = $pdf->GetY();
          $pdf->SetXY($x_value, $y_value-30);

          $pdf->Cell( 40,5,'Nama','L',0,'L');
          $pdf->Cell( 150,5,': ACIEN GLOBAL INDONESIA','R',1,'L');

          $pdf->Cell( 40,5,'Alamat','L',0,'L');
          $pdf->MultiCell(150, 5, ': PERUM VILLA DUYUNG BLOK A NO.5 RT.006 RW.004
 TANGKERANG BARAT, MARPOYAN DAMAI
 PEKANBARU RIAU' , 'R', 'L',0,1);



          $pdf->Cell( 190,5,'','0',1,'L');


          $pdf->Cell( 40,5,'NPWP','L',0,'L');
          $pdf->Cell( 150,5,': 74.343.752.7-216.000','R',1,'L');



          $pdf->Cell( 190,7,'Pembeli Barang Kena Pajak / Penerima Jasa Kena Pajak','LRB',1,'L');



          


          $x_value = $pdf->GetX();
          $y_value = $pdf->GetY();
          

          $pdf->Cell( 40,5,'Nama','L',0,'L');
          $pdf->Cell( 150,5,': '.$nama,'R',1,'L');

          $pdf->Cell( 40,5,'Alamat','L',0,'L');
          $pdf->MultiCell(150, 5, ': '.$alamat, 'R', 'L',0,1);


          $pdf->Cell( 190,5,'','0',1,'L');


          $pdf->Cell( 40,5,'NPWP','L',0,'L');
          $pdf->Cell( 150,5,': '.$npwp,'R',1,'L');


          
          


          $pdf->SetXY($x_value, $y_value);

          $pdf->Cell( 190,30,'','1',1,'L');




          





          $pdf->SetFont('','',9);
          $size[0]=15;
          $size[1]=135;
          $size[2]=40;


          $size[3]=15;
          $size[4]=15;
          $size[5]=30;
          $size[6]=30;
          
        



          $pdf->MultiCell($size[0], 15, ' No Urut', 1, 'C',0,0);

          $pdf->MultiCell($size[1], 15, ' Nama Barang Kena Pajak / Jasa Kena Pajak', 1, 'C',0,0);
          $pdf->MultiCell($size[2], 15, 'Harga Jual / Penggantian /
 Uang Muka / Termin
 (Rp.)', 1, 'C',0,1);


        }
        
        
        $pdf->SetFont('','',10);
        $pdf->Cell( $size[0],6,$key+1,'L',0,'C');
        $pdf->Cell( $size[1],6,$value->PRODUK,'L',0,'L');

        $pdf->Cell( $size[2]-0.1,6,number_format(round($value->SUB_TOTAL)),'L',0,'R');

        $pdf->Cell( 0.1,6,'','L',1,'R');

        $total_kuantitas = $total_kuantitas+round($value->SUB_TOTAL);

        $total_sub = $total_sub+round($value->SUB_TOTAL);
        $dpp = $total_sub;
      }

      for($i=0;$i<=1;$i++)
      {
        $pdf->Cell( $size[0],6,'','L',0,'C');
        $pdf->Cell( $size[1],6,'','L',0,'L');

        $pdf->Cell( $size[2]-0.1,6,'','L',0,'R');
        $pdf->Cell( 0.1,6,'','L',1,'R'); 
      }

      #.............................paper head end
      $total_sub = round($total_sub);



      $pdf->Cell( 0.1,5,'','L',0,'R');
      $pdf->Cell( $size[0],5,'Harga Jual / Penggantian / Uang Muka / Termin *)','T',0,'L');
      $pdf->Cell( $size[1],5,':','T',0,'L');
      $pdf->Cell( $size[2]-0.1,5,number_format(intval($total_sub)),'TL',0,'R');
      $pdf->Cell( 0.1,5,'','L',1,'R');

      $x_value = $pdf->GetX();
      $y_value = $pdf->GetY();
      $pdf->SetXY($x_value, $y_value-5);

      $pdf -> Line(90,$y_value-2.5 , 30, $y_value-2.5);

      $x_value = $pdf->GetX();
      $y_value = $pdf->GetY();
      $pdf->SetXY($x_value, $y_value+5);


      



      $pdf->Cell( 0.1,5,'','L',0,'R');
      $pdf->Cell( $size[0],5,'Dikurangi Potongan Harga','T',0,'L');
      $pdf->Cell( $size[1],5,'','T',0,'L');
      $pdf->Cell( $size[2]-0.1,5,'-','TL',0,'R');
      $pdf->Cell( 0.1,5,'','L',1,'R');



      $pdf->Cell( 0.1,5,'','L',0,'R');
      $pdf->Cell( $size[0],5,'Dikurangi Uang Muka yang Telah Diterima','T',0,'L');
      $pdf->Cell( $size[1],5,'','T',0,'L');
      $pdf->Cell( $size[2]-0.1,5,'-','TL',0,'R');
      $pdf->Cell( 0.1,5,'','L',1,'R');



      $pdf->Cell( 0.1,5,'','L',0,'R');
      $pdf->Cell( $size[0],5,'Dasar Pengenaan Pajak','T',0,'L');
      $pdf->Cell( $size[1],5,':','T',0,'L');
      $pdf->Cell( $size[2]-0.1,5,number_format(intval($total_sub)),'TL',0,'R');
      $pdf->Cell( 0.1,5,'','L',1,'R');





      $ppn = round(($total_sub * 10)/100);


      $pdf->Cell( 0.1,5,'','L',0,'R');
      $pdf->Cell( $size[0],5,'PPn = 10% x Dasar Pengenaan Pajak','TB',0,'L');
      $pdf->Cell( $size[1],5,':','TB',0,'L');
      $pdf->Cell( $size[2]-0.1,5,number_format(intval($ppn)),'LTB',0,'R');
      $pdf->Cell( 0.1,5,'','L',1,'R');

      $total_harga = $total_sub  + $ppn;
      
     
      $pdf->Cell( 190,5,'Pajak Penjualan Atas Barang Mewah','TLR',1,'L');


      $pdf->Cell( 25,5,'Tarif','TLR',0,'C');
      $pdf->Cell( 30,5,'DPP','TLR',0,'C');
      $pdf->Cell( 30,5,'PPnBM','TLR',0,'C');


      $read_select = $this->m_t_ak_faktur_penjualan_print_setting->select_id(12);
      foreach ($read_select as $key => $value) 
      {
        $setting_value=$value->SETTING_VALUE;
      }
      $pdf->Cell( 45,5,'','0',0,'L');
      $pdf->Cell( 60,5,$setting_value.','.date('d-m-Y'),'R',1,'C');



      $pdf->Cell( 25,5,'............. %','TLR',0,'C');
      $pdf->Cell( 30,5,'Rp. ......................','TLR',0,'C');
      $pdf->Cell( 30,5,'Rp. ......................','TLR',0,'C');

      $pdf->Cell( 105,5,'','R',1,'L');

      $pdf->Cell( 25,5,'............. %','TLR',0,'C');
      $pdf->Cell( 30,5,'Rp. ......................','TLR',0,'C');
      $pdf->Cell( 30,5,'Rp. ......................','TLR',0,'C');

      $pdf->Cell( 105,5,'','R',1,'L');
      

      $pdf->Cell( 25,5,'............. %','TLR',0,'C');
      $pdf->Cell( 30,5,'Rp. ......................','TLR',0,'C');
      $pdf->Cell( 30,5,'Rp. ......................','TLR',0,'C');

      $pdf->Cell( 105,5,'','R',1,'L');
      

      $pdf->Cell( 25,5,'............. %','TLR',0,'C');
      $pdf->Cell( 30,5,'Rp. ......................','TLR',0,'C');
      $pdf->Cell( 30,5,'Rp. ......................','TLR',0,'C');

      $read_select = $this->m_t_ak_faktur_penjualan_print_setting->select_id(10);
      foreach ($read_select as $key => $value) 
      {
        $setting_value=$value->SETTING_VALUE;
      }
      $pdf->Cell( 45,5,'','0',0,'L');
      $pdf->Cell( 60,5,$setting_value,'R',1,'C');




      $pdf->Cell( 55,5,'Jumlah','1',0,'l');
      $pdf->Cell( 30,5,'Rp. ......................','1',0,'C');

      $read_select = $this->m_t_ak_faktur_penjualan_print_setting->select_id(8);
      foreach ($read_select as $key => $value) 
      {
        $setting_value=$value->SETTING_VALUE;
      }
      $pdf->Cell( 45,5,'','0',0,'L');
      $pdf->Cell( 60,5,$setting_value,'R',1,'C');

      $pdf->Cell( 190,4,'','LRB',1,'C');
      
    }
    

    


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

<?php

      use PhpOffice\PhpSpreadsheet\Spreadsheet;
      use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
      use PhpOffice\PhpSpreadsheet\Helper\Sample;
      use PhpOffice\PhpSpreadsheet\IOFactory;
      use PhpOffice\PhpSpreadsheet\RichText\RichText;
      use PhpOffice\PhpSpreadsheet\Shared\Date;
      use PhpOffice\PhpSpreadsheet\Style\Alignment;
      use PhpOffice\PhpSpreadsheet\Style\Border;
      use PhpOffice\PhpSpreadsheet\Style\Color;
      use PhpOffice\PhpSpreadsheet\Style\Fill;
      use PhpOffice\PhpSpreadsheet\Style\Font;
      use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
      use PhpOffice\PhpSpreadsheet\Style\Protection;
      use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
      use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
      use PhpOffice\PhpSpreadsheet\Worksheet\ColumnDimension;
      use PhpOffice\PhpSpreadsheet\Worksheet;

      class Lap_slip_gaji_personal extends CI_Controller{

            public function __construct()
            {
                parent::__construct();

                $this->load->model('m_t_t_payroll');
                $this->load->model('m_t_p_t_pinjaman');
                

                $this->load->model('m_t_p_t_tunjangan_lain');
                $this->load->model('m_t_p_t_potongan_lain');

            }



            public function index($date_from_payroll_personal,$anggota_id)
            {
             
                  $spreadsheet = new Spreadsheet();

                  $alp='A';

                  $spreadsheet->getActiveSheet()->getColumnDimension($alp)->setWidth(22);
                  $alp++;
                  $spreadsheet->getActiveSheet()->getColumnDimension($alp)->setWidth(15);
                  $alp++;
                  $spreadsheet->getActiveSheet()->getColumnDimension($alp)->setWidth(20);
                  $alp++;
                  $spreadsheet->getActiveSheet()->getColumnDimension($alp)->setWidth(20);
                  $alp++;
                  $spreadsheet->getActiveSheet()->getColumnDimension($alp)->setWidth(20);
                  $alp++;
                  $spreadsheet->getActiveSheet()->getColumnDimension($alp)->setWidth(20);
                  $alp++;


                  $row=1;

                  

                  $data_logic = 0;
                  $key=0;

                  $to_date = date('Y').'-12-31';
                  $from_date = $date_from_payroll_personal;


                  $r_from_date= $date_from_payroll_personal;
               

                  $read_select = $this->m_t_t_payroll->select_personal($from_date,$to_date,$anggota_id);
                  foreach ($read_select as $key => $value) 
                  {   
                    $data_logic = 1;

                    if($key==0)
                    {
                      $r_anggota=$value->ANGGOTA;
                      $r_from_date=$value->FROM_DATE;
                      $r_no_slip_gaji = 'CBG/SG/'.date('y-m').'/'.$value->ID;
                      $r_alamat = $value->ADDRESS;
                    }
                        
                        
                        $r_to_date=$value->TO_DATE;




                        $r_gp_value[]=$value->GP_VALUE;
                        $r_position_value[]=$value->POSITION_VALUE;
                        $r_tunjangan_value[]=$value->TUNJANGAN_VALUE;
                        $r_potongan_value[]=$value->POTONGAN_VALUE;
                        $r_angsuran_value[]=$value->ANGSURAN_VALUE;
                        $r_bpjs_value[]=$value->BPJS_VALUE;

                        $s_from_date[] = $value->FROM_DATE;
                        $s_to_date[] = $value->TO_DATE;



                        $r_position= $value->POSITION;
                        $r_bank=$value->BANK;
                        $r_bank_account_number=$value->BANK_ACCOUNT_NUMBER;

                  }
                  $total_data = $key;



                  $sum_neto=0;
                  $sum_uang_jalan=0;
                  $sum_total_penjualan=0;

                  if($data_logic==1)
                  {
                  

                    $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':F'.$row);
                    $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setCellValue('A'.$row, 'SLIP GAJI');
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


                    $row=$row+2;

                    $sheet->setCellValue('A'.$row, 'Nomor Slip Gaji');
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                    $sheet->setCellValue('B'.$row,': '. $r_no_slip_gaji);
                    $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('left');

                    $row=$row+1;
                    $sheet->setCellValue('A'.$row, 'Nama Karyawan');
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                    $sheet->setCellValue('B'.$row,': '. $r_anggota);
                    $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('left');

                    $row=$row+1;
                    $sheet->setCellValue('A'.$row, 'Alamat');
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                    $sheet->setCellValue('B'.$row,': '. $r_alamat);
                    $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('left');

                    $dateToTest = $r_to_date;
                    $lastday = date('t-m-Y',strtotime($dateToTest));


                    $row=$row+1;
                    $sheet->setCellValue('A'.$row, 'Posisi');
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                    $sheet->setCellValue('B'.$row,': '. $r_position);
                    $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('left');

                    


                    $row=$row+1;
                    $sheet->setCellValue('A'.$row, 'Metode Bayar');
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                    $sheet->setCellValue('B'.$row,': '. $r_bank);
                    $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('left');

                    


                    $row=$row+1;
                    $sheet->setCellValue('A'.$row, 'No Rekening');
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                    $sheet->setCellValue('B'.$row,': '. $r_bank_account_number);
                    $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('left');

                    $row=$row+1;
                    $sheet->setCellValue('A'.$row, 'Tanggal Pembayaran');
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                    $sheet->setCellValue('B'.$row,': '. $lastday);
                    $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('left');

                    $row=$row+2;
                    $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':F'.$row);
                    $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setCellValue('A'.$row, 'PERIODE GAJI dari '.date('d-m-Y',strtotime($r_from_date)).' sampai '.date('d-m-Y',strtotime($r_to_date)));
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');

                    
                    $row=$row+1;

                    $sheet->setCellValue('A'.$row, 'Periode');
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


                    $sheet->setCellValue('B'.$row, 'Gaji Pokok');
                    $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('center');
                    
                    

                    $sheet->setCellValue('C'.$row, 'Tj. Lain-Lain');
                    $sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('center');

                    $sheet->setCellValue('D'.$row, 'Pot. Lain-Lain');
                    $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('center');

                    $sheet->setCellValue('E'.$row, 'Pot. Angsuran');
                    $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('center');


                    $sheet->setCellValue('F'.$row, 'Nominal');
                    $sheet->getStyle('F'.$row)->getAlignment()->setHorizontal('center');

                          $alp='A';
                          $total_alp=5;
                          for($n=0;$n<=$total_alp;$n++)
                          {
                                $area = $alp.$row;
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $alp++;
                          }

                    $sum_nominal = 0;
                    for($i=0;$i<=$total_data;$i++)
                    {
                      $row=$row+1;
                      

                      $sheet->setCellValue('A'.$row, date('d-m-Y',strtotime($s_from_date[$i])).' ~ '.date('d-m-Y',strtotime($s_to_date[$i])));
                      $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


                      $sheet->setCellValue('B'.$row, $r_gp_value[$i]);
                      $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('center');
                      
                      $sheet->setCellValue('C'.$row, $r_tunjangan_value[$i]);
                      $sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('center');

                      

                      $sheet->setCellValue('D'.$row, $r_potongan_value[$i]);
                      $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('center');

                      $sheet->setCellValue('E'.$row, $r_angsuran_value[$i]);
                      $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('center');


                      $nominal = $r_gp_value[$i] + $r_position_value[$i] + $r_tunjangan_value[$i] - $r_potongan_value[$i] - $r_angsuran_value[$i] - $r_bpjs_value[$i];

                      $sum_nominal = $sum_nominal + $nominal;

                      $sheet->setCellValue('F'.$row, $nominal);
                      $sheet->getStyle('F'.$row)->getAlignment()->setHorizontal('center');


                          $alp='A';
                          $total_alp=5;
                          for($n=0;$n<=$total_alp;$n++)
                          {
                                $area = $alp.$row;
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $alp++;
                          }

                      $spreadsheet->getActiveSheet()
                                  ->getStyle('B'.$row.':H'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    }
                    
                    $row=$row+1;
                    $sheet->setCellValue('E'.$row, 'Total Gaji');
                      $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('center');

                    $sheet->setCellValue('F'.$row, $sum_nominal);
                      $sheet->getStyle('F'.$row)->getAlignment()->setHorizontal('center');

                    $spreadsheet->getActiveSheet()
                                  ->getStyle('B'.$row.':H'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);


                            
                        
                        $alp='A';
                        $total_alp=5;
                        for($n=0;$n<=$total_alp;$n++)
                        {
                              $area = $alp.$row;
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                              
                              $alp++;
                        }

               
                  }#end of data logic ==1


                    $row=$row+2;
                    $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':H'.$row);
                    $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setCellValue('A'.$row, 'BON & PINJAMAN');
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');

                    $row=$row+1;

                    $sheet->setCellValue('A'.$row, 'No. Faktur');
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


                    $sheet->setCellValue('B'.$row, 'Tanggal Transaksi');
                    $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('center');
                    
                    $sheet->setCellValue('C'.$row, 'Keterangan');
                    $sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('center');

                    $sheet->setCellValue('D'.$row, 'Nominal Faktur (Rp.)');
                    $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('center');

                    $sheet->setCellValue('E'.$row, 'Sudah dibayar (Rp.)');
                    $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('center');

                  

                    $sheet->setCellValue('F'.$row, 'Sisa Pinjaman (Rp.)');
                    $sheet->getStyle('F'.$row)->getAlignment()->setHorizontal('center');


                          $alp='A';
                          $total_alp=5;
                          for($n=0;$n<=$total_alp;$n++)
                          {
                                $area = $alp.$row;
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $alp++;
                          }


                  $sum_nominal_utang = 0;
                  $sum_sudah_bayar = 0;
                  $sum_sisa_utang = 0;

                  $read_select = $this->m_t_p_t_pinjaman->select_by_anggota_id($anggota_id);
                  foreach ($read_select as $key => $value) 
                  {
                    $row=$row+1;

                    $sheet->setCellValue('A'.$row, $value->INV);
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


                    $sheet->setCellValue('B'.$row, date('d-m-Y',strtotime($value->DATE)));
                    $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('center');
                    
                    $sheet->setCellValue('C'.$row, $value->KET);
                    $sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('center');

                    $sheet->setCellValue('D'.$row, $value->VALUE);
                    $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('center');
                    $sum_nominal_utang = $sum_nominal_utang + $value->VALUE;

                    $sudah_bayar = $value->VALUE - $value->SISA_VALUE;

                    $sum_sudah_bayar = $sum_sudah_bayar + $sudah_bayar;

                    $sheet->setCellValue('E'.$row, $sudah_bayar);
                    $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('center');

                    $sum_sisa_utang = $sum_sisa_utang + $value->SISA_VALUE;
                    $sheet->setCellValue('F'.$row, $value->SISA_VALUE);
                    $sheet->getStyle('F'.$row)->getAlignment()->setHorizontal('center');


                    $alp='A';
                          $total_alp=5;
                          for($n=0;$n<=$total_alp;$n++)
                          {
                                $area = $alp.$row;
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $alp++;
                          }

                    $spreadsheet->getActiveSheet()
                                  ->getStyle('C'.$row.':F'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);


                  }


                    $row=$row+1;

                  
                    
                    $sheet->setCellValue('C'.$row, 'Total');
                    $sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('center');

                    $sheet->setCellValue('D'.$row, $sum_nominal_utang);
                    $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('center');

                    $sheet->setCellValue('E'.$row, $sum_sudah_bayar);
                    $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('center');

                  

                    $sheet->setCellValue('F'.$row, $sum_sisa_utang);
                    $sheet->getStyle('F'.$row)->getAlignment()->setHorizontal('center');

                    $spreadsheet->getActiveSheet()
                                  ->getStyle('C'.$row.':F'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

                    $alp='A';
                        $total_alp=5;
                        for($n=0;$n<=$total_alp;$n++)
                        {
                              $area = $alp.$row;
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                              
                              $alp++;
                        }









                  $row=$row+2;


                  $sum_tunjangan_lain_lain = 0;


                  $logic_true = 0;
                  $read_select = $this->m_t_p_t_tunjangan_lain->select_by_anggota_id($anggota_id,$r_from_date);
                  foreach ($read_select as $key => $value) 
                  {
                    $logic_true=1;
                    $row=$row+1;

                    if($key==0)
                    {
                      $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                      $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':F'.$row);
                      $sheet = $spreadsheet->getActiveSheet();
                      $sheet->setCellValue('A'.$row, 'Tunjangan-Tunjangan');
                      $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');

                      $row=$row+1;

                      $sheet->setCellValue('A'.$row, 'No.');
                      $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


                      $sheet->setCellValue('B'.$row, 'Tanggal Transaksi');
                      $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('center');
                      
                      $sheet->setCellValue('C'.$row, 'Keterangan');
                      $sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('center');

                      $sheet->setCellValue('D'.$row, 'Nominal Tujangan (Rp.)');
                      $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('center');

                     


                          $alp='A';
                          $total_alp=3;
                          for($n=0;$n<=$total_alp;$n++)
                          {
                                $area = $alp.$row;
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $alp++;
                          }
                      $row=$row+1;
                    }

                    $sheet->setCellValue('A'.$row, ($key+1));
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


                    $sheet->setCellValue('B'.$row, date('d-m-Y',strtotime($value->DATE)));
                    $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('center');
                    
                    $sheet->setCellValue('C'.$row, $value->KET);
                    $sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('left');

                    $sheet->setCellValue('D'.$row, $value->VALUE);
                    $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('center');
                    
                    $sum_tunjangan_lain_lain = $sum_tunjangan_lain_lain + $value->VALUE;


                    $alp='A';
                          $total_alp=3;
                          for($n=0;$n<=$total_alp;$n++)
                          {
                                $area = $alp.$row;
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $alp++;
                          }

                    $spreadsheet->getActiveSheet()
                                  ->getStyle('C'.$row.':F'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);


                  }

                  if($logic_true==1)
                  {
                    $row=$row+1;

                  
                    
                    $sheet->setCellValue('C'.$row, 'Total');
                    $sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('center');

                    $sheet->setCellValue('D'.$row, $sum_tunjangan_lain_lain);
                    $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('center');


                    $spreadsheet->getActiveSheet()
                                  ->getStyle('C'.$row.':F'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

                    $alp='A';
                        $total_alp=3;
                        for($n=0;$n<=$total_alp;$n++)
                        {
                              $area = $alp.$row;
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                              
                              $alp++;
                        }
                  }



                  $row=$row+2;


                  $sum_potongan_lain_lain = 0;


                  $logic_true = 0;
                  $read_select = $this->m_t_p_t_potongan_lain->select_by_anggota_id($anggota_id,$r_from_date);
                  foreach ($read_select as $key => $value) 
                  {
                    $logic_true=1;
                    $row=$row+1;

                    if($key==0)
                    {
                      $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                      $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':F'.$row);
                      $sheet = $spreadsheet->getActiveSheet();
                      $sheet->setCellValue('A'.$row, 'Potongan-Potongan');
                      $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');

                      $row=$row+1;

                      $sheet->setCellValue('A'.$row, 'No.');
                      $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


                      $sheet->setCellValue('B'.$row, 'Tanggal Transaksi');
                      $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('center');
                      
                      $sheet->setCellValue('C'.$row, 'Keterangan');
                      $sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('center');

                      $sheet->setCellValue('D'.$row, 'Nominal Tujangan (Rp.)');
                      $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('center');

                     


                          $alp='A';
                          $total_alp=3;
                          for($n=0;$n<=$total_alp;$n++)
                          {
                                $area = $alp.$row;
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $alp++;
                          }
                      $row=$row+1;
                    }

                    $sheet->setCellValue('A'.$row, ($key+1));
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


                    $sheet->setCellValue('B'.$row, date('d-m-Y',strtotime($value->DATE)));
                    $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('center');
                    
                    $sheet->setCellValue('C'.$row, $value->KET);
                    $sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('left');

                    $sheet->setCellValue('D'.$row, $value->VALUE);
                    $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('center');
                    
                    $sum_potongan_lain_lain = $sum_potongan_lain_lain + $value->VALUE;


                    $alp='A';
                          $total_alp=3;
                          for($n=0;$n<=$total_alp;$n++)
                          {
                                $area = $alp.$row;
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $alp++;
                          }

                    $spreadsheet->getActiveSheet()
                                  ->getStyle('C'.$row.':F'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);


                  }

                  if($logic_true==1)
                  {
                    $row=$row+1;

                  
                    
                    $sheet->setCellValue('C'.$row, 'Total');
                    $sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('center');

                    $sheet->setCellValue('D'.$row, $sum_potongan_lain_lain);
                    $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('center');


                    $spreadsheet->getActiveSheet()
                                  ->getStyle('C'.$row.':F'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

                    $alp='A';
                        $total_alp=3;
                        for($n=0;$n<=$total_alp;$n++)
                        {
                              $area = $alp.$row;
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                              
                              $alp++;
                        }
                  }



                  $writer = new Xlsx($spreadsheet);
                  $filename = 'lap_slip_gaji';
                  
                  header('Content-Type: application/vnd.ms-excel');
                  header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                  header('Cache-Control: max-age=0');
      
                  $writer->save('php://output');
            }
      }
?>

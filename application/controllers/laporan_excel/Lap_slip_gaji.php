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

      class Lap_slip_gaji extends CI_Controller{

            public function __construct()
            {
                parent::__construct();

                $this->load->model('m_t_t_payroll');
                

            }



            public function index()
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
                  $spreadsheet = new Spreadsheet();

                  $alp='A';
                  $total_colom=5;
                  for($x=0;$x<=$total_colom;$x++)
                  {
                    $spreadsheet->getActiveSheet()
                          ->getColumnDimension($alp)
                          ->setAutoSize(true);
                    $last_colom_alp = $alp;
                    $alp++;
                  }


                  $row=1;

                  

                  $data_logic = 0;
                  $key=0;
                  $read_select = $this->m_t_t_payroll->select($from_date,$to_date);
                  foreach ($read_select as $key => $value) 
                  {   
                    $data_logic = 1;
                        $r_id[$key]=$value->ID;
                        $r_anggota[$key]=$value->ANGGOTA;
                        $r_from_date[$key]=$value->FROM_DATE;
                        $r_to_date[$key]=$value->TO_DATE;
                        $r_gp_value[$key]=$value->GP_VALUE;
                        $r_position_value[$key]=$value->POSITION_VALUE;
                        $r_tunjangan_value[$key]=$value->TUNJANGAN_VALUE;
                        $r_potongan_value[$key]=$value->POTONGAN_VALUE;
                        $r_angsuran_value[$key]=$value->ANGSURAN_VALUE;
                        $r_bpjs_value[$key]=$value->BPJS_VALUE;
                        $r_position[$key]=$value->POSITION;
                        $r_bank[$key]=$value->BANK;

                        $r_bank_account_number[$key]=$value->BANK_ACCOUNT_NUMBER;

                        $r_created_by[$key]=$value->CREATED_BY;
                        $r_updated_by[$key]=$value->UPDATED_BY;
                  }
                  $total_data = $key;



                  $sum_neto=0;
                  $sum_uang_jalan=0;
                  $sum_total_penjualan=0;

                  if($data_logic==1)
                  {
                  for($i=0;$i<=$total_data;$i++)
                  {

                    $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':E'.$row);
                    $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setCellValue('A'.$row, 'ACIEN GLOBAL INDONESIA');
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


                    $row=$row+1;
                    $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':E'.$row);
                    $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setCellValue('A'.$row, 'Slip Gaji Karyawan');
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');

                    $row=$row+1;
                    $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':E'.$row);
                    $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setCellValue('A'.$row, 'Dari '.date('d-m-Y', strtotime($from_date)).' Sampai '.date('d-m-Y', strtotime($to_date)));
                    $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');

                    


                    

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
                            $row=$row+1;
                            $sheet->setCellValue('A'.$row, 'Nama');
                            $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                            $sheet->setCellValue('B'.$row, $r_anggota[$i]);
                            $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('left');



                            $sheet->setCellValue('D'.$row, 'Metode Bayar');
                            $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('left');

                            $sheet->setCellValue('E'.$row, $r_bank[$i]);
                            $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('left');

                            $row=$row+1;
                            $sheet->setCellValue('A'.$row, 'Posisi');
                            $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                            $sheet->setCellValue('B'.$row, $r_position[$i]);
                            $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('left');

                            $sheet->setCellValue('D'.$row, 'No Rekening');
                            $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('left');

                            $sheet->setCellValue('E'.$row, $r_bank_account_number[$i]);
                            $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('left');


                            
                            $row=$row+1;
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

                        $row=$row+1;
                            $sheet->setCellValue('A'.$row, 'Gaji Pokok');
                            $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                            $sheet->setCellValue('B'.$row, $r_gp_value[$i]);
                            $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('left');



                            $sheet->setCellValue('D'.$row, 'Pot. Lain-Lain');
                            $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('left');

                            $sheet->setCellValue('E'.$row, $r_potongan_value[$i]);
                            $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('left');

                            $spreadsheet->getActiveSheet()
                                  ->getStyle('B'.$row.':E'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);


                        $row=$row+1;
                            $sheet->setCellValue('A'.$row, 'Tj. Posisi');
                            $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                            $sheet->setCellValue('B'.$row, $r_position_value[$i]);
                            $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('left');



                            $sheet->setCellValue('D'.$row, 'Pot. Angsuran');
                            $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('left');

                            $sheet->setCellValue('E'.$row, $r_angsuran_value[$i]);
                            $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('left');

                            $spreadsheet->getActiveSheet()
                                  ->getStyle('B'.$row.':E'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);


                        $row=$row+1;
                            $sheet->setCellValue('A'.$row, 'Tj. Lain-Lain');
                            $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                            $sheet->setCellValue('B'.$row, $r_tunjangan_value[$i]);
                            $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('left');



                            $sheet->setCellValue('D'.$row, 'Pot. BPJS');
                            $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('left');

                            $sheet->setCellValue('E'.$row, $r_bpjs_value[$i]);
                            $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('left');

                            $spreadsheet->getActiveSheet()
                                  ->getStyle('B'.$row.':E'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);



                            $row=$row+1;
                            $total_penghasilan = $r_gp_value[$i] + $r_position_value[$i] + $r_position_value[$i];
                            $total_potongan = $r_potongan_value[$i] + $r_angsuran_value[$i] + $r_bpjs_value[$i];
                            

                            $sheet->setCellValue('A'.$row, 'Total Penghasilan');
                            $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                            $sheet->setCellValue('B'.$row, $total_penghasilan);
                            $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('left');



                            $sheet->setCellValue('D'.$row, 'Total Potongan');
                            $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('left');

                            $sheet->setCellValue('E'.$row, $total_potongan);
                            $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('left');

                            $spreadsheet->getActiveSheet()
                                  ->getStyle('B'.$row.':E'.$row)
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



                        $row=$row+1;
                            $total_gaji = $total_penghasilan - $total_potongan;
                           
           



                            $sheet->setCellValue('D'.$row, 'Total Gaji');
                            $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('left');

                            $sheet->setCellValue('E'.$row, $total_gaji);
                            $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('left');

                            $spreadsheet->getActiveSheet()
                                  ->getStyle('B'.$row.':E'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

                        $alp='A';
                        $total_alp=5;
                        for($n=0;$n<=$total_alp;$n++)
                        {
                              $area = $alp.$row;
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                              
                              $alp++;
                        }

               


                          
                        
                        
                  }


                  
                        
                  

                  }#end of data logic ==1



                  $writer = new Xlsx($spreadsheet);
                  $filename = 'lap_slip_gaji';
                  
                  header('Content-Type: application/vnd.ms-excel');
                  header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                  header('Cache-Control: max-age=0');
      
                  $writer->save('php://output');
            }
      }
?>

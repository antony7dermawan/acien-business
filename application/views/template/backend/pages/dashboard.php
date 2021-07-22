<div class="pcoded-inner-content">
  <div class="main-body">
    <div class="page-wrapper">
      <div class="page-body">

        <div class="row">



<?php

$level_user_id = $this->session->userdata('level_user_id');


if($level_user_id==1 or $level_user_id==2)
{


?>

















          <!-- !-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>Rekap Seluruh Pembelian Harian

                <?= $this->session->flashdata('notif') ?>

                </h5>

                
              </div>
              <div class="card-block">
                <div class="dt-responsive table-responsive">
                  <table id="order-table" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>INV</th>
                        <th>Date</th>
                        <th>Ket</th>
                        <th>Supplier</th>
                        <th>INV Sp</th>
                        <th>Payment Method</th>
                        
                        <th>Total</th>
                        <th>Sudah Dibayar</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($c_t_t_t_pembelian as $key => $value) {
                        if($value->MARK_FOR_DELETE == 'f')
                        {
                          echo "<tr>";
                          echo "<td>" . ($key + 1) . "</td>";
                          echo "<td>" . $value->INV . "</td>";
                          echo "<td>" . date('d-m-Y', strtotime($value->DATE)) . " / " . date('H:i', strtotime($value->TIME)) . "</td>";
                          echo "<td>" . $value->KET . "</td>";
                          echo "<td>" . $value->SUPPLIER . "</td>";
                          echo "<td>" . $value->INV_SUPPLIER . "</td>";
                          echo "<td>" . $value->PAYMENT_METHOD . "</td>";



                          //satu button
                          echo "<td>";
                          echo "<a href='" . site_url('c_t_t_t_pembelian_rincian/index/' . $value->ID) . "' ";
                          echo "onclick=\"return confirm('Lanjut?')\"";
                          echo "> <i class='fa fa-search-plus text-c-blue'></i></a> ";
                          echo " Rp" . number_format(intval($value->SUM_SUB_TOTAL)) . "</td>";
                          //satu button


                          echo "<td>";

                          echo " Rp" . number_format(intval($value->PAYMENT_T)) . "</td>";
                          
                          echo "<td>";


                          if (intval($value->SUM_SUB_TOTAL) != 0)
                          {
                            echo "<a "; #/1 ini artinya kena pajak

                            echo "onclick= 'p_1_" . $key . "()'";
                       
                              echo "> <i class='fa fa-print text-c-black'></i></a> ";
                            
                            

                            echo "<script>";
                            echo "function p_1_" . $key . "()";
                            echo "{";
                            echo "window.open('laporan_pdf/c_t_t_t_pembelian_print/index/" . $value->ID . "');";
                            echo "}";
                            echo "</script>";

                            //echo " ".$value->UPDATED_BY;
                          }
                          



                          if ($value->SUM_SUB_TOTAL == 0) {
                            echo "<a href='javascript:void(0);' data-toggle='modal' data-target='#Modal_Edit' class='btn-edit' data-id='" . $value->ID . "'>";
                            echo "<i class='icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green'></i>";
                            echo "</a>";

                            echo "<a href='" . site_url('c_t_t_t_pembelian/delete/' . $value->ID) . "' ";

                            echo "onclick=\"return confirm('Apakah kamu yakin ingin menghapus data ini?')\"";


                            echo "> <i class='feather icon-trash-2 f-w-600 f-16 text-c-red'></i></a>";
                          }
                          echo "</td>";


                          echo "</tr>";
                        }









                        

                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>












          <!-- !-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>Rekap Seluruh Pemakaian Harian

                <?= $this->session->flashdata('notif') ?>

                </h5>

                
              </div>
              <div class="card-block">
                <div class="dt-responsive table-responsive">
                  <table id="order-table" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>INV</th>
                        <th>Date</th>
                        <th>Ket</th>
                        <th>Anggota</th>
                        <th>Payment Method</th>
                        <th>Total</th>

                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($c_t_t_t_pemakaian as $key => $value) {
                        if($value->MARK_FOR_DELETE == 'f')
                        {
                          echo "<tr>";
                          echo "<td>" . ($key + 1) . "</td>";
                          echo "<td>" . $value->INV_HEAD.$value->INV . "</td>";
                          echo "<td>" . date('d-m-Y', strtotime($value->DATE)) . " / " . date('H:i', strtotime($value->TIME)) . "</td>";
                          echo "<td>" . $value->KET . "</td>";
                          echo "<td>" . $value->ANGGOTA . "</td>";
                          echo "<td>" . $value->PAYMENT_METHOD . "</td>";



                          //satu button
                          echo "<td>";
                          echo "<a href='" . site_url('c_t_t_t_pemakaian_rincian/index/' . $value->ID) . "' ";
                          echo "onclick=\"return confirm('Lanjut?')\"";
                          echo "> <i class='fa fa-search-plus text-c-blue'></i></a> ";
                          echo " Rp" . number_format(intval($value->SUM_SUB_TOTAL)) . "</td>";
                          //satu button

                          
                          echo "<td>";


                          if (intval($value->SUM_SUB_TOTAL) != 0)
                          {
                            echo "<a "; #/1 ini artinya kena pajak

                            echo "onclick= 'p_1_" . $key . "()'";
                            if ($value->PRINTED == 'f') {
                              echo "> <i class='fa fa-print text-c-black'></i></a> ";
                            }
                            if ($value->PRINTED == 't') {
                              echo "> <i class='fa fa-print text-c-green'></i></a> ";
                            }

                            echo "<script>";
                            echo "function p_1_" . $key . "()";
                            echo "{";
                            echo "window.open('laporan_pdf/c_t_t_t_pemakaian_print/index/" . $value->ID . "');";
                            echo "}";
                            echo "</script>";





                            echo "<a "; #/1 ini artinya kena pajak

                            echo "onclick= 'p_2_" . $key . "()'";
                            if ($value->PRINTED == 'f') {
                              echo "> <i class='fa fa-print text-c-blue'></i></a> ";
                            }
                            if ($value->PRINTED == 't') {
                              echo "> <i class='fa fa-print text-c-green'></i></a> ";
                              
                            }

                            echo "<script>";
                            echo "function p_2_" . $key . "()";
                            echo "{";
                            echo "window.open('laporan_pdf/c_t_t_t_pemakaian2_print/index/" . $value->ID . "');";
                            echo "}";
                            echo "</script>";


                            if($value->ENABLE_EDIT==0)
                            {
                              echo "<a class='fa text-c-green'>Sudah Ditagih</a>";
                            }
                          }
                          



                          if ($value->SUM_SUB_TOTAL == 0) {
                            echo "<a href='javascript:void(0);' data-toggle='modal' data-target='#Modal_Edit' class='btn-edit' data-id='" . $value->ID . "'>";
                            echo "<i class='icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green'></i>";
                            echo "</a>";

                            echo "<a href='" . site_url('c_t_t_t_pemakaian/delete/' . $value->ID) . "' ";

                            echo "onclick=\"return confirm('Apakah kamu yakin ingin menghapus data ini?')\"";


                            echo "> <i class='feather icon-trash-2 f-w-600 f-16 text-c-red'></i></a>";
                          }
                          echo "</td>";


                          echo "</tr>";
                        }








                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>















<?php
}
?>



          


        </div>
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
                <h5>
                  Rekap Seluruh Pembelian Harian
                  <form action='<?php echo base_url("c_dashboard/search_date"); ?>' class='no_voucer_area' method="post" id=''>
                  <table>
                    <tr>

                      
                      <th>
                        <form action='/action_page.php'>
                          <input type='date' class='form-control' name='date_to_dashboard' value='<?php echo $this->session->userdata('date_to_dashboard'); ?>'>
                      </th>
                      <th>
                        <input type="submit" name="submit_date" class='btn btn-primary waves-effect waves-light' value="Search">
                      </th>
                    </tr>
                  </table>


                </form>

                  

                

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
                          
                          echo " Rp" . number_format(intval($value->SUM_SUB_TOTAL)) . "</td>";
                          //satu button


                          echo "<td>";

                          echo " Rp" . number_format(intval($value->PAYMENT_T)) . "</td>";
                          
                          


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
                          
                          echo " Rp" . number_format(intval($value->SUM_SUB_TOTAL)) . "</td>";
                          //satu button

                          
                          


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
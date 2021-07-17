<div class="pcoded-inner-content">
  <div class="main-body">
    <div class="page-wrapper">
      <div class="page-body">

        <div class="row">



<?php

$level_user_id = $this->session->userdata('level_user_id');


if($level_user_id==1)
{


?>








<div class="card">
  <div class="card-header">
    <h5>Rekap Seluruh Pembelian</h5>
      
            
          



  
  </div>



  
  <div class="card-block">
    <!-- Menampilkan notif !-->
    <?= $this->session->flashdata('notif') ?>
    <!-- Tombol untuk menambah data akun !-->
    

    <div class="table-responsive dt-responsive">
      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
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











          <!-- !-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>Rekap Transaksi Pelanggan

                <form action='<?php echo base_url("c_dashboard/search_date_1"); ?>' class='no_voucer_area' method="post" id=''>
                  <table>
                    <tr>

                      <th>
                        <form action='/action_page.php'>
                          <input type='date' class='form-control' name='date_from_dashboard_1' value='<?php echo $this->session->userdata('date_from_dashboard_1'); ?>'>
                      </th>
                      <th>-</th>
                      <th>
                        <form action='/action_page.php'>
                          <input type='date' class='form-control' name='date_to_dashboard_1' value='<?php echo $this->session->userdata('date_to_dashboard_1'); ?>'>
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
                        <th>Pelanggan</th>
                        <th>QTY</th>
                        <th>Total Penjualan</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($select_rekap_pelanggan as $key => $value) {
                       
                        
                        echo "<tr>";
                        echo "<td>" . ($key + 1) . "</td>";
                        echo "<td>" . $value->PELANGGAN . "</td>";
                        echo "<td>" . (round($value->SUM_QTY)) . "</td>";
                        echo "<td>" . number_format(round($value->SUM_SUB_TOTAL)) . "</td>";


                        /*
            echo "<td>";
              

              echo "<a href='".site_url('c_t_ak_terima_pelanggan_no_faktur/delete/' . $value->ID)."' ";
              
              echo "onclick=\"return confirm('Apakah kamu yakin ingin menghapus data ini?')\"";


              echo "> <i class='feather icon-trash-2 f-w-600 f-16 text-c-red'></i></a>";
            echo "</td>";

            echo "</tr>";
            */
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
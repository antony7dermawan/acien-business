<?php
$level_user_id = $this->session->userdata('level_user_id');
if($level_user_id==1 or $level_user_id==6)
{


?>

<div class="pcoded-inner-content">
  <div class="main-body">
    <div class="page-wrapper">
      <div class="page-body">

        <div class="row">


          <?php

          $total_box = 4;
          foreach ($c_setting_db_bank_coa as $key => $value) {
            $rmd = (float)($key / $total_box);
            $rmd = ($rmd - (int)$rmd) * $total_box;
            if ($rmd == 0) {
              $color = 'red';
            }
            if ($rmd == 1) {
              $color = 'blue';
            }
            if ($rmd == 2) {
              $color = 'green';
            }
            if ($rmd == 3) {
              $color = 'yellow';
            }
            if ($value->DB_K_ID == 1) {
              $read_saldo = $value->SUM_DEBIT - $value->SUM_KREDIT;
            }
            if ($value->DB_K_ID == 2) {
              $read_saldo = $value->SUM_KREDIT - $value->SUM_DEBIT;
            }


            echo "<div class='col-xl-3 col-md-6'>";
            echo "<div class='card prod-p-card card-" . $color . "'>";
            echo "<div class='card-body'>";
            echo "<div class='row align-items-center m-b-30'>";
            echo "<div class='col'>";

            echo "<h4 class='m-b-0 f-w-700 text-white'>  " . $value->NAMA_AKUN . "</h3>";
            echo "<br>";
            echo "<h6 class='m-b-5 text-white'>Rp" . number_format(intval($read_saldo)) . "</h6>";
            echo "</div>";
            echo "<div class='col-auto'>";
            echo "<i class='fas fa-money-bill-alt text-c-" . $color . " f-18'></i>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }
          ?>









          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>Invoice</h5>
                <span>List Tagihan Tagihan Pelanggan yang Belum Dibayarkan</span>

              </div>
              <div class="card-block">

                <div class="table-responsive dt-responsive">
                  <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>No Faktur</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Sudah Dibayarkan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($select_no_faktur as $key => $value)
                      {
                        echo "<tr>";
                        echo "<td>" . ($key + 1) . "</td>";
                        echo "<td>" . $value->PELANGGAN . "</td>";
                        echo "<td>" . $value->NO_FAKTUR . "</td>";
                        echo "<td>" . date('d-m-Y', strtotime($value->DATE)) . "</td>";
                        echo "<td>Rp" . number_format(round($value->SUM_TOTAL_PENJUALAN)) . "</td>";
                        echo "<td>Rp" . number_format(round($value->PAYMENT_T)) . "</td>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>













          


        </div>


  <?php
}
?>
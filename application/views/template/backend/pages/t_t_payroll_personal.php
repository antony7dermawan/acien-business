<div class="card">
  <div class="card-header">
    <h5>Transaksi Payroll Personal</h5>
  </div>
  <div class="card-block">
    <!-- Menampilkan notif !-->
    <?= $this->session->flashdata('notif') ?>
    
    <?php
    $month[0] = 'Januari';
    $month[1] = 'Febuari';
    $month[2] = 'Maret';
    $month[3] = 'April';
    $month[4] = 'Mei';
    $month[5] = 'Juni';
    $month[6] = 'Juli';
    $month[7] = 'Agustus';
    $month[8] = 'September';
    $month[9] = 'Oktober';
    $month[10] = 'November';
    $month[11] = 'Desember';


    $month_value[0] = 1;
    $month_value[1] = 2;
    $month_value[2] = 3;
    $month_value[3] = 4;
    $month_value[4] = 5;
    $month_value[5] = 6;
    $month_value[6] = 7;
    $month_value[7] = 8;
    $month_value[8] = 9;
    $month_value[9] = 10;
    $month_value[10] = 11;
    $month_value[11] = 12;

    $live_month = date('m');

    

    ?>

    <form action='<?php echo base_url("c_t_t_payroll_personal/change_data"); ?>' class='' method="post" id=''>
    <label>Pilih Kategori:</label>

    

    <label>Nama Anggota</label>
    <select name="anggota_id" class='custom_width' id='anggota_id' placeholder='Pick a state...'>
      <?php
      foreach ($c_t_p_personal as $key => $value) 
      {
       echo "<option value='".$value->ID."'>".$value->ANGGOTA."</option>";
      }
      ?>
    </select>
    <input type="submit" class="btn btn-primary waves-effect waves-light" name="update_button" value="Search">



    From : 

    <form action='/action_page.php'>
    <input type='date' name='date_from_payroll_personal' id='date_from_payroll_personal' value='<?= $this->session->userdata('date_from_payroll_personal') ?>'>

    <button type='button' class='btn btn-success' onclick='call_download()'>Download</button>
    </form>

    <br><br>

    <script type="text/javascript">
      function call_download() {
        var link_1 = 'laporan_excel/lap_beli_kredit/index/';
        var link_2 = document.getElementById("date_from_payroll_personal").value;
        var link_3 = parseInt(document.getElementById("anggota_id").value);
       
        var slash = "/";

        var link = link_1.concat(link_2, slash, link_3);
        window.open(link);
      }
    </script>
    

    <div class="table-responsive dt-responsive">
      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Anggota</th>
            <th>Gp</th>
            <th>Tj. Posisi</th>
            <th>Tj. Lain-Lain</th>

            <th>Sub Total</th>
            <th>Pot. Lain-Lain</th>
            <th>Pot. Angsuran</th>
            <th>Pot. BPJS</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($c_t_t_payroll as $key => $value) 
          {
            
              echo "<tr>";
              echo "<td>".($key+1)."</td>";
              echo "<td>".$value->FROM_DATE."</td>";
              echo "<td>".$value->TO_DATE."</td>";

              echo "<td>".$value->ANGGOTA."</td>";

              echo "<td>".number_format($value->GP_VALUE)."</td>";
              echo "<td>".number_format($value->POSITION_VALUE)."</td>";
              echo "<td>".number_format($value->TUNJANGAN_VALUE)."</td>";

              $sub_total = intval($value->GP_VALUE)+intval($value->POSITION_VALUE)+intval($value->TUNJANGAN_VALUE);
              echo "<td>".number_format($sub_total)."</td>";

              echo "<td>".number_format($value->POTONGAN_VALUE)."</td>";
              echo "<td>".number_format($value->ANGSURAN_VALUE)."</td>";
              echo "<td>".number_format($value->BPJS_VALUE)."</td>";
            
              $total = $sub_total - intval($value->POTONGAN_VALUE) - intval($value->ANGSURAN_VALUE) - intval($value->BPJS_VALUE);

              echo "<td>".number_format($total)."</td>";

              echo "</tr>";
           
            
            
            

          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>






<script type="text/javascript">
    $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>



<style type="text/css">
    div.searchable {
    width: 100%;
    
}

.searchable input {
    width: 100%;
    height: 30px;
    font-size: 14px;
    padding: 10px;
    -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
    -moz-box-sizing: border-box; /* Firefox, other Gecko */
    box-sizing: border-box; /* Opera/IE 8+ */
    display: block;
    font-weight: 400;
    line-height: 1.6;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    background: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E") no-repeat right .75rem center/8px 10px;
}


  .searchable ul {
    display: none;
    list-style-type: none;
    background-color: #fff;
    border-radius: 0 0 5px 5px;
    border: 1px solid #add8e6;
    border-top: none;
    max-height: 180px;
    margin: 0;
    overflow-y: scroll;
    overflow-x: hidden;
    padding: 0;
  }

  .searchable ul li {
    padding: 7px 9px;
    border-bottom: 1px solid #e1e1e1;
    cursor: pointer;
    color: #6e6e6e;
  }

  .searchable ul li.selected {
    background-color: #e8e8e8;
    color: #333;
  }
</style>



<script type="text/javascript">
    
    function filterFunction(that, event) {
    let container, input, filter, li, input_val;
    container = $(that).closest(".searchable");
    input_val = container.find("input").val().toUpperCase();

    if (["ArrowDown", "ArrowUp", "Enter"].indexOf(event.key) != -1) {
        keyControl(event, container)
    } else {
        li = container.find("ul li");
        li.each(function (i, obj) {
            if ($(this).text().toUpperCase().indexOf(input_val) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        container.find("ul li").removeClass("selected");
        setTimeout(function () {
            container.find("ul li:visible").first().addClass("selected");
        }, 100)
    }
}

function keyControl(e, container) {
    if (e.key == "ArrowDown") {

        if (container.find("ul li").hasClass("selected")) {
            if (container.find("ul li:visible").index(container.find("ul li.selected")) + 1 < container.find("ul li:visible").length) {
                container.find("ul li.selected").removeClass("selected").nextAll().not('[style*="display: none"]').first().addClass("selected");
            }

        } else {
            container.find("ul li:first-child").addClass("selected");
        }

    } else if (e.key == "ArrowUp") {

        if (container.find("ul li:visible").index(container.find("ul li.selected")) > 0) {
            container.find("ul li.selected").removeClass("selected").prevAll().not('[style*="display: none"]').first().addClass("selected");
        }
    } else if (e.key == "Enter") {
        container.find("input").val(container.find("ul li.selected").text()).blur();
        onSelect(container.find("ul li.selected").text())
    }

    container.find("ul li.selected")[0].scrollIntoView({
        behavior: "smooth",
    });
}



$(".searchable input").focus(function () {
    $(this).closest(".searchable").find("ul").show();
    $(this).closest(".searchable").find("ul li").show();
});
$(".searchable input").blur(function () {
    let that = this;
    setTimeout(function () {
        $(that).closest(".searchable").find("ul").hide();
    }, 300);
});

$(document).on('click', '.searchable ul li', function () {
    $(this).closest(".searchable").find("input").val($(this).text()).blur();
    onSelect($(this).text())
});

$(".searchable ul li").hover(function () {
    $(this).closest(".searchable").find("ul li.selected").removeClass("selected");
    $(this).addClass("selected");
});
</script>



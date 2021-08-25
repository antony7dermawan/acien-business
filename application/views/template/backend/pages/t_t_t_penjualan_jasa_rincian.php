<div class="card">
  <div class="card-header">
   
      <h5>
      <?php
      $level_user_id = $this->session->userdata('level_user_id');

      $disable_harga_jual = 'disabled';
      if($level_user_id==1)
      {
        $disable_harga_jual = '';
      }
      foreach ($c_t_t_t_penjualan_jasa_by_id as $key => $value) {
        $inv = $value->INV;
        $enable_edit = $value->ENABLE_EDIT;
      }


      echo 'No INV: '.$inv;
      ?>


      </h5>
   
  </div>
  <div class="card-block">
    <!-- Menampilkan notif !-->
    <?= $this->session->flashdata('notif') ?>

    <a href="<?= base_url("c_t_t_t_penjualan_jasa"); ?>" class="btn waves-effect waves-light btn-inverse"><i class="icofont icofont-double-left"></i>Back</a>
    <!-- Tombol untuk menambah data akun !-->
    <?php
    if($enable_edit==1)
    {
      echo "<button data-toggle='modal' data-target='#addModal' class='btn btn-success waves-effect waves-light'>New Data</button>";
    }
    ?>
    

    <div class="table-responsive dt-responsive">
      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No</th>

            <th>Produk</th>
            <th>Qty</th>
        
            <th>Harga</th>
            <th>Sub Total</th>

            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($c_t_t_t_penjualan_jasa_rincian as $key => $value) {

            if($value->MARK_FOR_DELETE == 'f')
            {
              echo "<tr>";
              echo "<td>" . ($key + 1) . "</td>";
              echo "<td>" . $value->PRODUK . "</td>";
              
              echo "<td>" . number_format($value->QTY, 2, '.', ',') . "</td>";

             

              echo "<td>" . number_format($value->HARGA, 2, '.', ',') . "</td>";
              echo "<td>" . number_format($value->SUB_TOTAL, 2, '.', ',') . "</td>";

              
              echo "<td>";
              
               
              if( $enable_edit==1)
              {
                echo "<a href='".site_url('c_t_t_t_penjualan_jasa_rincian/delete/'.$value->ID.'/'.$penjualan_jasa_id)."' ";
                echo "onclick=\"return confirm('Apakah kamu yakin ingin menghapus data ini?')\"";


                echo "> <i class='feather icon-trash-2 f-w-600 f-16 text-c-red'></i></a>";
              }
                
             
              echo "</td>";


              echo "</tr>";
            }


            if($value->MARK_FOR_DELETE == 't')
            {
              echo "<tr>";
              echo "<td><s>" . ($key + 1) . "</s></td>";
            
              echo "<td><s>" . $value->PRODUK . "</s></td>";
              
              echo "<td><s>" . number_format($value->QTY, 2, '.', ',') . "</s></td>";

             


              echo "<td><s>" . number_format($value->HARGA, 2, '.', ',') . "</s></td>";
              echo "<td><s>" . number_format($value->SUB_TOTAL, 2, '.', ',') . "</s></td>";

              
              echo "<td>";
             
                echo "<a";
               
                echo "> <i class='fa fa-refresh f-w-600 f-16 text-c-red'></i></a>";

                echo ' '.$value->UPDATED_BY;
              
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









<!-- MODAL TAMBAH PEMASUKAN! !-->
<form action="<?php echo base_url('c_t_t_t_penjualan_jasa_rincian/tambah/'.$penjualan_jasa_id) ?>" method="post" id='add_data'>
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Data
            
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          
        

        <div class="form-group">
            <label>Nama Produk</label>
            <input type='text' class='form-control' placeholder=''  name='produk'>
        </div>



        <div class="row">
          <div class="col-md-6">

            <fieldset class="form-group">
              <label>QTY</label> <a id='sisa_qty_id'></a>
              <input type='text' class='form-control' id='qty_id' placeholder='Input Number' name='qty'>
            </fieldset>
          </div> <!-- Membungkus Row !-->

          <div class="col-md-6">
            <fieldset class="form-group">
              <label>Harga Jual</label>
              <input type='text' class='form-control' placeholder='' id='harga_jual_id' name='harga_jual' >
            </fieldset>
          </div><!-- Membungkus Row Kedua !-->
        </div>


        <div class="row">
          <div class="col-md-6">

            <fieldset class="form-group">
              <label>Satuan</label>
              <select name="satuan_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
              <?php
              foreach ($c_t_m_d_satuan as $key => $value) 
              {
                echo "<option value='".$value->ID."'>".$value->SATUAN."</option>";

              }
              ?>
              </select>
            </fieldset>
          </div> <!-- Membungkus Row !-->

          <div class="col-md-6">
            <fieldset class="form-group">
              <label>Sub Total</label>
              <input type='text' class='form-control' id='sub_total_id' placeholder='' name='sub_total' >
            </fieldset>
          </div><!-- Membungkus Row Kedua !-->
        </div>





       



        </div>

          <div class="modal-footer">






            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary waves-effect waves-light ">Save changes</button>
          </div>



      </div>
    </div>
  </div>

  

</script>
<script type="text/javascript">

  


mycode();

function mycode() {
  
  

  var qty = document.getElementById("qty_id").value;
  var harga_jual = document.getElementById("harga_jual_id").value;

  var sub_total_3 = (qty*harga_jual);
  

  var bilangan = sub_total_3;
  
  var number_string = bilangan.toString(),
    sisa  = number_string.length % 3,
    rupiah  = number_string.substr(0, sisa),
    ribuan  = number_string.substr(sisa).match(/\d{3}/g);
      
  if (ribuan) {
    separator = sisa ? ',' : '';
    rupiah += separator + ribuan.join(',');
  }

  // Cetak hasil


  document.getElementById("sub_total_id").value = rupiah;
  if (qty>document.getElementById("sisa_qty_id").text)
  {
    console.log('gagal');
  }



  tid = setTimeout(mycode, 500); // repeat myself
}



</script>


</form>
<!-- MODAL TAMBAH PEMASUKAN SELESAI !-->









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
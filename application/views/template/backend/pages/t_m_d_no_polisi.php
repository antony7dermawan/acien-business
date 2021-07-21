<div class="card">
  <div class="card-header">
    <h5>Master No Polisi</h5>
  </div>
  <div class="card-block">
    <!-- Menampilkan notif !-->
    <?= $this->session->flashdata('notif') ?>
    <!-- Tombol untuk menambah data akun !-->
    <button data-toggle="modal" data-target="#addModal" class="btn btn-success waves-effect waves-light">New Data</button>

    <div class="table-responsive dt-responsive">
      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No</th>
            <th>No Polisi</th>
            <th>STNK</th>
            <th>KIR</th>
            <th>Service</th>
            <th>Angsuran</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no_polisi_notif = 0;
          $date_plus_7 = date('Y-m-d',(strtotime ( '+7 day' , strtotime (date('Y-m-d')) ) ));
          foreach ($c_t_m_d_no_polisi as $key => $value) 
          {
            if($value->MARK_FOR_DELETE == 'f')
            {
              echo "<tr>";
              echo "<td>".($key + 1)."</td>";
              echo "<td>".$value->NO_POLISI."</td>";
              
              if(strtotime($value->STNK)>strtotime($date_plus_7))
              {
                echo "<td>" . date('d-m-Y', strtotime($value->STNK)) . "</td>";
              }
              if(strtotime($value->STNK)<=strtotime($date_plus_7))
              {
                echo "<td class='text-c-red'>" . date('d-m-Y', strtotime($value->STNK)) . "</td>";
                $no_polisi_notif = $no_polisi_notif +1;
                $this->session->set_userdata('no_polisi_notif', $no_polisi_notif);
              }

              if(strtotime($value->KIR)>strtotime($date_plus_7))
              {
                echo "<td>" . date('d-m-Y', strtotime($value->KIR)) . "</td>";
              }
              if(strtotime($value->KIR)<=strtotime($date_plus_7))
              {
                echo "<td class='text-c-red'>" . date('d-m-Y', strtotime($value->KIR)) . "</td>";
                $no_polisi_notif = $no_polisi_notif +1;
                $this->session->set_userdata('no_polisi_notif', $no_polisi_notif);
              }

              if(strtotime($value->SERVICE)>strtotime($date_plus_7))
              {
                echo "<td>" . date('d-m-Y', strtotime($value->SERVICE)) . "</td>";
              }
              if(strtotime($value->SERVICE)<=strtotime($date_plus_7))
              {
                echo "<td class='text-c-red'>" . date('d-m-Y', strtotime($value->SERVICE)) . "</td>";
                $no_polisi_notif = $no_polisi_notif +1;
                $this->session->set_userdata('no_polisi_notif', $no_polisi_notif);
              }

              if(strtotime($value->ANGSURAN)>strtotime($date_plus_7))
              {
                echo "<td>" . date('d-m-Y', strtotime($value->ANGSURAN)) . "</td>";
              }
              if(strtotime($value->ANGSURAN)<=strtotime($date_plus_7))
              {
                echo "<td class='text-c-red'>" . date('d-m-Y', strtotime($value->ANGSURAN)) . "</td>";
                $no_polisi_notif = $no_polisi_notif +1;
                $this->session->set_userdata('no_polisi_notif', $no_polisi_notif);
              }
              
              


              echo "<td>";
               
              echo "<a href='javascript:void(0);' data-toggle='modal' data-target='#Modal_Edit' class='btn-edit' data-id='".$value->ID."'>";
                echo "<i class='icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green'></i>";
              echo "</a>";

              echo "<a href='".site_url('c_t_m_d_no_polisi/delete/' . $value->ID)."' ";
              ?>
              onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')"
              <?php
              echo "> <i class='feather icon-trash-2 f-w-600 f-16 text-c-red'></i></a>";

              echo "</td>";


              echo "</tr>";
            }

            if($value->MARK_FOR_DELETE == 't')
            {
              echo "<tr>";
              echo "<td><s>".($key + 1)."</s></td>";
              echo "<td><s>".$value->NO_POLISI."</s></td>";
              
              echo "<td><s>" . date('d-m-Y', strtotime($value->STNK)) . "<s></td>";
              echo "<td><s>" . date('d-m-Y', strtotime($value->KIR)) . "<s></td>";
              echo "<td><s>" . date('d-m-Y', strtotime($value->SERVICE)) . "<s></td>";
              echo "<td><s>" . date('d-m-Y', strtotime($value->ANGSURAN)) . "<s></td>";


              echo "<td>";
               
              

              echo "<a href='".site_url('c_t_m_d_no_polisi/undo_delete/' . $value->ID)."' ";
              ?>
              onclick="return confirm('Apakah kamu yakin ingin mengembalikan data ini?')"
              <?php
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




<!-- MODAL TAMBAH Beban! !-->
<form action="<?php echo base_url('c_t_m_d_no_polisi/tambah') ?>" method="post">
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="">


            <div class="form-group">
              <label>No Polisi</label>
              <input type='text' class='form-control' placeholder='Input Text' name='no_polisi'>
            </div>


            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>STNK</label>
                  <form action='/action_page.php'>
                  <input type='date' class='form-control' name='stnk' value=''>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>KIR</label>
                  <form action='/action_page.php'>
                  <input type='date' class='form-control' name='kir' value=''>
              </div> <!-- Membungkus Row !-->
            </div>


            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Service</label>
                  <form action='/action_page.php'>
                  <input type='date' class='form-control' name='service' value=''>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Angsuran</label>
                  <form action='/action_page.php'>
                  <input type='date' class='form-control' name='angsuran' value=''>
              </div> <!-- Membungkus Row !-->
            </div>

            

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary waves-effect waves-light ">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- MODAL TAMBAH AKUN! SELESAI !-->


<!-- MODAL EDIT AKUN !-->
<div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form action="<?php echo base_url('c_t_m_d_no_polisi/edit_action') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="">

            <input type="hidden" name="id" value="" class="form-control">


            <div class="form-group">
              <label>No Polisi</label>
              <input type='text' class='form-control' placeholder='Input Text' name='no_polisi'>
            </div>


            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>STNK</label>
                  <form action='/action_page.php'>
                  <input type='date' class='form-control' name='stnk' value=''>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>KIR</label>
                  <form action='/action_page.php'>
                  <input type='date' class='form-control' name='kir' value=''>
              </div> <!-- Membungkus Row !-->
            </div>


            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Service</label>
                  <form action='/action_page.php'>
                  <input type='date' class='form-control' name='service' value=''>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Angsuran</label>
                  <form action='/action_page.php'>
                  <input type='date' class='form-control' name='angsuran' value=''>
              </div> <!-- Membungkus Row !-->
            </div>


          </div>
          <div class="modal-footer">
            <div class="created_form">
              Created By : <a name='created_by'></a>
              <br>
              Updated By : <a name='updated_by'></a>
            </div>
            <style type="text/css">
              .created_form
              {
                float: left;
                margin right: : 20px;
                font-size: 10px;
              }
            </style>
            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary waves-effect waves-light ">Save changes</button>
          </div>

        </div>


<script>
  const users = <?= json_encode($c_t_m_d_no_polisi) ?>;
  console.log(users);
  let elModalEdit = document.querySelector("#Modal_Edit");
  console.log(elModalEdit);
  let elBtnEdits = document.querySelectorAll(".btn-edit");
  [...elBtnEdits].forEach(edit => {
    edit.addEventListener("click", (e) => {
      let id = edit.getAttribute("data-id");
      let User = users.filter(user => {
        if (user.ID == id)
          return user;
      });
      const {
        ID,
        NO_POLISI : no_polisi,

        KIR : kir,
        STNK : stnk,
        SERVICE : service,
        ANGSURAN : angsuran,

        CREATED_BY : created_by,
        UPDATED_BY : updated_by
      } = User[0];

      elModalEdit.querySelector("[name=id]").value = ID;
      elModalEdit.querySelector("[name=no_polisi]").value = no_polisi;

      elModalEdit.querySelector("[name=kir]").value = kir;
      elModalEdit.querySelector("[name=stnk]").value = stnk;
      elModalEdit.querySelector("[name=service]").value = service;
      elModalEdit.querySelector("[name=angsuran]").value = angsuran;

      elModalEdit.querySelector("[name=created_by]").text = created_by;
      elModalEdit.querySelector("[name=updated_by]").text = updated_by;

    })
  })
</script>

    </form>
  </div>
</div>
<!-- MODAL EDIT AKUN! SELESAI !-->


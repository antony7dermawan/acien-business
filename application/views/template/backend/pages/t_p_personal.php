<div class="card">
  <div class="card-header">
    <h5>Master Personal</h5>
  </div>
  <div class="card-block">
    <!-- Menampilkan notif !-->
    <?= $this->session->flashdata('notif') ?>
    
    <button data-toggle="modal" data-target="#addModal" class="btn btn-success waves-effect waves-light">New Data</button> 

    <div class="table-responsive dt-responsive">
      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>Personal</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($c_t_p_personal as $key => $value) 
          {
            if($value->MARK_FOR_DELETE == 'f')
            {
              echo "<tr>";
              echo "<td>".$value->ID."</td>";
              echo "<td>".$value->ANGGOTA."</td>";
            
              echo "<td>";
               
              echo "<a href='javascript:void(0);' data-toggle='modal' data-target='#Modal_Edit' class='btn-edit' data-id='".$value->ID."'>";
                echo "<i class='icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green'></i>";
              echo "</a>";

              echo "<a href='".site_url('c_t_p_personal/delete/' . $value->ID)."' ";
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
              echo "<td><s>".$value->PERSONAL."</s></td>";
            
              echo "<td>";
               
              

              echo "<a href='".site_url('c_t_p_personal/undo_delete/' . $value->ID)."' ";
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
<form action="<?php echo base_url('c_t_p_personal/tambah') ?>" method="post">
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
              <label>Nama Anggota</label>
              <input type='text' class='form-control' placeholder='Input Text' name='anggota'>
            </div>

            
            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>DOB</label>
                  <form action='/action_page.php'>
                  <input type='date' class='form-control' name='dob' value=''>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Tempat Lahir</label>
                  <input type='text' class='form-control' placeholder='Input Text' name='pob' value=''>  
                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>



            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Joined Date</label>
                  <form action='/action_page.php'>
                  <input type='date' class='form-control' name='joined_date' value=''>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  
                  
                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>




            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Religion</label>
                  <select name="religion_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                  <?php
                  foreach ($c_t_p_religion as $key => $value) 
                  {
                    echo "<option value='".$value->ID."'>".$value->RELIGION."</option>";

                  }
                  ?>
                  </select>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Gender</label>
                  <select name="gender_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                  <?php
                  foreach ($c_t_p_gender as $key => $value) 
                  {
                    echo "<option value='".$value->ID."'>".$value->GENDER."</option>";

                  }
                  ?>
                  </select>
                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>



            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Marital</label>
                  <select name="marital_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                  <?php
                  foreach ($c_t_p_marital as $key => $value) 
                  {
                    echo "<option value='".$value->ID."'>".$value->MARITAL."</option>";

                  }
                  ?>
                  </select>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Permanen</label>
                  <select name="permanen_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                  <?php
                  foreach ($c_t_p_permanen as $key => $value) 
                  {
                    echo "<option value='".$value->ID."'>".$value->PERMANEN."</option>";

                  }
                  ?>
                  </select>
                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>




            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Departmen</label>
                  <select name="departmen_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                  <?php
                  foreach ($c_t_p_departmen as $key => $value) 
                  {
                    echo "<option value='".$value->ID."'>".$value->DEPARTMEN."</option>";

                  }
                  ?>
                  </select>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>NIK</label>
                  <input type='text' class='form-control' placeholder='Input Text' name='nik_ktp' value=''>
                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>










            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Email</label>
                  <input type='text' class='form-control' placeholder='Input Text' name='email' value=''>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Alamat</label>
                  <input type='text' class='form-control' placeholder='Input Text' name='address' value=''>  
                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>



            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>No Hp</label>
                  <input type='text' class='form-control' placeholder='Input Text' name='phone_number' value=''>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Posisi</label>
                  <select name="position_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                  <?php
                  foreach ($c_t_p_position as $key => $value) 
                  {
                    echo "<option value='".$value->ID."'>".$value->POSITION."</option>";

                  }
                  ?>
                  </select>
                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>



            <div class="row">
              <div class="col-md-6">
                <fieldset class="form-group">
                  <label>BANK</label>
                  <select name="bank_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                  <?php
                  foreach ($c_t_p_bank as $key => $value) 
                  {
                    echo "<option value='".$value->ID."'>".$value->BANK."</option>";

                  }
                  ?>
                  </select>
                </fieldset>
              </div> <!-- Membungkus Row !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Bank Acc Number</label>
                  <input type='text' class='form-control' placeholder='Input Text' name='bank_account_number' value=''>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->
            </div>





            <div class="row">
              <div class="col-md-6">
                <fieldset class="form-group">
                  <label>BPJS TK</label>
                  <select name="bpjs_tk_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                  <?php
                  foreach ($c_t_p_bpjs_tk as $key => $value) 
                  {
                    echo "<option value='".$value->ID."'>".$value->BPJS_TK."</option>";

                  }
                  ?>
                  </select>
                </fieldset>
              </div> <!-- Membungkus Row !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>BPJS KES</label>
                  <select name="bpjs_kes_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                  <?php
                  foreach ($c_t_p_bpjs_kes as $key => $value) 
                  {
                    echo "<option value='".$value->ID."'>".$value->BPJS_KES."</option>";

                  }
                  ?>
                  </select>
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
  </div>
</form>
<!-- MODAL TAMBAH AKUN! SELESAI !-->


<!-- MODAL EDIT AKUN !-->
<div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form action="<?php echo base_url('c_t_p_personal/edit_action') ?>" method="post">
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
              <label>Nama Anggota</label>
              <input type='text' class='form-control' placeholder='Input Text' name='anggota'>
            </div>

            
            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>DOB</label>
                  <form action='/action_page.php'>
                  <input type='date' class='form-control' name='dob' value=''>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Tempat Lahir</label>
                  <input type='text' class='form-control' placeholder='Input Text' name='pob' value=''>  
                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>



            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Joined Date</label>
                  <form action='/action_page.php'>
                  <input type='date' class='form-control' name='joined_date' value=''>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Resigned Date</label>
                  <form action='/action_page.php'>
                  <input type='date' class='form-control' name='resigned_date' value=''>
                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>




            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Religion</label>
                  

                  <div class="searchable">
                  <input type="text" name='religion' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_p_religion as $key => $value) 
                    {
                      echo "<li>".$value->RELIGION."</li>";
                    }
                    ?>
                  </ul>
                  </div>

                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Gender</label>
                  

                  <div class="searchable">
                  <input type="text" name='gender' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_p_gender as $key => $value) 
                    {
                      echo "<li>".$value->GENDER."</li>";
                    }
                    ?>
                  </ul>
                  </div>

                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>



            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Marital</label>
                  <div class="searchable">
                  <input type="text" name='marital' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_p_marital as $key => $value) 
                    {
                      echo "<li>".$value->MARITAL."</li>";
                    }
                    ?>
                  </ul>
                  </div>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Permanen</label>
                  <div class="searchable">
                  <input type="text" name='permanen' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_p_permanen as $key => $value) 
                    {
                      echo "<li>".$value->PERMANEN."</li>";
                    }
                    ?>
                  </ul>
                  </div>

                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>




            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Departmen</label>
                  
                  <div class="searchable">
                  <input type="text" name='departmen' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_p_departmen as $key => $value) 
                    {
                      echo "<li>".$value->DEPARTMEN."</li>";
                    }
                    ?>
                  </ul>
                  </div>

                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>NIK</label>
                  <input type='text' class='form-control' placeholder='Input Text' name='nik_ktp' value=''>
                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>










            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Email</label>
                  <input type='text' class='form-control' placeholder='Input Text' name='email' value=''>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Alamat</label>
                  <input type='text' class='form-control' placeholder='Input Text' name='address' value=''>  
                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>



            <div class="row">
              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>No Hp</label>
                  <input type='text' class='form-control' placeholder='Input Text' name='phone_number' value=''>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Posisi</label>
                  

                  <div class="searchable">
                  <input type="text" name='position' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_p_position as $key => $value) 
                    {
                      echo "<li>".$value->POSITION."</li>";
                    }
                    ?>
                  </ul>
                  </div>


                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>



            <div class="row">
              <div class="col-md-6">
                <fieldset class="form-group">
                  <label>BANK</label>
                
                  <div class="searchable">
                  <input type="text" name='bank' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_p_bank as $key => $value) 
                    {
                      echo "<li>".$value->BANK."</li>";
                    }
                    ?>
                  </ul>
                  </div>

                </fieldset>
              </div> <!-- Membungkus Row !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Bank Acc Number</label>
                  <input type='text' class='form-control' placeholder='Input Text' name='bank_account_number' value=''>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->
            </div>





            <div class="row">
              <div class="col-md-6">
                <fieldset class="form-group">
                  <label>BPJS TK</label>
                  
                  <div class="searchable">
                  <input type="text" name='bpjs_tk' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_p_bpjs_tk as $key => $value) 
                    {
                      echo "<li>".$value->BPJS_TK."</li>";
                    }
                    ?>
                  </ul>
                  </div>

                </fieldset>
              </div> <!-- Membungkus Row !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>BPJS KES</label>
                  

                  <div class="searchable">
                  <input type="text" name='bpjs_kes' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_p_bpjs_kes as $key => $value) 
                    {
                      echo "<li>".$value->BPJS_KES."</li>";
                    }
                    ?>
                  </ul>
                  </div>

                </fieldset>

              </div><!-- Membungkus Row Kedua !-->
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
  const users = <?= json_encode($c_t_p_personal) ?>;
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
        ANGGOTA : anggota,

        DOB : dob,
        POB : pob,
        JOINED_DATE : joined_date,
        RESIGNED_DATE : resigned_date,
        RELIGION : religion,
        GENDER : gender,
        MARITAL : marital,
        PERMANEN : permanen,
        DEPARTMEN : departmen,
        NIK_KTP : nik_ktp,
        EMAIL : email,
        ADDRESS : address,
        PHONE_NUMBER : phone_number,
        BANK : bank,
        BANK_ACCOUNT_NUMBER : bank_account_number,
        POSITION : position,
        BPJS_TK : bpjs_tk,
        BPJS_KES : bpjs_kes,


        CREATED_BY : created_by,
        UPDATED_BY : updated_by
      } = User[0];

      elModalEdit.querySelector("[name=id]").value = ID;
      elModalEdit.querySelector("[name=anggota]").value = anggota;

      elModalEdit.querySelector("[name=dob]").value = dob;
      elModalEdit.querySelector("[name=pob]").value = pob;
      elModalEdit.querySelector("[name=joined_date]").value = joined_date;
      elModalEdit.querySelector("[name=resigned_date]").value = resigned_date;
      elModalEdit.querySelector("[name=religion]").value = religion;
      elModalEdit.querySelector("[name=gender]").value = gender;
      elModalEdit.querySelector("[name=marital]").value = marital;
      elModalEdit.querySelector("[name=permanen]").value = permanen;
      elModalEdit.querySelector("[name=departmen]").value = departmen;
      elModalEdit.querySelector("[name=nik_ktp]").value = nik_ktp;
      elModalEdit.querySelector("[name=email]").value = email;
      elModalEdit.querySelector("[name=address]").value = address;
      elModalEdit.querySelector("[name=phone_number]").value = phone_number;
      elModalEdit.querySelector("[name=bank]").value = bank;
      elModalEdit.querySelector("[name=bank_account_number]").value = bank_account_number;
      elModalEdit.querySelector("[name=position]").value = position;
      elModalEdit.querySelector("[name=bpjs_tk]").value = bpjs_tk;
      elModalEdit.querySelector("[name=bpjs_kes]").value = bpjs_kes;


      elModalEdit.querySelector("[name=created_by]").text = created_by;
      elModalEdit.querySelector("[name=updated_by]").text = updated_by;

    })
  })
</script>

    </form>
  </div>
</div>
<!-- MODAL EDIT AKUN! SELESAI !-->















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
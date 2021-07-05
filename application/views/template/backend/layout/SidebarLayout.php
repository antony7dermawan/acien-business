<div class="pcoded-navigation-label">Navigation</div>
<ul class="pcoded-item pcoded-left-item">


    




<li class="pcoded-hasmenu"> <!-- batas buka 3 tingkat!-->
<a href="javascript:void(0)" class="waves-effect waves-dark">
<span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
<span class="pcoded-mtext">Inventory</span>

</a>
<ul class="pcoded-submenu"> <!-- batas buka 3 tingkat!-->






<!-- Diluar Grouping disini -->
<li <?php if($this->uri->segment(2)=="buku_besar"){echo 'class="pcoded-hasmenu"';}?>>
        <a href="<?= base_url("c_dashboard/"); ?>" class="waves-effect waves-dark">
        <span class="pcoded-micon">
        <i class="feather icon-credit-card"></i>
        </span>
        <span class="pcoded-mtext">Dashboard</span>
        </a>
</li>





<?php
$level_user_id = $this->session->userdata('level_user_id');
if($level_user_id==1)
{
    ?>
    

    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
            <span class="pcoded-mtext" href="<?= base_url("c_t_login_user"); ?>">Master Data</span>
        </a>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_t_m_d_company"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Company</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_m_d_level_user"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Level User</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_m_d_jenis_barang"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Jenis Barang</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_m_d_kategori"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Kategori</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_m_d_barang"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Barang</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_m_d_satuan"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Satuan</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_m_d_no_polisi"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">No Polisi</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_m_d_supir"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Nama Supir</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_m_d_sales"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Nama Sales</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_m_d_supplier"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Nama Supplier</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_m_d_pelanggan"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Nama Pelanggan</span>
                </a>
            </li>

            <li class="">
                <a href="<?= base_url("c_t_m_d_payment_method"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Payment Method</span>
                </a>
            </li>

            <li class="">
                <a href="<?= base_url("c_t_m_d_lokasi"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Lokasi</span>
                </a>
            </li>

        </ul>
    </li>


<?php

}

?>




    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-list"></i></span>
            <span class="pcoded-mtext">Transaksi</span>
        </a>
        <ul class="pcoded-submenu">


            <?php

            if($level_user_id==1 or $level_user_id==2 or $level_user_id==3)
            {

            ?>
            <li class="">
                <a href="<?= base_url("c_t_t_t_pembelian"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Pembelian</span>
                </a>
            </li>


            <li class="">
                <a href="<?= base_url("c_t_t_t_retur_pembelian"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Retur Pembelian</span>
                </a>
            </li>


            <li class="">
                <a href="<?= base_url("c_t_t_t_po_auto"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">PO Auto</span>
                </a>
            </li>
            
            <li class="">
                <a href="<?= base_url("c_t_t_t_po_manual"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">PO Manual</span>
                </a>
            </li>

            <li class="">
                <a href="<?= base_url("c_t_t_t_pinlok_in"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Pinlok In</span>
                </a>
            </li>
            


            <?php
            }
            if($level_user_id==1 or $level_user_id==2 or $level_user_id==4)
            {

            ?>
            <li class="">
                <a href="<?= base_url("c_t_t_t_penjualan"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Penjualan Barang</span>
                </a>
            </li>

            <li class="">
                <a href="<?= base_url("c_t_t_t_retur_penjualan"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Retur Penjualan Barang</span>
                </a>
            </li>


            <li class="">
                <a href="<?= base_url("c_t_t_t_penjualan_jasa"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Penjualan Jasa</span>
                </a>
            </li>




            <li class="">
                <a href="<?= base_url("c_t_t_t_pemakaian"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Pemakaian</span>
                </a>
            </li>

            <li class="">
                <a href="<?= base_url("c_t_t_t_retur_pemakaian"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Retur Pemakaian</span>
                </a>
            </li>




            <li class="">
                <a href="<?= base_url("c_t_t_t_pinlok_out"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Pinlok Out</span>
                </a>
            </li>

            <?php
            }
            

            ?>



            


            <li class="">
                <a href="<?= base_url("c_t_info_stock"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Info Stock</span>
                </a>
            </li>

            


        </ul>
    </li>








    
<?php
if($level_user_id==1)
{
    ?>
    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
            <span class="pcoded-mtext">Admin</span>
        </a>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_t_login_user"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">User</span>
                </a>
            </li>
            
        </ul>
    </li>


    
    <?php
}

?>


<?php
if($level_user_id==1 )
{
    ?>
    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
            <span class="pcoded-mtext">Laporan</span>
        </a>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_laporan"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Detail</span>
                </a>
            </li>
            
        </ul>
    </li>


    
    <?php
}

?>


</ul> <!-- batas buka 3 tingkat!-->
</li> <!-- batas buka 3 tingkat!-->






    
    









<li class="pcoded-hasmenu"> <!-- batas buka 3 tingkat!-->
<a href="javascript:void(0)" class="waves-effect waves-dark">
<span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
<span class="pcoded-mtext">Finance</span>

</a>
<ul class="pcoded-submenu"> <!-- batas buka 3 tingkat!-->







<!-- Diluar Grouping disini -->
    <li <?php if($this->uri->segment(2)=="buku_besar"){echo 'class="pcoded-hasmenu"';}?>>
        <a href="<?= base_url("c_dashboard2/"); ?>" class="waves-effect waves-dark">
        <span class="pcoded-micon">
        <i class="feather icon-credit-card"></i>
        </span>
        <span class="pcoded-mtext">Dashboard</span>
        </a>
    </li>


<?php
$level_user_id = $this->session->userdata('level_user_id');
if($level_user_id==1 or $level_user_id==6)
{
    ?>
    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
            <span class="pcoded-mtext" href="<?= base_url("c_t_login_user"); ?>">Setting Dashboard</span>
        </a>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_setting_db_bank_coa"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Setting Coa Bank</span>
                </a>
            </li>
            
        </ul>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_setting_db_supplier_coa"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Setting Coa Supplier</span>
                </a>
            </li>
            
        </ul>
    </li>




    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
            <span class="pcoded-mtext" >Master Accounting</span>
        </a>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_ak_m_db_k"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Master Debit/Kredit</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_ak_m_family"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Master Family</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_ak_m_type"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Master Type</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_ak_m_coa"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Master COA</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_ak_faktur_penjualan_print_setting"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Setting Print Faktur Penjualan</span>
                </a>
            </li>

            <li class="">
                <a href="<?= base_url("c_t_ak_terima_pelanggan_print_setting"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Setting Print Terima Pelanggan</span>
                </a>
            </li>



            <li class="">
                <a href="<?= base_url("c_t_ak_pembayaran_supplier_print_setting"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Setting Print Pembayaran Supplier</span>
                </a>
            </li>
        </ul>
    </li>

 

    <?php
}
?>









<?php
if($level_user_id==1 or $level_user_id==2 or $level_user_id==4 or $level_user_id==5 or $level_user_id==6)
{
    ?>
    <!-- Menu ke dua -->
    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-list"></i></span>
            <span class="pcoded-mtext">Transaksi Keuangan</span>
        </a>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_t_ak_jurnal_create"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Input Jurnal</span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_t_ak_jurnal"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Transaksi Jurnal</span>
                </a>
            </li>
        </ul>

        <?php
        if($level_user_id==1 or $level_user_id==2 or $level_user_id==5 or $level_user_id==6)
        {
            ?>
            <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_t_ak_jurnal_history"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">History Jurnal</span>
                </a>
            </li>
            </ul>
            <ul class="pcoded-submenu">
                <li class="">
                    <a href="<?= base_url("c_t_ak_faktur_penjualan"); ?>" class="submenu waves-effect waves-dark">
                        <span class="pcoded-mtext">Faktur Penjualan</span>
                    </a>
                </li>
            </ul>
            <ul class="pcoded-submenu">
                <li class="">
                    <a href="<?= base_url("c_t_ak_terima_pelanggan"); ?>" class="submenu waves-effect waves-dark">
                        <span class="pcoded-mtext">Terima Pelanggan</span>
                    </a>
                </li>
            </ul>
            <ul class="pcoded-submenu">
                <li class="">
                    <a href="<?= base_url("c_t_ak_pembayaran_supplier"); ?>" class="submenu waves-effect waves-dark">
                        <span class="pcoded-mtext">Pembayaran Supplier</span>
                    </a>
                </li>
            </ul>
            <?php
        }

        ?>

        
    </li>
    <?php
}
?>

    

    
<?php
if($level_user_id==1)
{
    ?>
    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
            <span class="pcoded-mtext">Admin</span>
        </a>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_t_login_user"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">User</span>
                </a>
            </li>
            
        </ul>
    </li>


    
    <?php
}

?>


<?php
if($level_user_id==1 or $level_user_id==6)
{
    ?>
    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
            <span class="pcoded-mtext">Laporan</span>
        </a>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_laporan2"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Detail</span>
                </a>
            </li>
            
        </ul>
    </li>


    
    <?php
}

?>







    
</ul> <!-- batas buka 3 tingkat!-->
</li> <!-- batas buka 3 tingkat!-->
    





























<li class="pcoded-hasmenu"> <!-- batas buka 3 tingkat!-->
<a href="javascript:void(0)" class="waves-effect waves-dark">
<span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
<span class="pcoded-mtext">Payroll</span>

</a>
<ul class="pcoded-submenu"> <!-- batas buka 3 tingkat!-->







<!-- Diluar Grouping disini -->
    <li <?php if($this->uri->segment(2)=="buku_besar"){echo 'class="pcoded-hasmenu"';}?>>
        <a href="<?= base_url("c_dashboard2/"); ?>" class="waves-effect waves-dark">
        <span class="pcoded-micon">
        <i class="feather icon-credit-card"></i>
        </span>
        <span class="pcoded-mtext">Dashboard</span>
        </a>
    </li>


<?php
$level_user_id = $this->session->userdata('level_user_id');
if($level_user_id==1 or $level_user_id==6)
{
    ?>
    




    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
            <span class="pcoded-mtext" >Master Payroll</span>
        </a>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_t_p_personal"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Personal</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_p_religion"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Master Religion</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_p_gender"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Master Gender</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_p_marital"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Master Marital</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_p_permanen"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Master Permanen</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_p_departmen"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Master Departemen</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_p_position"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Master Posisi</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_p_bank"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Master Bank</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_p_bpjs_tk"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Master BPJS TK</span>
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("c_t_p_bpjs_kes"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Master BPJS Kes</span>
                </a>
            </li>




     
        </ul>
    </li>

 

    <?php
}
?>









<?php
if($level_user_id==1 or $level_user_id==2 or $level_user_id==4 or $level_user_id==5 or $level_user_id==6)
{
    ?>
    <!-- Menu ke dua -->
    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-list"></i></span>
            <span class="pcoded-mtext">Transaksi Payroll</span>
        </a>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_t_p_t_potongan_lain"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Potongan Lain-Lain</span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_t_p_t_tunjangan_lain"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Tunjangan Lain-Lain</span>
                </a>
            </li>
        </ul>

        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_t_p_t_pinjaman"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Input Pinjaman</span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_t_p_t_angsuran"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Angsuran Pinjaman</span>
                </a>
            </li>
        </ul>

        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_t_t_payroll"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">T Payroll</span>
                </a>
            </li>
        </ul>


        
    </li>
    <?php
}
?>

    

    
<?php
if($level_user_id==1)
{
    ?>
    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
            <span class="pcoded-mtext">Admin</span>
        </a>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_t_login_user"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">User</span>
                </a>
            </li>
            
        </ul>
    </li>


    
    <?php
}

?>


<?php
if($level_user_id==1 or $level_user_id==6)
{
    ?>
    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
            <span class="pcoded-mtext">Laporan</span>
        </a>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="<?= base_url("c_laporan2"); ?>" class="submenu waves-effect waves-dark">
                    <span class="pcoded-mtext">Detail</span>
                </a>
            </li>
            
        </ul>
    </li>


    
    <?php
}

?>







    
</ul> <!-- batas buka 3 tingkat!-->
</li> <!-- batas buka 3 tingkat!-->





</ul>
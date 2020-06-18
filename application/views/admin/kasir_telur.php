<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<div class="content">
 <!-- Block Tabs With Options -->
 <h1 class="content-heading">Kasir Telur</h1>
                    <div class="row">
                        <div class="col-7">
                            <!-- Block Tabs With Options Default Style -->
                            <div class="block">
                                <ul class="nav nav-tabs nav-tabs-block align-items-center bg-light" data-toggle="tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#btabswo-static-home">Kasir Telur</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" href="#btabswo-static-profile">Profile</a>
                                    </li> -->
                                    <li class="nav-item ml-auto">
                                        <div class="block-options pl-3 pr-2">
                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                                <i class="si si-refresh"></i>
                                            </button>
                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                                                <i class="si si-close"></i>
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                                <div class="block-content tab-content" style="background:#f0f0f0;">
                                    <div class="tab-pane active" id="btabswo-static-home" role="tabpanel">
                                        <h4 class="font-w400">Transaksi Telur</h4>
                                        <form action="<?= base_url('telur/transaksi_telur') ?>" method="post">
                                                <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-primary text-white" id="basic-addon1" style="width:140px;">Harga Telur (/Kg)</span>
                                                </div>
                                                <input type="number" class="form-control" placeholder="per Kg" name="harga_telur" aria-label="Harga" aria-describedby="basic-addon1" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-primary text-white" id="basic-addon1" style="width:140px;">Jumlah (/Kg)</span>
                                                </div>
                                                <input type="number" class="form-control" placeholder="jumlah" name="jumlah_telur" aria-label="Harga" aria-describedby="basic-addon1" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-primary text-white" id="basic-addon1" style="width:140px;">Kurang Uang</span>
                                                </div>
                                                <input type="number" class="form-control" value="0" name="kurang_uang" aria-label="Harga" aria-describedby="basic-addon1">
                                                </div>
                                                <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-warning text-white" id="basic-addon1" style="width:140px;">Catatan</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="(optional)" name="catatan" aria-label="Harga" aria-describedby="basic-addon1"></input>
                                                </div>
                                        <button type="submit" class="btn btn-success mb-3 offset-md-10"><i class="fa fa-print"></i> PRINT</button>
                                    </div>
                                    <div class="tab-pane" id="btabswo-static-profile" role="tabpanel">
                                        <h4 class="font-w400">Profile Content</h4>
                                        <p>...</p>
                                    </div>
                                </div>
                            </div>
                            <!-- END Block Tabs With Options Default Style -->

                            
                        </div>
                       <div class="col-5">
                       <div class="card mb-2">
  <div class="card-header bg-primary text-light font-weight-bold">
   <i class="fa fa-fw fa-sticky-note"></i> Informasi Nota Telur
  </div>
  <div class="card-body">
  <table>
    <tr>
        <td>No. Nota </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" name="kode" class="font-weight-bold" value="TL<?= time() ?>" style="width:110%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
    </tr>
    <tr>
        <td>Tanggal </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" value="<?= date('d M Y') ?>" style="width:110%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
    </tr>
    <tr>
        <td>Jam </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" value="<?php
                    date_default_timezone_set('Asia/Jakarta');
                    echo date('H:i');?>" style="width:110%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
    </tr>
    <tr>
        <td>Kasir </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" name="nama_kasir" class="font-weight-bold" value="<?= $this->session->userdata('nama') ?>" style="width:110%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
    </tr>
    <tr>
        <td>Nama Pelanggan </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" name="pembeli" class="form-control" style="width:110%; height:25px;" value="UMUM" required></td>
    </tr>
    </form>
    <!-- <tr class="text-small">
        <td class="font-weight-bold" style="color: #fcba03;">*Catatan </td>
        <td class="pl-1 pr-1 font-weight-bold" style="color: #fcba03;">: </td>
        <td><input type="text" name="catatan" class="form-control small" style="width:110%; height:25px; border-color:#fcba03;" placeholder="-"></td>
    </tr> -->
  </table>
  </div>
</div>
                       </div>
                    </div>
                    <!-- END Block Tabs With Options -->




<script>
var rupiah = document.getElementById('rupiah');
rupiah.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat ketik nominal di form kolom input
    // gunakan fungsi formatRupiah() untuk mengubah nominal angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value, 'Rp. ');
});
/* Fungsi formatRupiah */
function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split           = number_string.split(','),
    sisa             = split[0].length % 3,
    rupiah             = split[0].substr(0, sisa),
    ribuan             = split[0].substr(sisa).match(/\d{3}/gi);
 
    // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
 
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
</script>

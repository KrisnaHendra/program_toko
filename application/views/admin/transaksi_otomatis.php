<div class="content">
  <div class="row">

    <div class="col-7">
        <div class="block block-themed block-bordered">
          <div class="block-header">
                                  <h3 class="block-title"><i class="fa fa-shopping-bag"></i> Transaksi <small> <?= date('d M Y') ?></small></h3>
                                  <div class="block-options">
                                      <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>

                                      <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                          <i class="si si-refresh"></i>
                                      </button>
                                  </div>
                              </div>
            <div class="block-content">
              <form action="<?= base_url('transaksi/transaksiBarcode') ?>" method="post">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="kode" name="kode" placeholder="Code Barcode" autofocus required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-dark"><i class="fa fa-qrcode"></i></button>
                        </div>
                    </div>
                </div>
              </form>

              <form class="" action="<?= base_url('transaksi/saveCartBarcode'); ?>" method="post">
              <div class="alert alert-primary d-flex align-items-center" role="alert">
                  <div class="flex-00-auto" style="margin-left:175px !important;">
                      <i class="fa fa-fw fa-wallet"></i>
                  </div>
                  <div class="ml-3">
                      <b>Total : Rp.
                        <?php foreach($total as $t):?>
                          <?= number_format($t['total']) ?>
                          <input type="hidden" name="allTotal" value="<?= $t['total'] ?>">
                        <?php endforeach; ?></b>
                  </div>
              </div>
              <a href="<?= base_url('transaksi/deleteAllCart') ?>" class="btn btn-sm btn-outline-danger mb-2" data-toggle="tooltip" title="Kosongkan" data-placement="right"><i class="fa fa-times-circle"></i> Kosongkan Cart</a>
              <input type="submit" name="update" value="Update" class="btn btn-sm mb-2 btn-success" style="margin-left:53%">
              <input type="submit" id="print" name="print" value="Print" onclick="return confirm('Cetak Struk Sekarang ?')" class="btn btn-sm mb-2 btn-primary">
                <!-- <a href="#" class="btn btn-sm btn-primary offset-6 mb-2"><i class="fa fa-print"></i> Print</a>
                <a href="#" class="btn btn-sm btn-success mb-2">Update</a> -->
              <table class="table table-sm">
                  <tr class="bg-info text-white">
                    <!-- <th>#</th> -->
                    <th class="text-left" style="width:30%">Barang</th>
                    <th class="text-center" style="width:21%">Harga</th>
                    <th class="text-center" style="width:21%">Jumlah</th>
                    <th class="text-center" style="width:21%">Subtotal</th>
                    <th class="text-center"><i class="fa fa-trash-alt" style="width:7%"></i></th>
                  </tr>
                  <?php if(count($view)==0){ ?>
                  <tr class="bg-light">
                    <td colspan="6" class="text-center font-weight-bold">Keranjang Kosong</td>
                  </tr>
                  <?php } ?>
                  <?php foreach($view as $no => $v): ?>
                  <tr>
                    <input type="hidden" name="id[]" value="<?= $v['id'] ?>">
                    <input type="hidden" name="id_barang[]" value="<?= $v['id_barang'] ?>">
                    <input type="hidden" name="harga[]" value="<?= $v['harga'] ?>">
                    <td><a class="btn btn-sm btn-light form-control form-control-sm text-left" style="border:1px solid #e1e1e1;"><?= $v['nama_barang']; ?> <small class="text-monospace"><?= $v['keterangan'] ?></small></a></td>
                    <td><a class="btn btn-sm btn-light form-control form-control-sm text-right" style="border:1px solid #e1e1e1;"><?= number_format($v['harga']); ?></a></td>
                    <td><input type="number" class="form-control form-control-sm text-center" name="jumlah[]" value="<?= $v['jumlah'] ?>"></td>
                    <td><a class="btn btn-sm btn-light form-control form-control-sm text-right" style="border:1px solid #e1e1e1;"><?= number_format($v['subtotal']); ?></a></td>
                    <td class="text-right"><a href="<?= base_url('transaksi/deleteCartBarcode') ?>/<?= $v['id'] ?>" class="badge badge-danger" ><i class="fa fa-trash-alt"></i></a></td>
                  </tr>
                  <?php endforeach; ?>
              </table>

            </div>
        </div>
    </div>

    <div class="col-5">
        <div class="block block-themed block-bordered mb-2">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"><i class="fa fa-sticky-note"></i> Informasi Nota</h3>
            </div>
            <div class="block-content mb-4">
              <table>
                <tr>
                    <td>No. Nota </td>
                    <td class="pl-1 pr-1">: </td>
                    <td><input type="text" name="kode" class="form-control font-weight-bold" value="INV<?= time() ?>" style="width:110%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
                </tr>
                <tr>
                    <td>Tanggal </td>
                    <td class="pl-1 pr-1">: </td>
                    <td><input type="text" class="form-control" value="<?= date('d/m/Y') ?>" style="width:110%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
                </tr>
                <tr>
                    <td>Kasir </td>
                    <td class="pl-1 pr-1">: </td>
                    <td><input type="text" name="nama_kasir" class="form-control font-weight-bold" value="<?= $this->session->userdata('nama') ?>" style="width:110%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
                </tr>
                <tr>
                    <td>Nama Pelanggan </td>
                    <td class="pl-1 pr-1">: </td>
                    <td><input type="text" name="pembeli" class="form-control" style="width:110%;" value="Umum" required></td>
                </tr>
                <tr class="text-small">
                    <td class="font-weight-bold" style="color: black;">Catatan Struk*</td>
                    <td class="pl-1 pr-1 font-weight-bold" style="color: black;">: </td>
                    <td><input type="text" name="catatan" class="form-control small" style="width:110%;" placeholder="-"></td>
                </tr>
              </table>
            </div>
        </div>

        <div class="block block-bordered">
          <div class="block-content bg-white pt-2 text-center">
            <hr class="mt-2 mb-1">
            <b class="text-danger"><i class="fa fa-keyboard"></i> Tombol Shortcut:</b>
            <hr class="mt-1 mb-0">
            <div class="row ml-1">

              <table class="mb-0 col-6 text-left" style="border-right:1px solid #e6e6e6;">
                <tr>
                  <td class="font-weight-bold text-primary text-center">F5</td>
                  <td style="width:30%" class="text-center"> <i class="fa fa-arrow-right"></i> </td>
                  <td>Refresh</td>
                </tr>
                <tr>
                  <td class="font-weight-bold text-primary text-center">F6</td>
                  <td style="width:30%" class="text-center"> <i class="fa fa-arrow-right"></i> </td>
                  <td>Fokus Barcode</td>
                </tr>
              </table>
              <table class="mb-0 col-6 text-left">
                <tr>
                  <td class="font-weight-bold text-primary text-center">F7</td>
                  <td style="width:30%" class="text-center"> <i class="fa fa-arrow-right"></i> </td>
                  <td>Print</td>
                </tr>
                <tr>
                  <td class="font-weight-bold text-primary text-center">Enter</td>
                  <td style="width:30%" class="text-center"> <i class="fa fa-arrow-right"></i> </td>
                  <td>Update</td>
                </tr>
              </table>
            </div>
            <hr class="mt-0 mb-3">

          </div>
        </div>

    </div>
  </form>


  </div>
</div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $(document).bind('keydown', 'f2', function() {
    $('#kode').focus();
  });
});
</script> -->
<script type="text/javascript">
document.onkeyup = function(e) {
if (e.which == 117) {
  $('#kode').focus();
} else if (e.which == 118) {
  $('#print').click();
} else if (e.ctrlKey && e.altKey && e.which == 89) {
  alert("Ctrl + Alt + Y shortcut combination was pressed");
} else if (e.ctrlKey && e.altKey && e.shiftKey && e.which == 85) {
  alert("Ctrl + Alt + Shift + U shortcut combination was pressed");
}
};
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php if(form_error('kode')){ ?>
<script type="text/javascript">
var pesan = "<?= form_error('kode') ?>";
swal({
title: "Gagal",
icon: "warning",
text: pesan,
buttons: false,
timer: 1200,
});
</script>
<?php }elseif($this->session->flashdata('notif')){ ?>
<script type="text/javascript">
swal({
title: "Error",
icon: "error",
text: "Keranjang Masih Kosong",
buttons: false,
timer: 1200,
});
</script>
<?php } ?>

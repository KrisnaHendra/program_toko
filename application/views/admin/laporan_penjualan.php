<div class="content">
  <div class="row p-0">
    <div class="col-12">
        <div class="block block-bordered">
            <div class="block-header bg-info">
                <h3 class="block-title text-white font-weight-bold"><i class="fa fa-file-contract"></i> Laporan Penjualan <small class="text-white">Cahaya Titan</small></h3>
                <div class="block-options">
                    <div class="block-options-item text-white font-weight-bold"><b><i class="fa fa-calendar-alt"></i> <?= date('d F Y') ?></b></div>
                </div>
            </div>
            <div class="block-content">
              <form action="<?= base_url('laporan/getData') ?>" method="get">
                <div class="row">
                  <!-- Periode -->
                  <div class="input-group offset-1 col-5">
                      <div class="input-group-prepend">
                          <span class="input-group-text bg-primary text-white">
                              Periode
                          </span>
                      </div>
                      <!-- <input type="text" class="form-control text-center monthpicker font-weight-bold" name="periode" data-date-format="MM yyyy"> -->
                      <input type="text" class="monthpicker form-control text-center font-weight-bold" name="periode" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="MM yyyy" placeholder="dd/mm/yy">

                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                      </div>
                  </div>
                  <!-- Barang -->
                  <div class="input-group col-5">
                      <div class="input-group-prepend">
                          <span class="input-group-text bg-primary text-white">
                               Jenis
                          </span>
                      </div>
                      <select class="selectpicker form-control" name="jenis_transaksi" data-show-subtext="true" data-size="5">
                        <option value="">Semua Jenis</option>
                        <option value="INV" data-subtext="INV">Transaksi Biasa</option>
                        <option value="DO" data-subtext="DO">Transaksi DO</option>
                      </select>
                      <!-- <input type="text" class="form-control" id="example-group2-input1" name="example-group2-input1"> -->
                  </div>
                </div>
                <div class="row offset-5 col-2 mt-2 mb-2">
                  <button id="tampil" class="btn btn-sm btn-outline-info btn-block" type="sbmit" name="button"><i class="fa fa-search"></i> Tampilkan</button>
                  <!-- <button id="tampila" class="btn btn-sm btn-outline-info btn-block" type="button" name="button"><i class="fa fa-search"></i> Tampilkan</button> -->
                </div>
              </form>
            </div>
        </div>
    </div>

    <!-- Hasil -->
    <?php if(count($listData)!=0) { ?>
    <div class="col-12" id="view">
          <div class="block">
              <div class="block-header">
                  <h3 class="block-title">Laporan Penjualan Bulan <?= $bulan; ?> <small><?= $tahun; ?></small></h3>
                  <div class="block-options">
                      <!-- <button type="button" class="btn btn-sm btn-success"><i class="fa fa-file-excel"></i> Excel</button> -->
                      <button type="button" class="btn btn-sm btn-info" onclick="printLaporan('listDataLaporan')"><i class="fa fa-print"></i> Print</button>
                  </div>
              </div>
              <hr class="p-0 m-0">
              <div class="block-content">
                <table class="table table-sm table-hover" id="listDataLaporan">
                  <tr class="bg-light">
                    <th>Invoice</th>
                    <th>Nama Kasir</th>
                    <th>Nama Pembeli</th>
                    <th>Total Transaksi</th>
                    <th>Tanggal</th>
                    <th><i class="fa fa-check-circle"></i></th>
                  </tr>
                  <?php foreach($listData as $t): ?>
                  <tr>
                    <td><?= $t['kode'] ?></td>
                    <td><?= $t['nama_kasir'] ?></td>
                    <td><?= $t['nama_pembeli'] ?></td>
                    <td>Rp. <?= number_format($t['total']) ?></td>
                    <td><?= date('d/m/y',$t['tanggal']) ?></td>
                    <td><spam class="badge badge-success" data-toggle="tooltip" title="Success"><i class="fa fa-check-circle"></i></span></td>
                  </tr>
                <?php endforeach; ?>
                </table>
              </div>
          </div>
      </div>
    <?php } ?>

    <?php if(count($listData)==0) { ?>
      <div class="col-12">
        <div class="alert alert-primary alert-dismissable text-center" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <p class="mb-0"><b>Silahkan cari data laporan sesuai periode, jika ada data, akan muncul list data laporan.</b></p>
        </div>
      </div>
    <?php } ?>
    <!-- End -->
  </div>

</div>


<script type="text/javascript">
// One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Your message!'});
function printLaporan(divName) {
     var printContents = document.getElementById(divName).innerHTML;

     window.print();
     window.close();
}
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#view').hide();
  $('#tampila').click(function(){
    $('#view').toggle('slow');
  });
});
</script> -->

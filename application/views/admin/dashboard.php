
                <!-- Hero -->
                <!-- <div class="bg-image overflow-hidden" style="background-image: url('assets/admin/assets/media/photos/photo3@2x.jpg');">
                    <div class="bg-primary-dark-op">
                        <div class="content content-narrow content-full">
                            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-5 mb-2 text-center text-sm-left">
                                <div class="flex-sm-fill">
                                    <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">Dashboard</h1>
                                    <h2 class="h4 font-w400 text-white-75 mb-0 invisible" data-toggle="appear" data-timeout="250">Administrator Cahaya Titan</h2>
                                </div>
                                <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                                    <span class="d-inline-block invisible" data-toggle="appear" data-timeout="350">
                                        <a class="btn btn-primary px-4 py-2" data-toggle="click-ripple" href="<?= base_url('barang') ?>">
                                            <i class="fa fa-plus mr-1"></i> Tambah barang
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- END Hero -->

                <!-- Page Content -->
                <div class="content content-narrow">
                    <h4><i class="fa fa-clipboard"></i> DASHBOARD <small> Cahaya Titan </small></h4>
                    <!-- Stats -->
                    <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                            <a class="block block-rounded block-link-pop border-left border-right border-primary border-4x bg-white text-light pt-0" href="<?= base_url('transaksi/history') ?>">
                                <div class="block-content block-content-full  pt-2 pb-2">
                                    <div class="font-size-h2 font-w600 text-primary text-center"><i class="fa fa-wallet"></i> Total Transaksi</div>

                                    <div class="font-size-h2 font-w600 text-dark text-center">Rp. <?= number_format($sum); ?></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <a class="block block-rounded block-link-pop border-left border-primary bg-white border-4x" href="<?= base_url('admin/data_user'); ?>">
                                <div class="block-content block-content-full  pt-2 pb-2">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted text-center pt-2"><i class="fa fa-users"></i> Jumlah Admin</div>
                                    <!-- <hr class="pt-0 pb-0" style="border:1px solid blue;"> -->
                                    <div class="font-size-h2 font-w400 text-dark text-center pt-0 mt-0 font-weight-bold"><?= $this->db->count_all('user') ?></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                            <a class="block block-rounded block-link-pop border-left border-primary bg-white border-4x" href="<?= base_url('barang'); ?>">
                                <div class="block-content block-content-full  pt-2 pb-2">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted text-center pt-2"><i class="fa fa-box-open"></i> jumlah barang</div>
                                    <!-- <hr class="pt-0 pb-0" style="border:1px solid blue;"> -->
                                    <div class="font-size-h2 font-w400 text-dark text-center pt-0 mt-0 font-weight-bold"><?= $this->db->count_all('barang') ?></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                            <a class="block block-rounded block-link-pop border-left border-primary bg-white border-4x" href="<?= base_url('transaksi/history') ?>">
                                <div class="block-content block-content-full  pt-2 pb-2">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted text-center pt-2"><i class="fa fa-shopping-cart"></i> Jumlah Transaksi</div>
                                    <!-- <hr class="pt-0 pb-0" style="border:1px solid blue;"> -->
                                    <div class="font-size-h2 font-w400 text-dark text-center pt-0 mt-0 font-weight-bold"><?= $this->db->count_all('transaksi') ?></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                            <div class="block block-bordered">
                                <div class="block-header bg-primary">
                                    <h3 class="block-title text-white"><i class="fa fa-chart-bar"></i> Grafik Penjualan Barang <small class="text-white"><?= date('Y') ?></small></h3>
                                </div>
                                <div class="block-content" style="height:340px !important">
                                    <canvas id="myAreaChart" width="300" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                              <div class="block block-bordered">
                                  <div class="block-header bg-primary pt-2 pb-2">
                                      <h3 class="block-title text-white"><i class="fa fa-angle-double-up"></i> Barang Terlaris</h3>
                                  </div>
                                  <div class="block-content mb-1" style="height:340px !important">
                                      <canvas id="doughnutChart" height="150"></canvas>
                                  </div>
                              </div>
                          </div>
                    </div>



                    <script type="text/javascript">
  var ctx = document.getElementById('myAreaChart').getContext('2d');
  var myPieChart = new Chart(ctx, {
    //chart akan ditampilkan sebagai pie chart
    type: 'bar',
    data: {
    labels: [
      'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Okt','Nov','Des',
    ],
    datasets: [{
      data: [
        <?php foreach($listGrafik as $key => $value): ?>
        <?= '"' . $value . '",' ?>
        <?php endforeach; ?>
      ],
      backgroundColor: ['#4e73df', '#1cc88a', 'yellow','#f59542','#4e73df', '#1cc88a', 'yellow','#f59542','#4e73df', '#1cc88a', 'yellow','#f59542'],
      // hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf','red'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: true,
    tooltips: {
      // backgroundColor: "rgb(255,255,255)",
      // bodyFontColor: "#858796",
      // borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    }
  }
});
  </script>

  <script type="text/javascript">
var ctx2 = document.getElementById('doughnutChart').getContext('2d');
var doughnutChart = new Chart(ctx2, {
//chart akan ditampilkan sebagai pie chart
type: 'doughnut',
data: {
labels: [
  <?php foreach($terlaris as $key => $value): ?>
  <?= '"' . $value['nama_barang'] . '",' ?>
  <?php endforeach; ?>
],
datasets: [{
data: [
  <?php foreach($terlaris as $key => $value): ?>
  <?= '"' . $value['total'] . '",' ?>
  <?php endforeach; ?>
],
backgroundColor: ['#4e73df', '#1cc88a', 'yellow','#f59542'],
// hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf','red'],
hoverBorderColor: "rgba(234, 236, 244, 1)",
}],
},
options: {
maintainAspectRatio: false,
tooltips: {
backgroundColor: "rgb(255,255,255)",
bodyFontColor: "#858796",
borderColor: '#dddfeb',
borderWidth: 1,
xPadding: 15,
yPadding: 15,
displayColors: false,
caretPadding: 10,
},
legend: {
display: true
}
}
});
</script>

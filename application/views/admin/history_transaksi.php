<div class="content">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">History Transaksi Cahaya Titan <small><?= date('d F Y') ?></small></h3>
                            <a href="<?=base_url('transaksi/hapus_history')?>" class="btn btn-sm btn-danger" onClick="return confirm('Anda yakin ingin menghapus semua history pembelian?')" data-toggle="tooltip" title="Hapus Semua History"><i class="fa fa-trash-alt mr-1"></i>HAPUS HISTORY</a>
                        </div>
                        <hr class="m-0">
                        <div class="block-content block-content-full">
                          <marquee title="Detail Transaksi" behavior="alternate" onmouseover="this.stop()" onmouseout="this.start()" direction="right">
                            <a href="#" class="btn btn-dark font-weight-bold"><i class="fa fa-tags"></i> Total Transaksi : <?= $tot_transaksi[0]['total'] ?></a>
                            <a href="#" class="btn btn-dark font-weight-bold"><i class="fa fa-wallet"></i> Total Pendapatann : Rp. <?= number_format($tot_pendapatan[0]['pendapatan']) ?></a>
                          </marquee>
                                <?=$this->session->flashdata('notif');?>
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-hover table-vcenter js-dataTable-full">
                                <thead>
                                    <tr class="text-light bg-success">
                                        <th class="text-center" style="width: 60px;">#</th>
                                        <th style="width:17%">Kode</th>
                                        <th style="width:17%">Nama Kasir</th>
                                        <th style="width:17%">Nama Pembeli</th>
                                        <th style="width:20%">Total</th>
                                        <th style="width:17%">Tanggal</th>
                                        <th style="width:10px;"><i class="fa fa-check-circle"></i></th>
                                        <!-- <th style="" class="text-center"><i class="fa fa-fw fa-trash"></i></th> -->

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;foreach ($transaksi as $t): ?>
                                    <tr>
                                        <td class="text-center font-size-sm"><?=$no++;?></td>
                                        <td><a href="" class="font-weight-bold btn btn-sm btn-outline-dark" data-toggle="modal" data-target="#modal-block-large<?=$t['id_transaksi'];?>"><?=$t['invoice']?></a></td>
                                        <td><?=$t['nama_kasir']?></td>
                                        <td><?=$t['nama_pembeli']?></td>
                                        <td>Rp. <?=number_format($t['total'])?></td>
                                        <td><?=date('d M Y', $t['tanggal'])?></td>
                                        <td class="text-center"><span class="badge badge-success"><i class="fa fa-check"></i></span></td>

                                    </tr>
                                    <?php endforeach;?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->

                    <!-- END Dynamic Table with Export Buttons -->
                </div>

                 <!-- Large Block Modal -->
                 <?php $no = 1;foreach ($transaksi as $t): ?>
        <div class="modal" id="modal-block-large<?=$t['id_transaksi'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark" style="height:70px;">
                            <h1 class="block-title" style="font-size:25px;">Transaksi (<?=$t['invoice'];?>)</h3>

                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm">
                            <h1 class="text-center"><u>CAHAYA TITAN </u></h1>
                            <table class="table table-hover">
                                <tr>
                                    <td class="font-weight-bold"><a href="">No. Nota</a></td>
                                    <td class="text-center">:</td>
                                    <td><b><a href=""><?=$t['invoice']?></b></a></td>
                                </tr>
                                <tr>
                                    <td>Nama Kasir</td>
                                    <td class="text-center">:</td>
                                    <td><?=$t['nama_kasir']?></td>
                                <tr>
                                    <td>Tanggal</td>
                                    <td class="text-center">:</td>
                                    <td><?=date('d M Y', $t['tanggal'])?></td>
                                </tr>
                                <tr>
                                    <td>Nama Pelanggan</td>
                                    <td class="text-center">:</td>
                                    <td><?=$t['nama_pembeli']?></td>
                                <tr class="bg-light text-dark font-weight-bold">
                                    <td>Detail Pembelian</td>
                                    <td class="text-center">:</td>
                                    <td>
                                        <ul>
                                        <?php foreach ($t['detail'] as $k => $v) {
    echo "<li>" . $v['barang'] . " (" . $v['jumlah'] . ")</li>";
}
?>
                                        </ul>
                                    </td>
                                </tr>
                                        <tr>
                                            <td><h2 class="font-weight-bold">TOTAL</h2></td>
                                            <td class="text-center">:</td>
                                            <td><h2 class="font-weight-bold">Rp. <?=number_format($t['total'])?></h2></td>
                                        <tr>
                            </table>
                            <!-- <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p> -->
                        </div>
                        <div class="block-content block-content-full text-right border-top">
                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fa fa-check mr-1"></i>Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>

        <!-- END Large Block Modal -->

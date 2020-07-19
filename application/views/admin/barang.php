<div class="content">

<div class="block">
                        <div class="block-header bg-dark">
                            <h3 class="block-title text-white"><i class="fa fa-box"></i> Tabel Barang - <small class="text-white">Cahaya Titan</small> (<?= $this->db->count_all('barang') ?> Barang)</h3>
                            <div class="block-options">
                              <!-- <h5 class="font-weight-bold m-0 btn btn-sm pt-0 pb-0 btn-primary">Total : </h5> -->
                              <a href="<?=base_url('barang/print_barang')?>" data-toggle="tooltip" title="PDF" class="btn btn-sm pt-0 pb-0 btn-primary" target="_blank"><i class="fa fa-file-export"></i> PDF</a>
                              <a href="<?=base_url('barang/export')?>" data-toggle="tooltip" title="Excel" class="btn btn-sm pt-0 pb-0 btn-success" onClick="return confirm('Convert data barang ke excel?')"><i class="fa fa-file-excel"></i> EXCEL</a>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                          <div class="text-center">

                          </div>
                            <!-- <a href="<?=base_url('laporan')?>" class="btn btn-sm btn-warning" target="_blank">Coba</a> -->
                            <?=$this->session->flashdata('notif')?>
                            <?=form_error('kode', '<h6 class="alert alert-danger text-center"><i class="fa fa-times-circle"></i> ', '</h6>');?>
                            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-striped table-hover table-vcenter js-dataTable-full-pagination">
                            <!-- <table class="table table-bordered table-striped table-hover table-vcenter js-dataTable-buttons"> -->
                                <thead>
                                    <tr class="bg-secondary" style="background-color: #5c80d1; color: white;">
                                        <th class="text-center" style="width: 50px;">NO</th>
                                        <th class="" style="wifth:30%">Barang</th>
                                        <th style="width:8%;">Kode</th>
                                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Ket</th>
                                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">STOK</th>
                                        <th class="d-none d-sm-table-cell text-center" style="width: 13%;">Harga Jual</th>
                                        <th class="d-none d-sm-table-cell text-center" style="width: 13%;">Harga DO</th>
                                        <th class="text-center" style="width: 15%;">Updated</th>
                                        <th class="text-center" style="width: 13%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;foreach ($barang as $b): ?>
                                    <tr>
                                        <td class="text-center font-size-sm"><?=$no++;?></td>
                                        <td class="font-w600 font-size-sm">
                                            <?=$b['nama_barang']?>
                                        </td>
                                        <td class="text-center font-weight-bold" style="font-size:10px;"><?=$b['kode'];?></td>
                                        <td class="d-none d-sm-table-cell font-size-sm text-center">
                                            <?=$b['keterangan']?>
                                            <!-- client1<em class="text-muted">@example.com</em> -->
                                        </td>
                                        <td class="d-none d-sm-table-cell text-center">
                                            <?php if ($b['stok'] < 10) {?>
                                                    <span class="btn btn-sm btn-danger"><?=$b['stok']?></span>
                                            <?php } else if ($b['stok'] < 10) {?>
                                                    <span class="btn btn-sm btn-secondary"><?=$b['stok']?></span>
                                            <?php } else {?>
                                                    <span class="btn btn-sm btn-info"><?=$b['stok']?></span>
                                            <?php }?>
                                        </td>
                                        <td class="text-center">
                                            Rp. <?=number_format($b['harga_jual'])?>
                                        </td>
                                        <td class="text-center">
                                            Rp. <?=number_format($b['harga_do'])?>
                                        </td>
                                        <td class="text-center">
                                            <em class="text-muted font-size-sm text-center"><?=date('d/m/Y', $b['updated'])?></em>
                                        </td>
                                        <td class="text-center">
                                            <a href="#modal-update<?=$b['id_barang'];?>" class="btn btn-sm btn-success" data-toggle="modal" data-toggle="tooltip" title="Edit Barang"><i class="fa fa-fw fa-edit"></i></a>
                                            <a href="<?=base_url('barang/hapus_barang')?>/<?=$b['id_barang']?>" class="btn btn-sm btn-danger" onClick="return confirm('Anda Yakin?')" data-toggle="tooltip" title="Hapus Barang"><i class="fa fa-fw fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>



                                </tbody>
                            </table>
                            <button class="btn btn-block btn-outline-secondary mt-2" data-toggle="modal" data-target="#modal-block-fadein"><i class="fa fa-fw fa-plus-circle"></i> Tambah Data Barang</button>
                        </div>
                    </div>
                    </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="modal-block-fadein" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Tambah Data Barang</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm">
                            <form action="<?=base_url('barang/tambah_barang')?>" method="post">
                                <i class="fa fa-key btn btn-light btn-sm btn-block"> Kode Barang</i>
                                <input type="text" name="kode" class="form-control" placeholder="Kode Barang" required><br>
                                <i class="fa fa-archive btn btn-light btn-sm btn-block"> Nama Barang</i>
                                <input type="text" name="nama" class="form-control" placeholder="Nama Barang" required><br>
                                <i class="fa fa-book btn btn-light btn-sm btn-block"> Keterangan</i>
                                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" required><br>
                                <i class="fa fa-money-bill-wave  btn btn-light btn-sm btn-block"> Harga Jual</i>
                                <input type="number" name="harga" class="form-control" placeholder="Harga Jual" required min="0"><br>
                                <i class="fa fa-money-bill-wave  btn btn-light btn-sm btn-block"> Harga DO</i>
                                <input type="number" name="harga_do" class="form-control" placeholder="Harga DO" required min="0"><br>
                                <i class="fa fa-sort-numeric-up btn btn-light btn-sm btn-block"> Jumlah Stok</i>
                                <input type="number" name="stok" class="form-control" placeholder="Stok" required min="0"><br>
                            </div>

                        <div class="block-content block-content-full text-right border-top">
                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save mr-1"></i>SAVE</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal Tambah -->

        <!-- Modal Update -->
        <?php foreach ($barang as $b): ?>
        <div class="modal fade" id="modal-update<?=$b['id_barang'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-update" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-primary">
                            <h3 class="block-title">Ubah Data Barang</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm">
                            <form action="<?=base_url('barang/update_barang')?>" method="post">
                            <input type="hidden" name="id_barang" value="<?=$b['id_barang']?>">
                                <i class="fa fa-key btn btn-info btn-sm btn-block"> Kode Barang</i>
                                <input type="text" name="kode" class="form-control" value="<?=$b['kode']?>" readonly><br>
                                <i class="fa fa-archive btn btn-info btn-sm btn-block"> Nama Barang</i>
                                <input type="text" name="nama" class="form-control" value="<?=$b['nama_barang']?>" ><br>
                                <i class="fa fa-book btn btn-info btn-sm btn-block"> Keterangan</i>
                                <input type="text" name="keterangan" class="form-control" value="<?=$b['keterangan']?>"><br>
                                <i class="fa fa-money-bill-wave btn btn-info btn-sm btn-block"> Harga Jual</i>
                                <input type="number" name="harga" class="form-control" value="<?=$b['harga_jual']?>" min="0"><br>
                                <i class="fa fa-money-bill-wave btn btn-info btn-sm btn-block"> Harga DO</i>
                                <input type="number" name="harga_do" class="form-control" value="<?=$b['harga_do']?>" min="0"><br>
                                <i class="fa fa-sort-numeric-up btn btn-info btn-sm btn-block"> Jumlah Stok</i>
                                <input type="number" name="stok" class="form-control" value="<?=$b['stok']?>" min="0"><br>
                            </div>

                        <div class="block-content block-content-full text-right border-top">
                            <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save mr-1"></i>SAVE</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <!-- END Modal Update -->

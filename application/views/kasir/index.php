<div class="content">

<div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Data Barang - <small>Cahaya Titan</small></h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- <div class="row">
                            <a href="<?= base_url('barang/print_barang') ?>" class="btn btn-secondary mb-2 ml-3 mr-2 col-md-1" target="_blank"><i class="fa fa-save"></i> PDF</a>
                            <a href="<?= base_url('barang/print_barang') ?>" class="btn btn-success mb-2 col-md-1" target="_blank"><i class="fa fa-file-export"></i> EXCEL</a>
                            <form action="" class="offset-md-7 mt-2">
                            <button class="" style="background-color:white;"><i class="fa fa-fw fa-search"></i></button>
                            <input type="text" placeholder="search...">
                            </form>
                            </div> -->
                            <?= $this->session->flashdata('notif') ?>
                            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                            <!-- <table class="table table-bordered table-striped table-hover table-vcenter js-dataTable-buttons"> -->
                                <thead>
                                    <tr class="bg-primary text-light" style="background-color: ;"> 
                                        <th class="text-center" style="width: 80px;">NO</th>
                                        <th class="" style="25%">Nama Barang</th>
                                        <th class="text-center font-weight-bold" style="width: 10%; ;">Kode</th>
                                        <th class="d-none d-sm-table-cell text-center" style="width: 15%">Keterangan</th>
                                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">STOK</th>
                                        <th class="d-none d-sm-table-cell text-center" style="width: 15%;">Harga Jual</th>
                                        <th class="d-none d-sm-table-cell text-center" style="width: 15%;">Harga DO</th>
                                        <th class="text-center" style="width: 10%;">Updated</th>
                                        <!-- <th class="text-center" style="width: 13%;">Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($barang as $b): ?>
                                    <tr>
                                        <td class="text-center font-size-sm"><?= $no++; ?></td>
                                        <td class="font-w600 font-size-sm">
                                            <?= $b['nama_barang'] ?>
                                        </td>
                                        <td class="text-center" style="font-size:10px;"><?= $b['kode']; ?></td>
                                        <td class="d-none d-sm-table-cell font-size-sm text-center">
                                            <?= $b['keterangan'] ?>
                                            <!-- client1<em class="text-muted">@example.com</em> -->
                                        </td>
                                        <td class="d-none d-sm-table-cell text-center">
                                            <?php if($b['stok']<10){?>
                                                    <span class="btn btn-sm btn-danger"><?= $b['stok'] ?></span>
                                           
                                            <?php }else{ ?>
                                                    <span class="btn btn-sm btn-info"><?= $b['stok'] ?></span>
                                            <?php }?>
                                        </td>
                                        <td class="text-center">
                                                Rp. <?= number_format($b['harga_jual']) ?>
                                        </td>
                                        <td class="text-center">
                                                Rp. <?= number_format($b['harga_do']) ?>
                                        </td>
                                        <td class="text-center">
                                            <em class="text-muted font-size-sm text-center"><?= date('d M Y',$b['updated']) ?></em>
                                        </td>
                                        <!-- <td class="text-center">
                                            <a href="#modal-update<?=$b['id_barang'];?>" class="btn btn-sm btn-warning" data-toggle="modal" data-toggle="tooltip" title="Edit Barang"><i class="fa fa-fw fa-save"></i></a>
                                            <a href="<?= base_url('barang/hapus_barang') ?>/<?= $b['id_barang'] ?>" class="btn btn-sm btn-danger" onClick="return confirm('Anda Yakin?')" data-toggle="tooltip" title="Hapus Barang"><i class="fa fa-fw fa-trash"></i></a>
                                        </td> -->
                                    </tr>
                                    <?php endforeach;?>
                                    
                                   
                                   
                                </tbody>
                            </table>
                            <!-- <button class="btn btn-block btn-outline-secondary mt-2" data-toggle="modal" data-target="#modal-block-fadein"><i class="fa fa-fw fa-plus-circle"></i> Tambah Data Barang</button> -->
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
                                <i class="fa fa-archive btn btn-light btn-sm btn-block"> Nama Barang</i>
                                <input type="text" name="nama" class="form-control" placeholder="Nama Barang" required><br>   
                                <i class="fa fa-book btn btn-light btn-sm btn-block"> Keterangan</i>
                                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" required><br>   
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
        <?php foreach($barang as $b): ?>
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
                            <input type="hidden" name="id_barang" value="<?= $b['id_barang'] ?>">
                                <i class="fa fa-archive btn btn-info btn-sm btn-block"> Nama Barang</i>
                                <input type="text" name="nama" class="form-control" value="<?= $b['nama_barang'] ?>" ><br>   
                                <i class="fa fa-book btn btn-info btn-sm btn-block"> Keterangan</i>
                                <input type="text" name="keterangan" class="form-control" value="<?= $b['keterangan'] ?>"><br>   
                                <i class="fa fa-sort-numeric-up btn btn-info btn-sm btn-block"> Jumlah Stok</i>
                                <input type="number" name="stok" class="form-control" value="<?= $b['stok'] ?>" min="0"><br>   
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
        <?php endforeach; ?>
        <!-- END Modal Update -->

       
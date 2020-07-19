<div class="content">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-header bg-primary">
                            <h3 class="block-title text-white">Data Pelanggan <small class="text-white">Cahaya Titan</small></h3>
                            <a href="" class="btn btn-sm btn-light"><i class="fa fa-users mr-1"></i>Jumlah Pelanggan : <?= $this->db->count_all('pelanggan') ?></a>
                            <a href="<?= base_url('ternak/add_pelanggan') ?>" class="btn btn-sm btn-dark ml-1" data-toggle="modal" data-target="#modal-block-slideup"><i class="fa fa-plus-circle"></i></a>
                        </div>
                        <hr class="m-0">
                        <div class="block-content block-content-full">
                                <?= $this->session->flashdata('notif'); ?>
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-sm table-hover table-striped table-vcenter js-dataTable-full">
                                <thead>
                                    <tr class="text-dark bg-info" style="background-color:#24edff;">
                                        <th class="text-center" style="width: 80px;">#</th>
                                        <th style="">Nama Pelanggan</th>
                                        <th style="">Alamat</th>
                                        <th style="" class="text-center">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($pelanggan as $p): ?>
                                    <tr>
                                        <td class="text-center font-size-sm"><?= $no++; ?></td>
                                        <td><b class="text-primary"><?= $p['nama_pelanggan'] ?></b></td>
                                        <td><?= $p['alamat'] ?></td>
                                        <td class="text-center">
                                            <a href="#modal-update<?= $p['id_pelanggan'] ?>" class="btn btn-sm btn-success" data-toggle="modal" title="Edit Pelanggan"><i class="fa fa-fw fa-edit"></i></a> |
                                            <a href="<?= base_url('ternak/delete_pelanggan/') ?><?= $p['id_pelanggan'] ?>" class="btn btn-sm btn-warning" onClick="return confirm('Anda yakin akan menghapus data pelanggan?')" data-toggle="tooltip" title="Hapus Pelanggan"><i class="fa fa-fw fa-trash"></i></a>
                                        </td>

                                    </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- <a href="<?= base_url('ternak/add_pelanggan') ?>" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal-block-slideup"><i class="fa fa-plus-circle"></i> Tambah Pelanggan</a> -->
                    </div>
                    <!-- END Dynamic Table Full -->

                    <!-- END Dynamic Table with Export Buttons -->
                </div>

                 <!-- Slide Up Block Modal -->
        <div class="modal fade" id="modal-block-slideup" tabindex="-1" role="dialog" aria-labelledby="modal-block-slideup" aria-hidden="true">
            <div class="modal-dialog modal-dialog-slideup" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title"><i class="fa fa-users"></i> Tambah Data Pelanggan</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm">
                        <form action="<?=base_url('ternak/add_pelanggan')?>" method="post">
                                <i class="fa fa-user btn btn-info btn-sm btn-block"> Nama Pelanggan</i>
                                <input type="text" name="nama" class="form-control text-center" placeholder="Nama Pelanggan" required><br>
                                <i class="fa fa-book btn btn-info btn-sm btn-block"> Alamat Pelanggan</i>
                                <input type="text" name="alamat" class="form-control text-center" placeholder="Alamat" required><br>

                        </div>
                        <div class="block-content block-content-full text-right border-top">
                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-info">Submit</button>
                        </div>
                                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Slide Up Block Modal -->


        <!-- UPDATE -->
        <?php foreach($pelanggan as $p): ?>
        <div class="modal fade" id="modal-update<?= $p['id_pelanggan'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-update" aria-hidden="true">
            <div class="modal-dialog modal-dialog-slideup" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-info">
                            <h3 class="block-title"><i class="fa fa-users"></i> Update Data Pelanggan</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm">
                        <form action="<?=base_url('ternak/update_pelanggan')?>" method="post">
                        <input type="hidden" value="<?= $p['id_pelanggan'] ?>" name="id_pelanggan">
                                <i class="fa fa-user btn btn-primary btn-sm btn-block"> Nama Pelanggan</i>
                                <input type="text" name="nama" class="form-control text-center" value="<?= $p['nama_pelanggan'] ?>" required><br>
                                <i class="fa fa-book btn btn-primary btn-sm btn-block"> Alamat Pelanggan</i>
                                <input type="text" name="alamat" class="form-control text-center" value="<?= $p['alamat'] ?>" required><br>

                        </div>
                        <div class="block-content block-content-full text-right border-top">
                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-info">Submit</button>
                        </div>
                                    </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <!-- END UPDATE -->

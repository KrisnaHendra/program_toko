<div class="content">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Catatan <small>Cahaya Titan</small></h3>
                            <a href="<?= base_url('admin/note') ?>" class="btn btn-sm btn-warning"><i class="fa fa-angle-left mr-1"></i>Tambah Catatan</a>
                        </div>
                        <div class="block-content block-content-full">
                                <?= $this->session->flashdata('notif'); ?>
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-hover table-striped table-vcenter js-dataTable-full">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px;">#</th>
                                        <th style="width:20%;">Tanggal</th>
                                        <th style="width:100%;">Catatan</th>
                                        <th style="width:80px;" class="text-center"><i class="fa fa-fw fa-trash"></i></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($note as $n): ?>
                                    <tr>
                                        <td class="text-center font-size-sm"><?= $no++; ?></td>
                                        <td><?= date('d M Y',$n['created_at']) ?></td>
                                        <td><?= $n['isi'] ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/delete_catatan/') ?><?= $n['id_catatan'] ?>" class="btn btn-sm btn-danger" onClick="return confirm('Anda yakin ingin menghapus catatan?')"><i class="fa fa-fw fa-trash"></i></a>
                                        </td>
                                        
                                    </tr>
                                    <?php endforeach; ?>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->

                    <!-- END Dynamic Table with Export Buttons -->
                </div>
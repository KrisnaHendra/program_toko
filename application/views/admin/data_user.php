 <!-- Page Content -->
 <div class="content">
                    <!-- Full Table -->
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Data User (Admin & Kasir)</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="modal" data-target="#modal-tambah">
                                    <i class="si si-plus"></i>
                                    <!-- <i class="si si-settings"></i> -->
                                </button>
                            </div>
                        </div>
                        <hr class="m-0">
                        <div class="block-content">
                        <?=$this->session->flashdata('notif');?>
                        <?=form_error('nama', '<h6 class="alert alert-danger text-center"><i class="fa fa-user-times"></i> ', '</h6>');?>
                        <?=form_error('username', '<h6 class="alert alert-danger text-center"><i class="fa fa-user-times"></i> ', '</h6>');?>
                        <?=form_error('password1', '<h6 class="alert alert-danger text-center"><i class="fa fa-user-times"></i> ', '</h6>');?>
                            <!-- <p class="font-size-md text-muted">
                                Tabel ini merupakan tabel yang menunjukkan data administrator dan kasir yang memiliki akses masuk ke halaman sesuai dengan status yang dimiliki user.
                            </p> -->
                            <!-- <p class="font-size-sm text-muted">
                                The first way to make a table responsive is to wrap it with <code>&lt;div class=&quot;table-responsive&quot;&gt;&lt;/div&gt;</code>. This way, the table will be horizontally scrollable and all data will be accessible on smaller screens. You could also append the following modifiers to the <code>table-responsive</code> to apply the horizontal scrolling on different screen widths: <code>-sm</code>, <code>-md</code>, <code>-lg</code>, <code>-xl</code>.
                            </p> -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-center" style="width: 100px;">
                                                <i class="far fa-user"></i>
                                            </th>
                                            <th>Name</th>
                                            <th style="width: 15%;">Username</th>
                                            <th style="width: 25%;">Access</th>
                                            <th style="width: 15%;">Sejak</th>
                                            <th class="text-center" style="width: 100px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($admin as $a): ?>
                                        <tr>
                                            <td>1</td>
                                            <td class="text-center"><img class="img-avatar img-avatar48" src="<?=base_url('assets/admin/')?>assets/media/avatars/avatar7.jpg" alt=""></td>
                                            <td class="font-w600 font-size-sm"><?=$a['nama']?></td>
                                            <td><?=$a['username']?></td>
                                            <td><span class="badge badge-warning">ADMINISTRATOR</span></td>
                                            <td><?=date('d M Y', $a['created_at'])?></td>
                                            <td class="text-center"><a href="" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Admin Permanent"><i class="fa fa-fw fa-address-card"></i></a></td>
                                        </tr>
                                        <?php endforeach;?>
                                        <?php $no = 2;foreach ($user as $u): ?>
                                        <tr>
                                            <td><?=$no++?></td>
                                            <td class="text-center">
                                            <?php if ($u['id_status'] == 1) {?>
                                                <img class="img-avatar img-avatar48" src="<?=base_url('assets/admin/')?>assets/media/avatars/avatar7.jpg" alt="">
                                            <?php } else {?>
                                                <img class="img-avatar img-avatar48" src="<?=base_url('assets/admin/')?>assets/media/avatars/kasir.png" alt="">
                                            <?php }?>
                                            </td>
                                            <td class="font-w600 font-size-sm">
                                                <a href=""><?=$u['nama']?></a>
                                            </td>
                                            <td class="font-size-sm"><?=$u['username']?></td>
                                            <?php if ($u['id_status'] == 1) {?>
                                                <td>
                                                <span class="badge badge-warning">ADMINISTRATOR</span>
                                                </td>
                                            <?php } else {?>
                                                <td>
                                                <span class="badge badge-success">KASIR</span>
                                                </td>
                                            <?php }?>

                                            <td><?=date('d M Y', $u['created_at'])?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <!-- <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </button> -->
                                                    <a href="<?=base_url('admin/delete_user')?>/<?=$u['id_user'];?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Delete" onClick="return confirm('anda yakin?');">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>

                      <!-- Modal Tambah -->
        <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-tambah" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-light">
                            <h3 class="block-title">Tambah User Baru</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm">
                            <form action="<?=base_url('admin/add_user')?>" method="post">
                                <i class="fa fa-archive btn btn-primary btn-sm btn-block"> Fullname</i>
                                <input type="text" name="nama" class="form-control" placeholder="Fullname" required><br>
                                <i class="fa fa-book btn btn-primary btn-sm btn-block"> Username</i>
                                <input type="text" name="username" class="form-control" placeholder="Username" required><br>
                                <i class="fa fa-book btn btn-primary btn-sm btn-block"> Password</i>
                                <input type="password" name="password1" class="form-control" placeholder="Password" required><br>
                                <i class="fa fa-book btn btn-primary btn-sm btn-block"> Repeat Password</i>
                                <input type="password" name="password2" class="form-control" placeholder="Password" required><br>
                                <i class="fa fa-sort-numeric-up btn btn-info btn-sm btn-block"> Status</i>
                                <select name="status" class="form-control" style="">
                                        <option value="1">Administrator</option>
                                        <option value="2">Kasir</option>
                                </select>
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

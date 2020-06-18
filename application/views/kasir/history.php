<div class="content">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">History Transaksi <small><?= $this->session->userdata('nama') ?></small></h3>
                            <a href="" class="btn btn-sm btn-rounded btn-primary"><i class="fa fa-clock mr-2"></i><?= date('d M Y') ?></a>
                        </div>
                        <div class="block-content block-content-full">
                                <?= $this->session->flashdata('notif'); ?>
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-hover table-vcenter js-dataTable-full">
                                <thead>
                                    <tr class="bg-info text-light">
                                        <th class="text-center" style="width: 80px;">#</th>
                                        <th style="">Kode</th>
                                        <th style="">Nama Kasir</th>
                                        <th style="">Nama Pembeli</th>
                                        <th style="">Total</th>
                                        <th style="">Tanggal</th>
                                        <th style="width:10px;">Status</th>
                                        <!-- <th style="" class="text-center"><i class="fa fa-fw fa-trash"></i></th> -->
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($history as $h): ?>
                                    <tr>
                                        <td class="text-center font-size-sm"><?= $no++; ?></td>
                                        <td><a href="" class="font-weight-bold btn btn-sm btn-light text-primary" data-toggle="modal" data-target="#modal-block-large<?=$h['id_transaksi'];?>"><?= $h['kode'] ?></a></td>
                                        <td><?= $h['nama_kasir'] ?></td>
                                        <td><?= $h['nama_pembeli'] ?></td>
                                        <td>Rp. <?= number_format($h['total']) ?></td>
                                        <td><?= date('d M Y',$h['tanggal']) ?></td>
                                        <td class="text-center"><i class="fa fa-check btn btn-sm bg-primary" style="color: white"></i> </td>
                                        
                                    </tr>
                                    <?php endforeach; ?>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->

                    <!-- END Dynamic Table with Export Buttons -->
                </div>

                
                 <!-- Large Block Modal -->
                 <?php $no=1; foreach($history as $h): ?>
        <div class="modal" id="modal-block-large<?=$h['id_transaksi'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-info" style="height:70px;">
                            <h1 class="block-title" style="font-size:25px;">Transaksi (<?=  $h['kode']; ?>)</h3>
                           
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
                                    <td><b><a href=""><?= $h['kode'] ?></b></a></td>
                                </tr>
                                <tr>
                                    <td>Nama Kasir</td>
                                    <td class="text-center">:</td>
                                    <td><?= $h['nama_kasir'] ?></td>
                                <tr>
                                    <td>Tanggal</td>
                                    <td class="text-center">:</td>
                                    <td><?= date('d M Y',$h['tanggal']) ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Pelanggan</td>
                                    <td class="text-center">:</td>
                                    <td><?= $h['nama_pembeli'] ?></td>
                                <tr>
                                    <td><h2 class="font-weight-bold">TOTAL</h2></td>
                                    <td class="text-center">:</td>
                                    <td><h2 class="font-weight-bold">Rp. <?= number_format($h['total']) ?></h2></td>
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
        <?php endforeach; ?>
                 
        <!-- END Large Block Modal -->

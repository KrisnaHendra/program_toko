
                <!-- Hero -->
                <div class="bg-image overflow-hidden" style="background-image: url('assets/admin/assets/media/photos/photo3@2x.jpg');">
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
                </div>
                <!-- END Hero -->

                <!-- Page Content -->
                <div class="content content-narrow">
                    <!-- Stats -->
                    <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                            <a class="block block-rounded block-link-pop border-left border-right border-primary border-4x bg-light text-light" href="<?= base_url('transaksi/history') ?>">
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 font-w600 text-uppercase text-primary text-center">Total Transaksi</div>
                                    
                                    <div class="font-size-h2 font-w600 text-dark text-center">Rp. <?= number_format($sum); ?></div>
                                </div>
                            </a>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="<?= base_url('admin/data_user'); ?>">
                                <div class="block-content block-content-full">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted text-center">Jumlah Admin</div>
                                    <hr style="border:1px solid blue;">
                                    <div class="font-size-h2 font-w400 text-dark text-center"><?= $this->db->count_all('user') ?></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="<?= base_url('barang'); ?>">
                                <div class="block-content block-content-full">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted text-center">jumlah barang</div>
                                    <hr style="border:1px solid blue;">
                                    <div class="font-size-h2 font-w400 text-dark text-center"><?= $this->db->count_all('barang') ?></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="<?= base_url('transaksi/history') ?>">
                                <div class="block-content block-content-full">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted text-center">Jumlah Transaksi</div>
                                    <hr style="border:1px solid blue;">
                                    <div class="font-size-h2 font-w400 text-dark text-center"><?= $this->db->count_all('transaksi') ?></div>
                                </div>
                            </a>
                        </div> 
                    </div>

                   
                    <!-- END Stats -->
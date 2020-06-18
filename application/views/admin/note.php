<div class="content">
<h2 class="content-heading">Catatan - Cahaya Titan</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Progress Wizard -->
                            <div class="js-wizard-simple block block">
                                <!-- Step Tabs -->
                                <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                                    <!-- <li class="nav-item">
                                        <a class="nav-link active" href="#wizard-progress-step1" data-toggle="tab">1. Pelangan</a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="#wizard-progress-step2" data-toggle="tab">NOTE</a>
                                    </li>
                                    
                                </ul>
                                <!-- END Step Tabs -->

                                <!-- Form -->
                                <form action="<?= base_url('admin/add_note') ?>" method="POST">
                                    <!-- Wizard Progress Bar -->
                                    <div class="block-content block-content-sm">
                                        <div class="progress" data-wizard="progress" style="height: 8px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!-- END Wizard Progress Bar -->

                                    <!-- Steps Content -->
                                    <div class="block-content block-content-full tab-content px-md-5" style="min-height: 300px;">
                                        <!-- Step 1 -->
                                        <div class="tab-pane active" id="wizard-progress-step1" role="tabpanel">
                                            <div class="form-group">
                                                <label for="wizard-progress-firstname">Nama Pelanggan</label>
                                                <input class="form-control" type="text" id="wizard-progress-firstname" name="wizard-progress-firstname">
                                            </div>
                                            <div class="form-group">
                                                <label for="wizard-progress-lastname">Alamat</label>
                                                <input class="form-control" type="text" id="wizard-progress-lastname" name="wizard-progress-lastname">
                                            </div>
                                            <div class="form-group">
                                                <label for="wizard-progress-email">Telepon</label>
                                                <input class="form-control" type="number" id="wizard-progress-email" name="wizard-progress-email">
                                            </div>
                                        </div>
                                        <!-- END Step 1 -->

                                        <!-- Step 2 -->
                                        <div class="tab-pane" id="wizard-progress-step2" role="tabpanel">
                                            <div class="form-group">
                                                <label for="wizard-progress-bio">Catatan</label>
                                                <textarea class="form-control" id="wizard-progress-bio" name="catatan" rows="7"></textarea> <br>
                                                <b class="text-danger">*NB: Catatan kosong akan tersimpan</b>
                                            </div>
                                        </div>
                                        <!-- END Step 2 -->

                                        <!-- Step 3 -->
                                        <div class="tab-pane" id="wizard-progress-step3" role="tabpanel">
                                            <div class="form-group">
                                                <label for="wizard-progress-location">Location</label>
                                                <input class="form-control" type="text" id="wizard-progress-location" name="wizard-progress-location">
                                            </div>
                                            <div class="form-group">
                                                <label for="wizard-progress-skills">Skills</label>
                                                <select class="form-control" id="wizard-progress-skills" name="wizard-progress-skills">
                                                    <option value="">Please select your best skill</option>
                                                    <option value="1">Photoshop</option>
                                                    <option value="2">HTML</option>
                                                    <option value="3">CSS</option>
                                                    <option value="4">JavaScript</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox custom-control-primary">
                                                    <input type="checkbox" class="custom-control-input" id="wizard-progress-terms" name="wizard-progress-terms">
                                                    <label class="custom-control-label" for="wizard-progress-terms">Agree with the terms</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Step 3 -->
                                    </div>
                                    <!-- END Steps Content -->

                                    <!-- Steps Navigation -->
                                    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="<?= base_url('admin/lihat_catatan') ?>" class="btn btn-info"><i class="fa fa-angle-left mr-1"></i>LIHAT CATATAN</a>
                                                <!-- <button type="button" class="btn btn-secondary" data-wizard="prev">
                                                    <i class="fa fa-angle-left mr-1"></i> Previous
                                                </button> -->
                                            </div>
                                            <div class="col-6 text-right">
                                                <button type="button" class="btn btn-secondary" data-wizard="next">
                                                    Next <i class="fa fa-angle-right ml-1"></i>
                                                </button>
                                                <button type="submit" class="btn btn-primary d-none js-swal-success push" data-wizard="finish">
                                                    <i class="fa fa-check mr-1"></i> SAVE NOTE
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Steps Navigation -->
                                </form>
                                <!-- END Form -->
                            </div>
                            <!-- END Progress Wizard -->
                        </div>
                        
                    </div>
</div>
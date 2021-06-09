    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="container-fluid"> 
         <!-- Content Row -->
                  <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-6">
                      <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <a href="<?= base_url('admin/barang') ?>">
                                  <div class="text-lg font-weight-bold text-primary text-uppercase mb-2">Barang</div>
                                    <?php if($jumlahBarang == 0) : ?>
                                   <div class="h5 mb-0 font-weight-bold text-gray-300"><?= $jumlahBarang; ?></div>
                                    <?php else : ?>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text--800"><?= $jumlahBarang; ?></div>
                                    <?php endif; ?> 
                                 
                                </div>    
                              </a>
                              
                            <div class="col-auto">
                              <i class="fas fa-archive fa-2x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-6">
                      <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <a href="<?= base_url('admin/permohonan') ?>">
                                  <div class="text-lg font-weight-bold text-success text-uppercase mb-1">Permohonan</div>
                                    <?php if($jumlahPermohonan == 0) : ?>
                                   <div class="h5 mb-0 font-weight-bold text-gray-300"><?= $jumlahPermohonan; ?></div>
                                    <?php else : ?>
                                    <div class="h4 mb-0 mr-3 font-weight-bold text-danger"><?= $jumlahPermohonan; ?></div>
                                    <?php endif; ?> 
                              </a>
                            </div>
                              
                            <div class="col-auto">
                              <i class="far fa-share-square fa-2x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-6">
                      <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <a href="<?= base_url('admin/pengembalian') ?>">
                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Pengembalian</div>
                                <div class="row no-gutters align-items-center">
                                  <div class="col-auto">
                                    
                                    <?php if($jumlahPengembalian == 0) : ?>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-300"><?= $jumlahPengembalian; ?></div>
                                    <?php else : ?>
                                    <div class="h4 mb-0 mr-3 font-weight-bold text-danger"><?= $jumlahPengembalian; ?></div>
                                    <?php endif; ?>    
                              </a>
                               
                                </div>
                                <div class="col">
                                  <!-- <div class="progress progress-sm mr-2">
                                  	<?php
                                  		$min = 0;
                                  		$max=100;

                                  	 ?>
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="<?= $jumlahPengembalian; ?>" aria-valuemin="'.$min.'" aria-valuemax="'.$max.'"></div>
                                  </div> -->
                                </div>
                              </div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-undo fa-2x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-6">
                      <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-lg font-weight-bold text-warning text-uppercase mb-1">User</div>
                              	<?php if($jumlahUser == 0) : ?>
                               <div class="h5 mb-0 font-weight-bold text-gray-300"><?= $jumlahUser; ?></div>
                                <?php else : ?>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jumlahUser; ?></div>
                                <?php endif; ?> 
                              
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Content Row -->
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


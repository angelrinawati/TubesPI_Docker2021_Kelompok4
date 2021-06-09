<div class="container-fluid">
                        
                        <div class="card">
                          <h5 class="card-header"><?= $title; ?></h5>
                          <div class="card-body">

                           
                            <div class="row">
                              <div class="col-md-4">
                                <img src="<?= base_url('assets/img/profile/') . $barang['gambar']; ?>" class="card-img-top">
                              </div>
                              <div class="col-md-8">
                                <table class="table">
                                  <tr>
                                    <td>Nama Barang</td>
                                    <td><strong><?= $barang['name']; ?></strong></td>
                                  </tr>

                                  <tr>
                                    <td>Keterangan</td>
                                    <td><strong><?= $barang['desc']; ?></strong></td>
                                  </tr>

                                  <tr>
                                    <td>Stok</td>
                                    <td><strong><?= $barang['stock']; ?></strong></td>
                                  </tr>
                                  
                                </table>
                                <!-- <?php echo anchor('dashboard/tambah_ke_keranjang/'.$barang->id_barang,'<div class="btn btn-sm btn-primary">Tambah ke Keranjang</div>') ?> -->

                                <?php echo anchor('user/databarang','<div class="btn btn-sm btn-danger">Kembali</div>') ?>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                      </div>
              <!-- End of Main Content -->

              <!-- Begin Page Content -->
              <div class="container-fluid">

                
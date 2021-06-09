        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <!--Tabel-->
            <div class="row">
                <div class="col-lg">

                    <!-- Kalau Gagal Nambah Data -->
                    <?php if(validation_errors()) : ?>
                      <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>       
                      </div>
                    <?php endif; ?>

                    <!-- Kalau berhasil Nambah Data -->
                    <?= $this->session->flashdata('message'); ?> 
                    
                    <table class="table table-hover" style="text-align: center;">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Email</th>
                              <th scope="col">Tanggal Pinjam</th>
                              <th scope="col">Tanggal Pengembalian</th>
                              <th scope="col">Barang</th>
                              <th scope="col">Jumlah</th>
                              <th scope="col">Tujuan</th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1; ?>
                            <?php foreach($permohonan as $p) : ?>
                            <tr>
                              <th scope="row"><?= $i; ?></th>
                              <td><?= $p['full_name']; ?></td>
                              <td><?= $p['email']; ?></td>
                              <td><?= $p['awal_pinjam']; ?></td>
                              <td><?= $p['akhir_pinjam']; ?></td>
                              <td><?= $p['name']; ?></td>
                              <td><?= $p['jumlah']; ?></td>
                              <td><?= $p['tujuan']; ?></td>

                              <td>
                                <form action="<?= base_url('admin/permohonan_setuju'); ?>" method="post">
                                  <input type="hidden" name="id_pinjam" value="<?= $p['id_pinjam'] ?>">
                                  <input type="hidden" name="full_name" value="<?= $p['full_name'] ?>">
                                  <input type="hidden" name="name" value="<?= $p['name'] ?>">
                                  <input type="hidden" name="jumlah" value="<?= $p['jumlah'] ?>">
                                  <input type="hidden" name="awal_pinjam" value="<?= $p['awal_pinjam'] ?>">
                                  <input type="hidden" name="akhir_pinjam" value="<?= $p['akhir_pinjam'] ?>">
                                  <input type="hidden" name="email" value="<?= $p['email'] ?>">
                                  <button class="btn btn-success" type="submit"><i class="fa fa-check"></i></button>
                                </form>
                              </td>
                              <td>
                                <form action="<?= base_url('admin/permohonan_tolak'); ?>" method="post">
                                  <input type="hidden" name="id_pinjam" value="<?= $p['id_pinjam'] ?>">
                                  <input type="hidden" name="full_name" value="<?= $p['full_name'] ?>">
                                  <input type="hidden" name="name" value="<?= $p['name'] ?>">
                                  <input type="hidden" name="jumlah" value="<?= $p['jumlah'] ?>">
                                  <input type="hidden" name="awal_pinjam" value="<?= $p['awal_pinjam'] ?>">
                                  <input type="hidden" name="akhir_pinjam" value="<?= $p['akhir_pinjam'] ?>">
                                  <input type="hidden" name="email" value="<?= $p['email'] ?>">
                                  <button class="btn btn-danger" type="submit"><i class="fa fa-times"></i></button>
                                </form>
                              </td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach;?>

                          </tbody>
                    </table>

                </div>  
            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
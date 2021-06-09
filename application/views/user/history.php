<!-- Begin Page Content -->
                  <div class="container-fluid">

                      <!-- Page Heading -->
                      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                      <div class="row">
                          <div class="col-lg-8">
                              <?= $this->session->flashdata('message'); ?>
                          </div>
                      </div>

                        <table class="table table-hover" style="text-align: center;">
                          <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Jumlah</th>
                                 <th scope="col">Tanggal Peminjaman</th>
                                 <th scope="col">Tanggal Pengembalian</th>
                                 <th scope="col">Status</th>
                              </tr>
                          </thead>
                                  <tbody>
                                    <?php $i=1; ?>
                                    <?php foreach($barang as $brg): ?>
                                    <tr>
                                      <th scope="row">
                                        <?= $i; ?>
                                          <div class="hidden">
                                              <?= $this->session->userdata($brg['email']); ?>
                                          </div>
                                        </th>
                                      <td><?= $brg['name']; ?></td>
                                      <td><?= $brg['jumlah']; ?></td>
                                      <td><?= $brg['awal_pinjam']; ?></td>
                                      <td><?= $brg['akhir_pinjam']; ?></td>
                                      <td>
                                        <?php if($brg['status'] == 0 ) : ?> 
                                        <a href="" class="badge badge-warning">Diproses</a>
                                        <?php elseif($brg['status'] == 1) : ?>
                                        <a href="" class="badge badge-success">Diterima</a>
                                        <!-- <a href="<?= base_url('user/kembalikan'); ?>" class="badge badge-primary">Kembalikan</a> -->
                                        <a href="<?= base_url(); ?>user/kembalikan/<?= $brg['id_pinjam']; ?>" class="badge badge-primary">Kembalikan</a>
                                        <?php elseif($brg['status'] == 2) : ?>
                                          <a href="" class="badge badge-danger">Ditolak</a>
                                        <?php elseif($brg['status'] == 3) : ?>
                                          <a href="" class="badge badge-warning">Proses Pengembalian</a>
                                        <?php else : ?>
                                        <a href="" class="badge badge-dark">Selesai</a>
                                        <?php endif; ?> 
                                      </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                                  </tbody>
                        </table>


                  <!-- /.container-fluid -->

              </div>
              <!-- End of Main Content -->
            </div>
                
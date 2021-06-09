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
                          <th scope="col">Alamat</th>
                          <th scope="col">Tanggal Pinjam</th>
                          <th scope="col">Barang</th>
                          <th scope="col">Jumlah</th>
                          <th scope="col">Tujuan</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($history as $h) : ?>
                        <tr>
                          <th scope="row"><?= $i; ?></th>
                          <td><?= $h['full_name']; ?></td>
                          <td><?= $h['email']; ?></td>
                          <td><?= $h['address']; ?></td>
                          <td><?= $h['awal_pinjam']; ?></td>
                          <td><?= $h['name']; ?></td>
                          <td><?= $h['jumlah']; ?></td>
                          <td><?= $h['tujuan']; ?></td>

                          <td>
                            <?php if($h['status'] == 1 ) : ?> 
                            <a href="" class="badge badge-warning">Berlangsung</a>
                            <?php elseif($h['status'] == 4) : ?>
                            <a href="" class="badge badge-dark">Selesai</a>
                            
                            
                            <?php endif; ?> 
                          
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
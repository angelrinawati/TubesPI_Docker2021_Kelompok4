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
                      <td>Jumlah</td>
                      <td><strong><?= $barang['jumlah']; ?></strong></td>
                    </tr>

                    <tr>
                      <td>Tanggal Pinjam</td>
                      <td><strong><?= $barang['awal_pinjam']; ?></strong></td>
                    </tr>
                    <tr>
                      <td>Tanggal Pengembalian</td>
                      <td><strong><?= $barang['akhir_pinjam']; ?></strong></td>
                    </tr>
                    
                  </table>
                  <div>
                    <?php echo anchor('user/historypeminjaman','<div class="btn btn-sm btn-danger mr-3">Kembali</div>') ?>
                  
                    <?php echo anchor('user/serahkan/'.$barang['id_pinjam'],'<div class="btn btn-sm btn-success">Serahkan</div>') ?>
                  </div>

                  
                </div>
                
              </div>
            </div>
          </div>
        </div>
<!-- End of Main Content -->

<!-- Begin Page Content -->
<div class="container-fluid">

  
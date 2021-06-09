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

                <!-- Tambah Data -->
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newDataModal">Add New Data</a>

                <table class="table table-hover" style="text-align: center;">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama Barang</th>
                          <th scope="col">Deskripsi</th>
                          <th scope="col">Stok</th>
                          <th scope="col">Gambar</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(empty($barang)) : ?>
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-danger" role="alert">
                                      Data Not Found!
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php $i = 1; ?>
                        <?php foreach($barang as $b) : ?>
                        <tr>
                          <th scope="row"><?= $i; ?></th>
                          <td><?= $b['name']; ?></td>
                          <td><?= $b['desc']; ?></td>
                          <td><?= $b['stock']; ?></td>
                          <td class="col-lg-2"> <img src="<?= base_url('assets/img/profile/') . $b['gambar']; ?>" class="img-thumbnail"></td>
                          <td>
                            <a href="<?= base_url('admin/editBarang/') . $b['id_barang'] ; ?>" class="btn btn-success">Edit</a>
                            <a href="<?= base_url('admin/deleteBarang/') . $b['id_barang'] ; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data?');">Delete</a>
                          </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach;?>

                      </tbody>
                </table>
                <?= $this->pagination->create_links(); ?>

            </div>  
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Tambah Data-->
<div class="modal fade" id="newDataModal" tabindex="-1" aria-labelledby="newDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newDataModalLabel">Add New Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <?= form_open_multipart('admin/barang'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Nama Barang" id="name">
                    </div>

                    <div class="form-group">
                        <input type="text" name="desc" class="form-control" placeholder="Deskripsi Barang" id="desc">
                    </div>
                    <div class="form-group">
                        <input type="text" name="stock" class="form-control" placeholder="Stock Barang" id="stock">
                    </div>

                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="gambar" id="gambar">
                            <label class="custom-file-label" for="gambar">Pilih Gambar</label>
                        </div>  
                    </div> 
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
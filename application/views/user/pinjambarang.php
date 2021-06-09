<!-- Begin Page Content -->
  <div class="container-fluid">
    
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
          <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card">
      <h5 class="card-header"><?= $barang['name']; ?></h5>
      <div class="card-body">

        <div class="card ml-5 mb-5" style="width: 16rem;">
          <img src="<?= base_url('assets/img/profile/') . $barang['gambar']; ?>" class="card-img-top" alt="...">
        </div>
        <form action="" method="post">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="nama">Full Name</label>
            <input type="hidden" class="form-control" id="id_brg" name="id_brg" value="<?= $barang['id_barang']; ?>" readonly>
            <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $user['id']; ?>" readonly>
            <input type="text" class="form-control" id="nama" name="nama">
              <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="job">Job</label>
            <input type="text" class="form-control" id="job" name="job">
            <?= form_error('job', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address">
            <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="jumlah">Number of Borrowers</label>
            <input type="hidden" class="form-control" id="stock" name="stock" value="<?= $barang['stock']; ?>" readonly>
            <input type="text" class="form-control" id="jumlah" name="jumlah">
            <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="awal">Tanggal Peminjaman</label>
              <input type="date" class="form-control" id="awal" name="awal">
              <?= form_error('awal', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="kembali">Tanggal Pengembalian</label>
              <input type="date" class="form-control" id="kembali" name="kembali">
              <?= form_error('kembali', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="tujuan">Purpose of Borrowers</label>
            <textarea class="form-control" id="tujuan" name="tujuan" rows="3"></textarea>
              <?= form_error('tujuan', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>

          <div class="col-sm-6" style="margin-left: 30%;">
            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Pinjam Barang</button> 

          </div>
        </form>
      </div>
    </div>
  </div>
<!-- End of Main Content -->

<!-- Begin Page Content -->
<div class="container-fluid">

                
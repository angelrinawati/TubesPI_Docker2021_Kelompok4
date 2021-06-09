<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<div class="row">
    <div class="col-lg-8">
        <?= $this->session->flashdata('message'); ?>
    </div>
</div>
<div class="row text-center mt-5 ml-5">
    <?php foreach ($barang as $brg) : ?>
      <div class="card ml-5 mb-5" style="width: 16rem;">
        <img src="<?= base_url('assets/img/profile/') . $brg['gambar']; ?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title mb-1"><?= $brg['name']; ?></h5>
          <small><?= $brg['desc']; ?></small><br>
          <span class="badge badge-pill badge-success mb-3">Stock: <?= $brg['stock']; ?></span>
          <div></div>
          <?php echo anchor('user/pinjam/'.$brg['id_barang'],'<div class="btn btn-sm btn-primary">Pinjam Barang</div>') ?>

           <?php echo anchor('user/detail/'.$brg['id_barang'],'<div class="btn btn-sm btn-secondary">Detail</div>') ?>
           <!-- <div class="btn btn-sm btn-primary">Pinjam</div>
           <div class="btn btn-sm btn-secondary">Detail</div> -->
           <!-- <div></div>

          <a href="" class="badge badge-success" style="width: 100px; margin-left: 10px;">edit</a>
          <a href="" class="badge badge-danger" style="width: 100px; margin-right: 10px;">hapus</a> -->
          
        </div>
                      
      </div>

    <?php endforeach; ?>    
  </div>

</div>
</div>
<!-- /.container-fluid -->







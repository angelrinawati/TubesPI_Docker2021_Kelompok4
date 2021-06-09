    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">
        	<div class="col-lg-8">
        		<?php foreach ($barang as $b) : ?>
        			<?= form_open_multipart(); ?>
        				<div class="form-group row">
        					<label for="name" class="col-sm-2 col-form-label">Nama Barang</label>
        					<div class="col-sm-10">
        						<input type="hidden" name="id_barang" class="form-control" value="<?php echo $b->id_barang; ?>">
        						<input type="text" name="name" id="name" class="form-control" value="<?= $b->name; ?>">
                                <?= form_error('name','<small class="text-danger pl-3">','</small>'); ?>
        					</div>
        				</div>
        				<div class="form-group row">
        					<label for="desc" class="col-sm-2 col-form-label">Kondisi Barang</label>
        					<div class="col-sm-10">
        						<input type="text" name="desc" id="desc" class="form-control" value="<?= $b->desc; ?>">
                                <?= form_error('desc','<small class="text-danger pl-3">','</small>'); ?>
        					</div>
        				</div>
        				<div class="form-group row">
        					<label for="stock" class="col-sm-2 col-form-label">Stock Barang</label>
        					<div class="col-sm-10">
        						<input type="text" name="stock" id="stock" class="form-control" value="<?= $b->stock; ?>">
                                <?= form_error('stock','<small class="text-danger pl-3">','</small>'); ?>
        					</div>
        				</div>

        				<div class="form-group row">
        					<div class="col-sm-2">Gambar</div>
        					<div class="col-sm-10">
        						<div class="row">
        							<div class="col-sm-3">
        								<img src="<?= base_url('assets/img/profile/') . $b->gambar; ?>" class="img-thumbnail">
        							</div>
        							<div class="col-sm-9">
        								<div class="custom-file">
        									<input type="hidden" class="custom-file-input" name="old_image" id="old_image" value="<?= $b->gambar; ?>">
        									<input type="file" class="custom-file-input" name="gambar" id="gambar">
        									<label class="custom-file-label" for="gambar">Choose File</label>
        								</div>	
        							</div>
        						</div>
        					</div>
        				</div>
        				<div class="form-group row justify-content-end">
        					<div class="col-sm-10">
        						<button type="submit" class="btn btn-primary">Edit</button>
        					</div>
        				</div>
        			<?= form_close(); ?>
        		<?php endforeach;  ?>
        	</div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->


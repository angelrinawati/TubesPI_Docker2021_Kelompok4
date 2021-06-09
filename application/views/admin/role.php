                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <!--Tabel-->
                    <div class="row">
                    	<div class="col-lg-6">

                    		<!-- Kalau Gagal Nambah Data -->
                    		<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ; ?>

                    		<!-- Kalau berhasil Nambah Data -->
                    		<?= $this->session->flashdata('message'); ?> 

                    		<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>
                    		
                    		<table class="table table-hover" style="text-align: center;">
                    			<thead>
                    			    <tr>
                    			      <th scope="col">#</th>
                    			      <th scope="col">Role</th>
                    			      <th scope="col">Action</th>
                    			    </tr>
                    			  </thead>
                    			  <tbody>
                    			  	<?php $i = 1; ?>
                    			  	<?php foreach($role as $r) : ?>
                    			    <tr>
                    			      <th scope="row"><?= $i; ?></th>
                    			      <td><?= $r['role']; ?></td>
                    			      <td>
                                        <a href="<?= base_url('admin/roleaccess/') . $r['id'] ; ?>" class="badge badge-warning">Acces</a>
                    			      	<a href="<?= base_url('admin/deleteRole/') . $r['id'] ; ?>" class="badge badge-danger" onclick="return confirm('Anda yakin ingin menghapus data?');">Delete</a>
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


<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
      </div>

      <form action="<?= base_url('admin/role'); ?>" method="post">

      	<div class="modal-body">

			<div class="form-group">
				<input type="text" name="role" class="form-control" placeholder="Role Name" id="role">
			</div>   		

      	</div>

      	<div class="modal-footer">
      	  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      	  <button type="submit" class="btn btn-primary">Add</button>
      	</div>

      </form>
      
    </div>
  </div>
</div>

            
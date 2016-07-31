<?php if (isset($_SESSION['pesan'])) { ?>
  <div class="alert alert-block alert-info" role="alert">
    <button type="button" class="close" data-dismiss="alert">
      <i class="ace-icon fa fa-times"></i>
    </button>
    <?php echo $this->session->flashdata('pesan'); ?>
  </div>
<?php } ?>
<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Input Data Status Gigi</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form action="<?php echo base_url().'status_gigi/tambah'; ?>" method="POST" class="form-horizontal" style="margin-top:10px" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="kode_status">Kode Status</label>
						<div class="col-sm-4">
							<input type="text" id="kode_status" class="form-control" name="kode_status" required autofocus/>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="status">Status</label>
						<div class="col-sm-4">
						    <input type="type" id="status" class="form-control" name="status" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="gambar">Gambar</label>
						<div class="col-sm-4">
						    <input type="file" id="gambar" class="form-control" name="gambar" required>
						</div>
					</div>
					
					<div class="col-md-offset-2 col-md-5">
				        <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-plus"></i> Insert</button>&nbsp;
				        <button type="reset" class="btn btn-flat btn-default"><i class="fa fa-refresh"></i> Cancel</button>
				    </div> 	               	   			              						              	
				</form>
			</div>
		</div>
	</div>

	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Data Status Gigi</h3>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		    		<div class="row">
			    	<div class="col-sm-12">
			        	<table id="example1" class="table table-bordered table-striped">
				            <thead>
				                <tr>
					                <th>Kode</th>
					                <th>Status</th>
					                <th>Gambar</th>
					                <th style="width:15%;">Aksi</th>
					            </tr>
				            </thead>
				        	<tbody>
				        		<?php foreach ($status_gigi as $sg): ?>
                  				<tr>
                    				<td><?php echo $sg->KODE_STATUS; ?></td>
                    				<td><?php echo $sg->STATUS; ?></td>
                    				<td align="center">
                    					<img src="<?php echo base_url().'assets/images/odontogram/'.$sg->GAMBAR; ?>" height="25px">
                					</td>
                    				<td align="center">
                    					<button type="submit" class="btn btn-flat btn-warning btn-xs" data-toggle="modal" 
                    						data-target="#myModal" onclick="edit('<?php echo $sg->KODE_STATUS; ?>', 
                    						'<?php echo $sg->STATUS; ?>', '<?php echo $sg->GAMBAR; ?>')">
                    						<i class="fa fa-edit"></i> Ubah 
                    					</button>
                					</td>
                  				</tr>
				        		<?php endforeach ?>
		                   </tbody>
                		</table>
		       	 	</div>
		    		</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--MODAL-->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Ubah Data Jenis Obat</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>status_gigi/edit" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-gambar">Pratinjau Gambar</label>
						<div class="col-sm-9">
						    <img src="" id="e-prev_gambar" height="150px">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-kode_status">Kode Status</label>
						<div class="col-sm-9">
							<input type="text" id="e-kode_status" class="form-control" name="e-kode_status" readonly required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-status">Status</label>
						<div class="col-sm-9">
						    <input type="type" id="e-status" class="form-control" name="e-status" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-gambar">Ubah Gambar</label>
						<div class="col-sm-9">
						    <input type="file" id="e-gambar" class="form-control" name="e-gambar">
						</div>
					</div>
	        
					<div class="modal-footer">
						<button type="button" class="btn btn-flat btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
						<button type="submit" class="btn btn-flat btn-warning"><i class="fa fa-edit"></i>  Ubah Data</button>
					</div>
				</form>
			</div>           					
		</div>
	</div>
</div>
<!--END MODAL-->

<script type="text/javascript">
	function edit(id, nama, gambar) {
		$('#e-kode_status').val(id);
		$('#e-status').val(nama);
		$('#e-prev_gambar').prop("src", "<?php echo base_url().'assets/images/odontogram/'; ?>" + gambar);
	}
</script>
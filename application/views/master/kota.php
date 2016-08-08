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
				<h3 class="box-title">Input Data Kota</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form action="<?php echo base_url().'kota/tambah'; ?>" method="POST" class="form-horizontal" style="margin-top:10px">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="id">Kode Kota</label>
						<div class="col-sm-4">
							<input type="text" id="id" class="form-control" name="id_kota" value="<?php echo $kodekota; ?>" readonly required />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="nama">Nama Kota</label>
						<div class="col-sm-4">
						    <input type="type" id="nama" class="form-control" name="nm_kota" required autofocus>
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
				<h3 class="box-title">Data Kota</h3>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		    		<div class="row">
			    	<div class="col-sm-12">
			        	<table id="example1" class="table table-bordered table-striped">
				            <thead>
				                <tr>
					                <th>Kode Kota</th>
					                <th>Nama Kota</th>
					                <th style="width:15%;">Aksi</th>
					            </tr>
				            </thead>
				        	<tbody>
				        		<?php foreach ($kota as $k): ?>
                  				<tr>
                    				<td><?php echo $k->ID_KOTA; ?></td>
                    				<td><?php echo $k->NM_KOTA; ?></td>
                    				<td align="center">
                    					<button type="button" class="btn btn-flat btn-warning btn-xs" data-toggle="modal" 
                    						data-target="#myModal" onclick="edit('<?php echo $k->ID_KOTA; ?>', '<?php echo $k->NM_KOTA; ?>')">
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
				<h4 class="modal-title" id="exampleModalLabel">Ubah Data Kota</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>kota/edit" class="form-horizontal">
					<div class="form-group">
	              		<label for="message-text" class="col-sm-3 control-label">Kode Kota</label>
	              		<div class="col-sm-9">
	                		<input type="text" class="form-control" name="editkode" id="editkode" readonly required>
	                    </div>
	            	</div>

	            	<div class="form-group">
	              		<label for="message-text" class="col-sm-3 control-label">Nama Kota</label>
	              		<div class="col-sm-9">
	                		<input type="text" class="form-control" name="editnama" id="editnama" required>
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
	function edit(id, nama) {
		$('#editkode').val(id);
		$('#editnama').val(nama);
	}
</script>
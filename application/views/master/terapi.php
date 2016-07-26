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
				<h3 class="box-title">Input Data Terapi</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form action="<?php echo base_url().'terapi/tambah'; ?>" method="POST" class="form-horizontal" style="margin-top:10px">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="id_terapi">Kode Terapi</label>
						<div class="col-sm-4">
							<input type="text" id="id_terapi" class="form-control" name="id_terapi" value="<?php echo $kodeterapi; ?>" readonly required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="nm_terapi">Terapi</label>
						<div class="col-sm-4">
						    <input type="type" id="nm_terapi" class="form-control" name="nm_terapi" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="ket_terapi">Keterangan</label>
						<div class="col-sm-4">
						    <textarea id="ket_terapi" class="form-control" name="ket_terapi"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="harga_terapi">Harga Terapi</label>
						<div class="col-sm-4">
						    <div class="input-group">
		                  		<div class="input-group-addon">
		                    		<i class="">Rp</i>
		                  		</div>
		                  		<input type="number" class="form-control" name="harga_terapi" id="harga_terapi" min="0" required>
		                	</div>
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
				<h3 class="box-title">Data Terapi</h3>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		    		<div class="row">
			    	<div class="col-sm-12">
			        	<table id="example1" class="table table-bordered table-striped">
				            <thead>
				                <tr>
					                <th>Kode</th>
					                <th>Terapi</th>
					                <th>Keterangan</th>
					                <th>Harga</th>
					                <th style="width:15%;">Aksi</th>
					            </tr>
				            </thead>
				        	<tbody>
				        		<?php foreach ($terapi as $t): ?>
                  				<tr>
                    				<td><?php echo $t->ID_TERAPI; ?></td>
                    				<td><?php echo $t->NM_TERAPI; ?></td>
                    				<td><?php echo $t->KET_TERAPI; ?></td>
                    				<td>Rp<?php echo number_format($t->HARGA_TERAPI, 2, ",", "."); ?></td>
                    				<td align="center">
                    					<button type="submit" class="btn btn-flat btn-warning btn-xs" data-toggle="modal" 
                    						data-target="#myModal" onclick="edit('<?php echo $t->ID_TERAPI; ?>', 
                    						'<?php echo $t->NM_TERAPI; ?>', '<?php echo $t->KET_TERAPI; ?>', 
                    						'<?php echo $t->HARGA_TERAPI; ?>')">
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
				<h4 class="modal-title" id="exampleModalLabel">Ubah Data Terapi</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>terapi/edit" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-id_terapi">Kode Terapi</label>
						<div class="col-sm-9">
							<input type="text" id="e-id_terapi" class="form-control" name="e-id_terapi" readonly required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-nm_terapi">Terapi</label>
						<div class="col-sm-9">
						    <input type="type" id="e-nm_terapi" class="form-control" name="e-nm_terapi" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-ket_terapi">Keterangan</label>
						<div class="col-sm-9">
						    <textarea id="e-ket_terapi" class="form-control" name="e-ket_terapi"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-harga_terapi">Harga Terapi</label>
						<div class="col-sm-9">
						    <div class="input-group">
		                  		<div class="input-group-addon">
		                    		<i class="">Rp</i>
		                  		</div>
		                  		<input type="number" class="form-control" name="e-harga_terapi" id="e-harga_terapi" min="0" required>
		                	</div>
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
	function edit(id, nama, ket, harga) {
		$('#e-id_terapi').val(id);
		$('#e-nm_terapi').val(nama);
		$('#e-ket_terapi').val(ket);
		$('#e-harga_terapi').val(harga);
	}
</script>
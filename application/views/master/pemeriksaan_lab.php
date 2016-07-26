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
				<h3 class="box-title">Input Data Pemeriksaan Lab</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form action="<?php echo base_url().'pemeriksaan_lab/tambah'; ?>" method="POST" class="form-horizontal" style="margin-top:10px">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="id_lab">Kode Lab</label>
						<div class="col-sm-4">
							<input type="text" id="id_lab" class="form-control" name="id_lab" value="<?php echo $kodepemeriksaan_lab; ?>" readonly required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="lab">Nama Lab</label>
						<div class="col-sm-4">
						    <input type="type" id="lab" class="form-control" name="lab" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="harga">Harga Pemeriksaan</label>
						<div class="col-sm-4">
						    <div class="input-group">
		                  		<div class="input-group-addon">
		                    		<i class="">Rp</i>
		                  		</div>
		                  		<input type="number" class="form-control" name="harga" id="harga" min="0" required>
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
				<h3 class="box-title">Data pemeriksaan_lab</h3>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		    		<div class="row">
			    	<div class="col-sm-12">
			        	<table id="example1" class="table table-bordered table-striped">
				            <thead>
				                <tr>
					                <th>Kode Lab</th>
					                <th>Nama Lab</th>
					                <th>Harga Pemeriksaan</th>
					                <th style="width:15%;">Aksi</th>
					            </tr>
				            </thead>
				        	<tbody>
				        		<?php foreach ($pemeriksaan_lab as $pl): ?>
                  				<tr>
                    				<td><?php echo $pl->ID_LAB; ?></td>
                    				<td><?php echo $pl->LAB; ?></td>
                    				<td><?php echo number_format($pl->HARGA, 2, ",", "."); ?></td>
                    				<td align="center">
                    					<button type="submit" class="btn btn-flat btn-warning btn-xs" data-toggle="modal" 
                    						data-target="#myModal" onclick="edit('<?php echo $pl->ID_LAB; ?>', 
                    						'<?php echo $pl->LAB; ?>', <?php echo $pl->HARGA; ?>)">
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
				<h4 class="modal-title" id="exampleModalLabel">Ubah Data Pemeriksaan Lab</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>pemeriksaan_lab/edit" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="e-id_lab">Kode Lab</label>
						<div class="col-sm-10">
							<input type="text" id="e-id_lab" class="form-control" name="e-id_lab" readonly required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="e-lab">Nama Lab</label>
						<div class="col-sm-10">
						    <input type="type" id="e-lab" class="form-control" name="e-lab" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="e-harga">Harga Pemeriksaan</label>
						<div class="col-sm-10">
						    <div class="input-group">
		                  		<div class="input-group-addon">
		                    		<i class="">Rp</i>
		                  		</div>
		                  		<input type="number" class="form-control" name="e-harga" id="e-harga" min="0" required>
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
	function edit(id, nama, harga) {
		$('#e-id_lab').val(id);
		$('#e-lab').val(nama);
		$('#e-harga').val(harga);
	}
</script>
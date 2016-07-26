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
				<h3 class="box-title">Input Data Nomenklatur</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form action="<?php echo base_url().'nomenklatur/tambah'; ?>" method="POST" class="form-horizontal" style="margin-top:10px">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="nomor">Nomor</label>
						<div class="col-sm-4">
							<input type="text" id="nomor" class="form-control" name="nomor" value="<?php echo $kodenomenklatur; ?>" readonly required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="nama">Nama</label>
						<div class="col-sm-4">
						    <input type="type" id="nama" class="form-control" name="nama" required autofocus>
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
				<h3 class="box-title">Data Nomenklatur</h3>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		    		<div class="row">
			    	<div class="col-sm-12">
			        	<table id="example1" class="table table-bordered table-striped">
				            <thead>
				                <tr>
					                <th>Kode</th>
					                <th>Nama</th>
					                <th style="width:15%;">Aksi</th>
					            </tr>
				            </thead>
				        	<tbody>
				        		<?php foreach ($nomenklatur as $no): ?>
                  				<tr>
                    				<td><?php echo $no->NOMOR; ?></td>
                    				<td><?php echo $no->NAMA; ?></td>
                    				<td align="center">
                    					<button type="submit" class="btn btn-flat btn-warning btn-xs" data-toggle="modal" 
                    						data-target="#myModal" onclick="edit('<?php echo $no->NOMOR; ?>', '<?php echo $no->NAMA; ?>')">
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
				<h4 class="modal-title" id="exampleModalLabel">Ubah Data Nomenklatur</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>nomenklatur/edit" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="e-nomor">Nomor</label>
						<div class="col-sm-10">
							<input type="text" id="e-nomor" class="form-control" name="e-nomor" readonly required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="e-nama">Nama</label>
						<div class="col-sm-10">
						    <input type="type" id="e-nama" class="form-control" name="e-nama" required>
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
		$('#e-nomor').val(id);
		$('#e-nama').val(nama);
	}
</script>
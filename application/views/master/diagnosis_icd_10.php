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
				<h3 class="box-title">Input Data Diagnosa (ICD 10)</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form action="<?php echo base_url().'diagnosis_icd_10/tambah'; ?>" method="POST" class="form-horizontal" style="margin-top:10px">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="kode_icd_10">Kode Diagnosis</label>
						<div class="col-sm-4">
							<input type="text" id="kode_icd_10" class="form-control" name="kode_icd_10" required autofocus />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="nm_icd_10">Diagnosis</label>
						<div class="col-sm-4">
						    <input type="type" id="nm_icd_10" class="form-control" name="nm_icd_10" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="ket_icd_10">Keterangan</label>
						<div class="col-sm-4">
						    <textarea id="ket_icd_10" class="form-control" name="ket_icd_10"></textarea>
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
				<h3 class="box-title">Data Diagnosa (ICD 10)</h3>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		    		<div class="row">
			    	<div class="col-sm-12">
			        	<table id="example1" class="table table-bordered table-striped">
				            <thead>
				                <tr>
					                <th>Kode</th>
					                <th>Diagnosis</th>
					                <th>Keterangan</th>
					                <th style="width:15%;">Aksi</th>
					            </tr>
				            </thead>
				        	<tbody>
				        		<?php foreach ($diagnosis_icd_10 as $icd_10): ?>
                  				<tr>
                    				<td><?php echo $icd_10->KODE_ICD_10; ?></td>
                    				<td><?php echo $icd_10->NM_ICD_10; ?></td>
                    				<td><?php echo $icd_10->KET_ICD_10; ?></td>
                    				<td align="center">
                    					<button type="submit" class="btn btn-flat btn-warning btn-xs" data-toggle="modal" 
                    						data-target="#myModal" onclick="edit('<?php echo $icd_10->KODE_ICD_10; ?>', 
                    						'<?php echo $icd_10->NM_ICD_10; ?>', '<?php echo $icd_10->KET_ICD_10; ?>')">
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
				<h4 class="modal-title" id="exampleModalLabel">Ubah Data Diagnosis</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>diagnosis_icd_10/edit" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-kode_icd_10">Kode Poli</label>
						<div class="col-sm-9">
							<input type="text" id="e-kode_icd_10" class="form-control" name="e-kode_icd_10" value=<?php echo $kodediagnosis_icd_10; ?> readonly required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-nm_icd_10">Diagnosis</label>
						<div class="col-sm-9">
						    <input type="type" id="e-nm_icd_10" class="form-control" name="e-nm_icd_10" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-ket_icd_10">Keterangan</label>
						<div class="col-sm-9">
						    <textarea id="e-ket_icd_10" class="form-control" name="e-ket_icd_10"></textarea>
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
	function edit(id, nama, ket) {
		$('#e-kode_icd_10').val(id);
		$('#e-nm_icd_10').val(nama);
		$('#e-ket_icd_10').val(ket);
	}
</script>
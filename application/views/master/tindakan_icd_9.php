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
				<h3 class="box-title">Input Data Tindakan (ICD 9)</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form action="<?php echo base_url().'tindakan_icd_9/tambah'; ?>" method="POST" class="form-horizontal" style="margin-top:10px">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="kode_icd_9">Kode Tindakan</label>
						<div class="col-sm-4">
							<input type="text" id="kode_icd_9" class="form-control" name="kode_icd_9" required autofocus />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="nm_icd_9">Tindakan</label>
						<div class="col-sm-4">
						    <input type="type" id="nm_icd_9" class="form-control" name="nm_icd_9" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="ket_icd_9">Keterangan</label>
						<div class="col-sm-4">
						    <textarea id="ket_icd_9" class="form-control" name="ket_icd_9"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="diagnosa">Diagnosa</label>
						<div class="col-sm-4">
						    <select id="diagnosa" class="form-control select2" multiple="multiple" name="diagnosa[]" required>
						    	<?php foreach ($diagnosa as $d): ?>
						    	<option value="<?php echo $d->KODE_ICD_10 ?>"><?php echo $d->NM_ICD_10 ?></option>
						    	<?php endforeach ?>
						    </select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="harga_tindakan">Harga Tindakan</label>
						<div class="col-sm-4">
						    <div class="input-group">
		                  		<div class="input-group-addon">
		                    		<i class="">Rp</i>
		                  		</div>
		                  		<input type="number" class="form-control" name="harga_tindakan" id="harga_tindakan" min="0" required>
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
				<h3 class="box-title">Data Tindakan (ICD 9)</h3>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		    		<div class="row">
			    	<div class="col-sm-12">
			        	<table id="example1" class="table table-bordered table-striped">
				            <thead>
				                <tr>
					                <th>Kode</th>
					                <th>Tindakan</th>
					                <th>Keterangan</th>
					                <th>Harga</th>
					                <th>Diagnosa</th>
					                <th style="width:15%;">Aksi</th>
					            </tr>
				            </thead>
				        	<tbody>
				        		<?php foreach ($tindakan_icd_9 as $icd_9): ?>
                  				<tr>
                    				<td><?php echo $icd_9->KODE_ICD_9; ?></td>
                    				<td><?php echo $icd_9->NM_ICD_9; ?></td>
                    				<td><?php echo $icd_9->KET_ICD_9; ?></td>
                    				<td align="right">Rp<?php echo number_format($icd_9->HARGA_TINDAKAN, 2, ",", "."); ?></td>
                    				<td>
                    					<?php 
                    					$idx = 1;
                    					$dg_select = "";
                    					if (count($icd_9->DIAGNOSA) > 0) {
	                    					foreach ($icd_9->DIAGNOSA as $dg) {
	                    						echo $dg->NM_ICD_10;
	                    						echo $idx==count($icd_9->DIAGNOSA)?".":", ";
	                    						$dg_select .= $dg->KODE_ICD_10.";";
	                    						$idx++;
	                    					}
                    					} 
                    					?>
                    				</td>
                    				<td align="center">
                    					<button type="submit" class="btn btn-flat btn-warning btn-xs" data-toggle="modal" 
                    						data-target="#myModal" onclick="edit('<?php echo $icd_9->KODE_ICD_9; ?>', 
                    						'<?php echo $icd_9->NM_ICD_9; ?>', '<?php echo $icd_9->KET_ICD_9; ?>', 
                    						'<?php echo $icd_9->HARGA_TINDAKAN; ?>', '<?php echo $dg_select; ?>')">
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
				<h4 class="modal-title" id="exampleModalLabel">Ubah Data Tindakan</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>tindakan_icd_9/edit" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-kode_icd_9">Kode Tindakan</label>
						<div class="col-sm-9">
							<input type="text" id="e-kode_icd_9" class="form-control" name="e-kode_icd_9" readonly required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-nm_icd_9">Tindakan</label>
						<div class="col-sm-9">
						    <input type="type" id="e-nm_icd_9" class="form-control" name="e-nm_icd_9" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-ket_icd_9">Keterangan</label>
						<div class="col-sm-9">
						    <textarea id="e-ket_icd_9" class="form-control" name="e-ket_icd_9"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-diagnosa">Diagnosa</label>
						<div class="col-sm-9">
						    <select id="e-diagnosa" class="form-control select2" multiple="multiple" name="e-diagnosa[]" style="width: 100%" required>
						    	<?php foreach ($diagnosa as $d): ?>
						    	<option value="<?php echo $d->KODE_ICD_10 ?>"><?php echo $d->NM_ICD_10 ?></option>
						    	<?php endforeach ?>
						    </select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-harga_tindakan">Harga Tindakan</label>
						<div class="col-sm-9">
						    <div class="input-group">
		                  		<div class="input-group-addon">
		                    		<i class="">Rp</i>
		                  		</div>
		                  		<input type="number" class="form-control" name="e-harga_tindakan" id="e-harga_tindakan" min="0" required>
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
	function edit(id, nama, ket, harga, diagnosa) {
		$('#e-kode_icd_9').val(id);
		$('#e-nm_icd_9').val(nama);
		$('#e-ket_icd_9').val(ket);
		$('#e-harga_tindakan').val(harga);
		$.each(diagnosa.split(';'), function(i, e) {
			$("#e-diagnosa option[value='" + e + "']").prop("selected", true);
		});
	}
</script>
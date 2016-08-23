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
						<label class="col-sm-2 control-label" for="jenis">Jenis</label>
						<div class="col-sm-4">
						    <select id="jenis" class="form-control select2" name="jenis" style="width: 100%;" required>
						    	<option></option>
						    	<?php foreach ($jenis_lab as $jl): ?>
						    	<option value="<?php echo $jl->ID_JENIS_LAB ?>"><?php echo $jl->NM_LAB ?></option>
						    	<?php endforeach ?>
						    </select>
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
			        	<table id="table1" class="table table-bordered table-striped">
				            <thead>
				                <tr>
					                <th>Kode Lab</th>
					                <th>Nama Lab</th>
					                <th>Jenis Lab</th>
					                <th>Harga Pemeriksaan</th>
					                <th>Diagnosa</th>
					                <th style="width:75px;">Aksi</th>
					            </tr>
				            </thead>
				        	<tbody>
				        		<?php foreach ($pemeriksaan_lab as $pl): ?>
                  				<tr>
                    				<td><?php echo $pl->lab->ID_LAB; ?></td>
                    				<td><?php echo $pl->lab->LAB; ?></td>
                    				<td><?php echo $pl->lab->NM_LAB; ?></td>
                    				<td><?php echo number_format($pl->lab->HARGA, 2, ",", "."); ?></td>
                    				<td>
                    					<?php 
                    					$idx = 1;
                    					$dg_select = "";
                    					if (count($pl->diagnosa) > 0) {
	                    					foreach ($pl->diagnosa as $dg) {
	                    						echo $dg->NM_ICD_10;
	                    						echo $idx==count($pl->diagnosa)?".":", ";
	                    						$dg_select .= $dg->KODE_ICD_10.";";
	                    						$idx++;
	                    					}
                    					} 
                    					?>
                    				</td>
                    				<td align="center">
                    					<button type="submit" class="btn btn-flat btn-warning btn-xs" data-toggle="modal" 
                    						data-target="#myModal" onclick="edit('<?php echo $pl->lab->ID_LAB; ?>', 
                    						'<?php echo $pl->lab->LAB; ?>', '<?php echo $pl->lab->NM_LAB; ?>', <?php echo $pl->lab->HARGA; ?>, '<?php echo $dg_select; ?>')">
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
<div class="modal fade" role="dialog" id="myModal" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Ubah Data Pemeriksaan Lab</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>pemeriksaan_lab/edit" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-id_lab">Kode Lab</label>
						<div class="col-sm-9">
							<input type="text" id="e-id_lab" class="form-control" name="e-id_lab" readonly required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-lab">Nama Lab</label>
						<div class="col-sm-9">
						    <input type="type" id="e-lab" class="form-control" name="e-lab" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="e-jenis">Jenis</label>
						<div class="col-sm-9">
						    <select id="e-jenis" class="form-control select2" name="e-jenis" style="width: 100%;" required>
						    	<option></option>
						    	<?php foreach ($jenis_lab as $jl): ?>
						    	<option value="<?php echo $jl->ID_JENIS_LAB ?>"><?php echo $jl->NM_LAB ?></option>
						    	<?php endforeach ?>
						    </select>
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
						<label class="col-sm-3 control-label" for="e-harga">Harga Pemeriksaan</label>
						<div class="col-sm-9">
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
	function edit(id, nama, jenis, harga, diagnosa) {
		$('#e-id_lab').val(id);
		$('#e-lab').val(nama);
		$('#e-jenis').select2("val", jenis);
		$('#e-harga').val(harga);
		$.each(diagnosa.split(';'), function(i, e) {
			$("#e-diagnosa option[value='" + e + "']").prop("selected", true);
		});
	}
</script>
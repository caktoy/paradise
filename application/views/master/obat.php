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
				<h3 class="box-title">Input Data Obat</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form action="<?php echo base_url().'obat/tambah'; ?>" method="POST" class="form-horizontal" style="margin-top:10px">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="id">Kode Obat</label>
						<div class="col-sm-4">
							<input type="text" id="id" class="form-control" name="id_obat" value=<?php echo $kodeobat; ?> readonly required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Jenis Obat</label>
						<div class="col-sm-4">
						    <select class="form-control select2" name="id_jenis_obat" data-placeholder="Pilih jenis obat" required autofocus>
						    	<option></option>
						    	<?php foreach ($jenis_obat as $jo): ?>
						    	<option value="<?php echo $jo->ID_JENIS_OBAT; ?>"><?php echo $jo->NM_JENIS_OBAT; ?></option>
						    	<?php endforeach ?>
						    </select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Nama Obat</label>
						<div class="col-sm-4">
						    <input type="type" class="form-control" name="nm_obat" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Jumlah Obat</label>
						<div class="col-sm-4">
						    <input type="number" class="form-control" name="jml_obat" min="0">
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
						<label class="col-sm-2 control-label">Harga Obat</label>
						<div class="col-sm-4">
						    <div class="input-group">
		                  		<div class="input-group-addon">
		                    		<i class="">Rp</i>
		                  		</div>
		                  		<input type="number" class="form-control" name="hrg_obat" min="0" required>
		                	</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Satuan</label>
						<div class="col-sm-4">
						    <input type="type" class="form-control" name="satuan" required>
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
				<h3 class="box-title">Data Obat</h3>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		    		<div class="row">
			    	<div class="col-sm-12">
			        	<table id="example1" class="table table-bordered table-striped">
				            <thead>
				                <tr>
					                <th>Kode Obat</th>
					                <th>Nama Obat</th>
					                <th>Jenis Obat</th>
					                <th>Harga Obat</th>
					                <th>Jumlah</th>
					                <th>Satuan</th>
					                <th>Diagnosa</th>
					                <th style="width:75px;">Aksi</th>
					            </tr>
				            </thead>
				        	<tbody>
				        		<?php foreach ($obat as $o): ?>
                  				<tr>
                    				<td><?php echo $o->obat->ID_OBAT; ?></td>
                    				<td><?php echo $o->obat->NM_OBAT; ?></td>
                    				<td><?php echo $o->obat->NM_JENIS_OBAT; ?></td>
                    				<td align="right">Rp<?php echo number_format($o->obat->HRG_OBAT, 2, ",", "."); ?></td>
                    				<td><?php echo $o->obat->JML_OBAT; ?></td>
                    				<td><?php echo $o->obat->SATUAN; ?></td>
                    				<td>
                    					<?php 
                    					$idx = 1;
                    					$dg_select = "";
                    					if (count($o->diagnosa) > 0) {
	                    					foreach ($o->diagnosa as $dg) {
	                    						echo $dg->NM_ICD_10;
	                    						echo $idx==count($o->diagnosa)?".":", ";
	                    						$dg_select .= $dg->KODE_ICD_10.";";
	                    						$idx++;
	                    					}
                    					} 
                    					?>
                    				</td>
                    				<td align="center">
                    					<button type="submit" class="btn btn-flat btn-warning btn-xs" data-toggle="modal" 
                    						data-target="#myModal" onclick="edit('<?php echo $o->obat->ID_OBAT; ?>', 
                    						'<?php echo $o->obat->ID_JENIS_OBAT; ?>', '<?php echo $o->obat->NM_OBAT; ?>', 
                    						'<?php echo $o->obat->JML_OBAT; ?>', '<?php echo $o->obat->HRG_OBAT; ?>', 
                    						'<?php echo $o->obat->SATUAN; ?>', '<?php echo $dg_select; ?>')">
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
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Ubah Data Obat</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>obat/edit" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="e-id_obat">Kode Obat</label>
						<div class="col-sm-4">
							<input type="text" id="e-id_obat" class="form-control" name="e-id_obat" readonly required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Jenis Obat</label>
						<div class="col-sm-6">
						    <select class="form-control" name="e-id_jenis_obat" id="e-id_jenis_obat" style="width:100%;" required>
						    	<option></option>
						    	<?php foreach ($jenis_obat as $jo): ?>
						    	<option value="<?php echo $jo->ID_JENIS_OBAT; ?>"><?php echo $jo->NM_JENIS_OBAT; ?></option>
						    	<?php endforeach ?>
						    </select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Nama Obat</label>
						<div class="col-sm-6">
						    <input type="type" class="form-control" name="e-nm_obat" id="e-nm_obat" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Jumlah Obat</label>
						<div class="col-sm-3">
						    <input type="number" class="form-control" name="e-jml_obat" id="e-jml_obat" min="0">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="e-diagnosa">Diagnosa</label>
						<div class="col-sm-8">
						    <select id="e-diagnosa" class="form-control select2" multiple="multiple" name="e-diagnosa[]" style="width: 100%" required>
						    	<?php foreach ($diagnosa as $d): ?>
						    	<option value="<?php echo $d->KODE_ICD_10 ?>"><?php echo $d->NM_ICD_10 ?></option>
						    	<?php endforeach ?>
						    </select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Harga Obat</label>
						<div class="col-sm-4">
						    <div class="input-group">
		                  		<div class="input-group-addon">
		                    		<i class="">Rp</i>
		                  		</div>
		                  		<input type="number" class="form-control" name="e-hrg_obat" id="e-hrg_obat" min="0" required>
		                	</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Satuan</label>
						<div class="col-sm-4">
						    <input type="type" class="form-control" name="e-satuan" id="e-satuan" required>
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
	function edit(id, jenis, nama, jml, hrg, satuan, diagnosa) {
		$('#e-id_obat').val(id);
		$('#e-id_jenis_obat').val(jenis);
		$('#e-nm_obat').val(nama);
		$('#e-jml_obat').val(jml);
		$('#e-hrg_obat').val(hrg);
		$('#e-satuan').val(satuan);
		$.each(diagnosa.split(';'), function(i, e) {
			$("#e-diagnosa option[value='" + e + "']").prop("selected", true);
		});
	}
</script>
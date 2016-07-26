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
				<h3 class="box-title">Input Data Poli</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form action="<?php echo base_url().'jadwal_dokter/tambah'; ?>" method="POST" class="form-horizontal" style="margin-top:10px">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="id">Kode Jadwal</label>
						<div class="col-sm-4">
							<input type="text" id="id" class="form-control" name="id_jadwal" value=<?php echo $kode_jadwal_dokter; ?> readonly required />
						</div>
					</div>

					<div class="form-group">
	                	<label class="col-sm-2 control-label">Dokter Prakter</label>
	                  	<div class="col-sm-4">
	                    	<select name="id_dokter" class="form-control" required>
	                    		<option></option>
	                    		<?php foreach ($dokter as $d): ?>
	                    		<option value="<?php echo $d->ID_DOKTER; ?>"><?php echo $d->NM_DOKTER ?></option>
	                    		<?php endforeach ?>
                    		</select>
	                  	</div>
	               	</div>

				
          			<div class="form-group">
	               		<label class="col-sm-2 control-label">Jadwal Praktek</label>
	               		
            			<div class="col-sm-2">
	               		<div class="input-group">
              				<div class="input-group-addon">
                				<i class="fa fa-clock-o"></i>
              				</div>
              				<input type="time" class="form-control" name="jadwal_mulai" required>
            			</div>
            			</div>
            			<div class="col-sm-2">
	               		<div class="input-group">
              				<div class="input-group-addon">
                				<i class="fa fa-clock-o"></i>
              				</div>
              				<input type="time" class="form-control" name="jadwal_selesai" required>
            			</div>
            			</div>
            		</div>
	               
	               	<div class="form-group">
	                  	<label class="col-sm-2 control-label">Hari Praktek</label>
	                  	<div class="col-sm-3">
	                    	<select class="form-control" name="hari" required>
	                    		<option></option>
	                    		<option>Minggu</option>
	                    		<option>Senin</option>
	                    		<option>Selasa</option>
	                    		<option>Rabu</option>
	                    		<option>Kamis</option>
	                    		<option>Jumat</option>
	                    		<option>Sabtu</option>
	                    	</select>
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
				<h3 class="box-title">Data Jadwal Dokter</h3>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		    		<div class="row">
			    	<div class="col-sm-12">
			        	<table id="example1" class="table table-bordered table-striped">
				            <thead>
				                <tr>
					                <th>Kode Jadwal</th>
	                        		<th>Dokter Praktek</th>
	                        		<th>Hari Praktek</th>
	                        		<th>Jadwal Praktek</th>
					                <th style="width:15%;">Aksi</th>
					            </tr>
				            </thead>
				        	<tbody>
				        		<?php foreach ($jadwal_dokter as $jd): ?>
                  				<tr>
                    				<td><?php echo $jd->ID_JADWAL; ?></td>
                    				<td><?php echo $jd->NM_DOKTER; ?></td>
                    				<td><?php echo $jd->HARI; ?></td>
                    				<td><?php echo $jd->JADWAL_MULAI." - ".$jd->JADWAL_SELESAI; ?></td>
                    				<td align="center">
                    					<button type="submit" class="btn btn-flat btn-warning btn-xs" data-toggle="modal" 
                    						data-target="#myModal" onclick="edit('<?php echo $jd->ID_JADWAL; ?>', 
                    						'<?php echo $jd->ID_DOKTER; ?>', '<?php echo $jd->JADWAL_MULAI; ?>', 
                    						'<?php echo $jd->JADWAL_SELESAI; ?>', '<?php echo $jd->HARI; ?>')">
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
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Ubah Data Poli</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>jadwal_dokter/edit" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="id_jadwal">Kode Jadwal</label>
						<div class="col-sm-4">
							<input type="text" id="e-id_jadwal" class="form-control" name="e-id_jadwal" readonly required />
						</div>
					</div>

					<div class="form-group">
	                	<label class="col-sm-2 control-label">Dokter Prakter</label>
	                  	<div class="col-sm-6">
	                    	<select id="e-id_dokter" name="e-id_dokter" class="form-control" required>
	                    		<option></option>
	                    		<?php foreach ($dokter as $d): ?>
	                    		<option value="<?php echo $d->ID_DOKTER; ?>"><?php echo $d->NM_DOKTER ?></option>
	                    		<?php endforeach ?>
                    		</select>
	                  	</div>
	               	</div>

				
          			<div class="form-group">
	               		<label class="col-sm-2 control-label">Jadwal Praktek</label>
	               		
            			<div class="col-sm-2">
	               		<div class="input-group">
              				<div class="input-group-addon">
                				<i class="fa fa-clock-o"></i>
              				</div>
              				<input type="time" id="e-jadwal_mulai" class="form-control" name="e-jadwal_mulai" required>
            			</div>
            			</div>
            			<div class="col-sm-2">
	               		<div class="input-group">
              				<div class="input-group-addon">
                				<i class="fa fa-clock-o"></i>
              				</div>
              				<input type="time" id="e-jadwal_selesai" class="form-control" name="e-jadwal_selesai" required>
            			</div>
            			</div>
            		</div>
	               
	               	<div class="form-group">
	                  	<label class="col-sm-2 control-label">Hari Praktek</label>
	                  	<div class="col-sm-4">
	                    	<select id="e-hari" class="form-control" name="e-hari" required>
	                    		<option></option>
	                    		<option>Minggu</option>
	                    		<option>Senin</option>
	                    		<option>Selasa</option>
	                    		<option>Rabu</option>
	                    		<option>Kamis</option>
	                    		<option>Jumat</option>
	                    		<option>Sabtu</option>
	                    	</select>
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
	function edit(id, dokter, mulai, selesai, hari) {
		$('#e-id_jadwal').val(id);
		$('#e-id_dokter').val(dokter);
		$('#e-jadwal_mulai').val(mulai);
		$('#e-jadwal_selesai').val(selesai);
		$('#e-hari').val(hari);
	}
</script>
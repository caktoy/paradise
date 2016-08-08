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
				<h3 class="box-title">Input Data Dokter</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form action="<?php echo base_url().'dokter/tambah'; ?>" method="POST" class="form-horizontal" style="margin-top:10px" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="id">Kode Dokter</label>
						<div class="col-sm-4">
							<input type="text" id="id" class="form-control" name="iddokter" value="<?php echo $kodedokter; ?>" readonly required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="namadokter">Nama Dokter</label>
						<div class="col-sm-4">
						    <input type="type" id="namadokter" class="form-control" name="namadokter" required>
						</div>
					</div>
					
					<div class="form-group">
	                  	<label class="col-sm-2 control-label" for="tmptlahir">Tempat/Tanggal Lahir</label>
	                  	<div class="col-sm-3">
	                    	<select id="tmptlahir" class="form-control select2" name="tmptlahir" required>
	                    		<option></option>
	                    		<?php foreach ($kota as $k): ?>
	                    		<option value="<?php echo $k->ID_KOTA ?>"><?php echo $k->NM_KOTA ?></option>
	                    		<?php endforeach ?>
	                    	</select>
	                  	</div>
	                  	<div class="col-sm-3">
	                  		<div class="input-group">
		                  		<div class="input-group-addon">
		                    		<i class="fa fa-calendar"></i>
		                  		</div>
		                  		<input type="date" class="form-control" id="datepicker" name="tgllahir" required>
		                	</div>
	                  	</div>            
	                </div>

					<div class="form-group">
	                	<label class="col-sm-2 control-label" for="jk">Jenis Kelamin</label>
	                  		<div class="radio" >
                              	<div class="col-sm-3">
                                	<label><input class="flat-red" id="jk" name="jk" value="Laki-laki" type="radio"> Laki-laki</label>
                                </div>
                              	<div class="col-sm-3">
                                	<label><input class="flat-red" id="jk" name="jk" value="Perempuan" type="radio"> Perempuan</label>
                              	</div>
                            </div>
                   	</div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="almtdokter">Alamat</label>
	                  	<div class="col-sm-6">
	                    	<textarea id="almtdokter" class="form-control" name="almtdokter" required></textarea>
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="telpdokter">Telepon</label>
	                  	<div class="col-sm-3">
	                    	<input type="text" id="telpdokter" class="form-control" name="telpdokter" required>
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="passdokter">Password</label>
	                  	<div class="col-sm-3">
	                    	<input type="password" id="passdokter" class="form-control" name="passdokter" required>
	                  	</div>
	                </div>

					<div class="form-group">
	                  	<label class="col-sm-2 control-label" for="fotodokter">Foto</label>
	                  	<div class="col-sm-3">
	                  		<input type="file" id="fotodokter" class="form-control" name="fotodokter" required>
	                  	</div>
	                </div>

	                <div class="form-group">
	                	<label class="col-sm-2 control-label">Poli</label>
	                  	<div class="col-sm-3">
	                    	<select id="idpoli" name="idpoli" class="form-control select2" tabindex="1">
	                    		<option></option>
                        		<?php foreach ($poli as $p): ?>
                        		<option value="<?php echo $p->ID_POLI; ?>"><?php echo $p->NM_POLI; ?></option>
                        		<?php endforeach ?>
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
				<h3 class="box-title">Data Dokter</h3>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
			    	<div class="col-sm-12">
			        	<table id="example1" class="table table-bordered table-striped">
				            <thead>
				                <tr>
					                <th>ID Dokter</th>
	                        		<th>Nama Dokter</th>
	                        		<th>Poli</th>
	                        		<th>Telp</th>
					                <th style="width:15%;">Aksi</th>
					            </tr>
				            </thead>
				        	<tbody>
				        		<?php foreach ($dokter as $dokter): ?>
                  				<tr>
                    				<td><?php echo $dokter->ID_DOKTER; ?></td>
                    				<td><?php echo $dokter->NM_DOKTER; ?></td>
                    				<td><?php echo $dokter->NM_POLI; ?></td>
                    				<td><?php echo $dokter->TELP_DOKTER; ?></td>
                    				<td align="center">
                    					<button type="submit" class="btn btn-flat btn-warning btn-xs" data-toggle="modal" 
                    						data-target="#myModal" onclick="edit('<?php echo $dokter->ID_DOKTER; ?>')">
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

<!--MODAL-->
<div class="modal fade" role="dialog" id="myModal" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Ubah Data Dokter</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>dokter/edit" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group">
	              		<label for="message-text" class="col-sm-3 control-label">Kode Dokter</label>
	              		<div class="col-sm-4">
	                		<input type="text" class="form-control" name="e-iddokter" id="e-iddokter" readonly required>
	                    </div>
	            	</div>

	            	<div class="form-group">
						<label class="col-sm-3 control-label">Nama Dokter</label>
						<div class="col-sm-9">
						    <input type="type" id="e-namadokter" class="form-control" name="e-namadokter" required>
						</div>
					</div>
					
					<div class="form-group">
	                  	<label class="col-sm-3 control-label" for="e-tmptlahir">Tempat/Tanggal Lahir</label>
	                  	<div class="col-sm-3">
	                    	<select id="e-tmptlahir" class="form-control select2" name="e-tmptlahir" required>
	                    		<option></option>
	                    		<?php foreach ($kota as $k): ?>
	                    		<option value="<?php echo $k->ID_KOTA ?>"><?php echo $k->NM_KOTA ?></option>
	                    		<?php endforeach ?>
	                    	</select>
	                  	</div>
	                  	<div class="col-sm-4">
	                  		<div class="input-group">
		                  		<div class="input-group-addon">
		                    		<i class="fa fa-calendar"></i>
		                  		</div>
		                  		<input type="date" class="form-control" id="datepicker" name="e-tgllahir" required>
		                	</div>
	                  	</div>            
	                </div>

					<div class="form-group">
	                	<label class="col-sm-3 control-label">Jenis Kelamin</label>
	                  		<div class="radio" >
                              	<div class="col-sm-3">
                                	<label><input class="flat-red" id="e-jkl" name="e-jk" value="Laki-laki" type="radio"> Laki-laki</label>
                                </div>
                              	<div class="col-sm-3">
                                	<label><input class="flat-red" id="e-jkp" name="e-jk" value="Perempuan" type="radio"> Perempuan</label>
                              	</div>
                            </div>
                   	</div>

	                <div class="form-group">
	                  	<label class="col-sm-3 control-label" for="e-almtdokter">Alamat</label>
	                  	<div class="col-sm-9">
	                    	<textarea id="e-almtdokter" class="form-control" name="e-almtdokter" required></textarea>
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-3 control-label" for="e-telpdokter">Telepon</label>
	                  	<div class="col-sm-4">
	                    	<input type="text" id="e-telpdokter" class="form-control" name="e-telpdokter" required>
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-3 control-label" for="e-passdokter">Password</label>
	                  	<div class="col-sm-4">
	                    	<input type="password" id="e-passdokter" class="form-control" name="e-passdokter" required>
	                  	</div>
	                </div>

					<div class="form-group">
	                  	<label class="col-sm-3 control-label" for="e-fotodokter">Foto</label>
	                  	<div class="col-sm-3">
	                  		<input type="file" id="e-fotodokter" name="e-fotodokter">
	                  	</div>
	                </div>

	                <div class="form-group">
	                	<label class="col-sm-3 control-label">Poli</label>
	                  	<div class="col-sm-6">
	                    	<select id="e-idpoli" name="e-idpoli" class="form-control" tabindex="1">
                        		<?php foreach ($poli as $p): ?>
                        		<option value="<?php echo $p->ID_POLI; ?>"><?php echo $p->NM_POLI; ?></option>
                        		<?php endforeach ?>
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
	function edit(id) {
		$('#e-iddokter').val(id);
		$.ajax({
			url: '<?php echo base_url()."dokter/get"; ?>',
			method: 'post',
			data: {'id': id},
			dataType: 'json',
			success: function(result) {
				console.log(result);
				$('#e-namadokter').val(result[0].NM_DOKTER);
				$('#e-tmptlahir').val(result[0].ID_KOTA);
				$('#e-tgllahir').val(result[0].TGL_LHR_DOKTER);

				// if(result[0].JK_DOKTER === "Laki-laki")
				// 	$('#e-jkl').prop("checked", true);
				// else
				// 	$('#e-jkp').prop("checked", true);

				$('#e-almtdokter').val(result[0].ALMT_DOKTER);
				$('#e-telpdokter').val(result[0].TELP_DOKTER);
				$('#e-idpoli').val(result[0].ID_POLI);
			},
			error: function(xhr, status, error) {
				console.log(error);
			}
		});
	}
</script>
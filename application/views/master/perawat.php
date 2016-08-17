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
				<h3 class="box-title">Input Data Perawat</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form action="<?php echo base_url().'perawat/tambah'; ?>" method="POST" class="form-horizontal" style="margin-top:10px" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="id">Kode perawat</label>
						<div class="col-sm-4">
							<input type="text" id="id" class="form-control" name="idperawat" value="<?php echo $kodeperawat; ?>" readonly required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="namaperawat">Nama Perawat</label>
						<div class="col-sm-4">
						    <input type="type" id="namaperawat" class="form-control" name="namaperawat" required>
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
                              	<div class="col-sm-2">
                                	<label><input class="flat-red" id="jk" name="jk" value="Laki-laki" type="radio"> Laki-laki</label>
                                </div>
                              	<div class="col-sm-2">
                                	<label><input class="flat-red" id="jk" name="jk" value="Perempuan" type="radio"> Perempuan</label>
                              	</div>
                            </div>
                   	</div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="almtperawat">Alamat</label>
	                  	<div class="col-sm-6">
	                    	<textarea id="almtperawat" class="form-control" name="almtperawat" required></textarea>
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="telpperawat">Telepon</label>
	                  	<div class="col-sm-3">
	                    	<input type="text" id="telpperawat" class="form-control" name="telpperawat" required>
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="passperawat">Password</label>
	                  	<div class="col-sm-3">
	                    	<input type="password" id="passperawat" class="form-control" name="passperawat" required>
	                  	</div>
	                </div>

					<div class="form-group">
	                  	<label class="col-sm-2 control-label" for="fotoperawat">Foto</label>
	                  	<div class="col-sm-3">
	                  		<input type="file" id="fotoperawat" class="form-control" name="fotoperawat" required>
	                  	</div>
	                </div>

	                <div class="form-group">
	                	<label class="col-sm-2 control-label">Bagian</label>
	                  	<div class="col-sm-3">
	                    	<select id="bagperawat" name="bagperawat" class="form-control select2" required>
	                    		<option></option>
	                    		<option>Administrasi</option>
	                    		<option>Kasir/Apotik</option>
	                    		<option>Laboratorium</option>
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
				<h3 class="box-title">Data Perawat</h3>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
			    	<div class="col-sm-12">
			        	<table id="example1" class="table table-bordered table-striped">
				            <thead>
				                <tr>
					                <th>ID Perawat</th>
	                        		<th>Nama Perawat</th>
	                        		<th>Bagian</th>
	                        		<th>Jenis Kelamin</th>
	                        		<th>Tempat, Tanggal Lahir</th>
	                        		<th>No. Telepon</th>
					                <th style="width:15%;">Aksi</th>
					            </tr>
				            </thead>
				        	<tbody>
				        		<?php foreach ($perawat as $p): ?>
                  				<tr>
                    				<td><?php echo $p->ID_PERAWAT; ?></td>
                    				<td><?php echo $p->NM_PERAWAT; ?></td>
                    				<td><?php echo $p->BAG_PERAWAT; ?></td>
                    				<td><?php echo $p->JK_PERAWAT; ?></td>
                    				<td><?php echo $p->NM_KOTA.', '.date('d-m-Y', strtotime($p->TGL_LHR_PERAWAT)); ?></td>
                    				<td><?php echo $p->TELP_PERAWAT; ?></td>
                    				<td align="center">
                    					<button type="submit" class="btn btn-flat btn-warning btn-xs" data-toggle="modal" 
                    						data-target="#myModal" onclick="edit('<?php echo $p->ID_PERAWAT; ?>')">
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
				<h4 class="modal-title" id="exampleModalLabel">Ubah Data perawat</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>perawat/edit" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group">
	              		<label for="message-text" class="col-sm-3 control-label">Kode Perawat</label>
	              		<div class="col-sm-4">
	                		<input type="text" class="form-control" name="e-idperawat" id="e-idperawat" readonly required>
	                    </div>
	            	</div>

	            	<div class="form-group">
						<label class="col-sm-3 control-label">Nama Perawat</label>
						<div class="col-sm-9">
						    <input type="type" id="e-namaperawat" class="form-control" name="e-namaperawat" required>
						</div>
					</div>
					
					<div class="form-group">
	                  	<label class="col-sm-3 control-label" for="e-tmptlahir">Tempat/Tanggal Lahir</label>
	                  	<div class="col-sm-5">
	                    	<select id="e-tmptlahir" class="form-control select2" name="e-tmptlahir" style="width: 100%;" required>
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
	                  	<label class="col-sm-3 control-label" for="e-almtperawat">Alamat</label>
	                  	<div class="col-sm-9">
	                    	<textarea id="e-almtperawat" class="form-control" name="e-almtperawat" required></textarea>
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-3 control-label" for="e-telpperawat">Telepon</label>
	                  	<div class="col-sm-4">
	                    	<input type="text" id="e-telpperawat" class="form-control" name="e-telpperawat" required>
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-3 control-label" for="e-passperawat">Password</label>
	                  	<div class="col-sm-4">
	                    	<input type="password" id="e-passperawat" class="form-control" name="e-passperawat" required>
	                  	</div>
	                </div>

					<div class="form-group">
	                  	<label class="col-sm-3 control-label" for="e-fotoperawat">Foto</label>
	                  	<div class="col-sm-3">
	                  		<input type="file" id="e-fotoperawat" name="e-fotoperawat">
	                  	</div>
	                </div>

	                <div class="form-group">
	                	<label class="col-sm-3 control-label">Bagian</label>
	                  	<div class="col-sm-6">
	                    	<select id="e-bagperawat" name="e-bagperawat" class="form-control">
                        		<option></option>
                        		<option>Administrasi</option>
	                    		<option>Kasir/Apotik</option>
	                    		<option>Laboratorium</option>
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
		$('#e-idperawat').val(id);
		$.ajax({
			url: '<?php echo base_url()."perawat/get"; ?>',
			method: 'post',
			data: {'id': id},
			dataType: 'json',
			success: function(result) {
				console.log(result);
				$('#e-namaperawat').val(result[0].NM_PERAWAT);
				$('#e-tmptlahir').val(result[0].ID_KOTA);
				$('#e-tgllahir').val(result[0].TGL_LHR_PERAWAT);

				// if(result[0].JK_PERAWAT === "Laki-laki")
				// 	$('#e-jkl').prop("checked", true);
				// else
				// 	$('#e-jkp').prop("checked", true);

				$('#e-almtperawat').val(result[0].ALAMAT_PERAWAT);
				$('#e-telpperawat').val(result[0].TELP_PERAWAT);
				$('#e-bagperawat').val(result[0].BAG_PERAWAT);
			},
			error: function(xhr, status, error) {
				console.log(error);
			}
		});
	}
</script>
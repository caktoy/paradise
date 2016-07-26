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
				<h3 class="box-title">Input Data Pasien</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form action="<?php echo base_url().'pasien/tambah'; ?>" method="POST" class="form-horizontal" style="margin-top:10px" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="id_pasien">Kode Pasien</label>
						<div class="col-sm-4">
							<input type="text" id="id_pasien" class="form-control" name="id_pasien" value="<?php echo $kodepasien; ?>" readonly required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="nm_pasien">Nama Pasien</label>
						<div class="col-sm-4">
						    <input type="type" id="nm_pasien" class="form-control" name="nm_pasien" required autofocus>
						</div>
					</div>
					
					<div class="form-group">
	                  	<label class="col-sm-2 control-label" for="tmpt_lhr_pasien">Tempat/Tanggal Lahir</label>
	                  	<div class="col-sm-3">
	                    	<input type="text" id="tmpt_lhr_pasien" class="form-control" name="tmpt_lhr_pasien">
	                  	</div>
	                  	<div class="col-sm-3">
	                  		<div class="input-group">
		                  		<div class="input-group-addon">
		                    		<i class="fa fa-calendar"></i>
		                  		</div>
		                  		<input type="date" class="form-control" id="tgl_lhr_pasien" name="tgl_lhr_pasien">
		                	</div>
	                  	</div>            
	                </div>

					<div class="form-group">
	                	<label class="col-sm-2 control-label" for="jk_pasien">Jenis Kelamin</label>
	                  		<div class="radio" >
                              	<div class="col-sm-2">
                                	<label><input class="flat-red" id="jk_pasien_l" name="jk_pasien" value="Laki-laki" type="radio"> Laki-laki</label>
                                </div>
                              	<div class="col-sm-2">
                                	<label><input class="flat-red" id="jk_pasien_p" name="jk_pasien" value="Perempuan" type="radio"> Perempuan</label>
                              	</div>
                            </div>
                   	</div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="almt_pasien">Alamat</label>
	                  	<div class="col-sm-6">
	                    	<textarea id="almt_pasien" class="form-control" name="almt_pasien"></textarea>
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="telp_pasien">Telepon</label>
	                  	<div class="col-sm-3">
	                    	<input type="text" id="telp_pasien" class="form-control" name="telp_pasien">
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="tgl_daftar">Tanggal Daftar</label>
	                  	<div class="col-sm-3">
	                    	<input type="text" class="form-control" id="tgl_daftar" name="tgl_daftar" value="<?php echo date('d/m/Y'); ?>" required readonly>
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
				<h3 class="box-title">Data Pasien</h3>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
			    	<div class="col-sm-12">
			        	<table id="example1" class="table table-bordered table-striped">
				            <thead>
				                <tr>
					                <th>#Pasien</th>
	                        		<th>Nama Pasien</th>
	                        		<th>Jenis Kelamin</th>
	                        		<th>Tempat, Tanggal Lahir</th>
	                        		<th>Alamat</th>
	                        		<th>No. Telepon</th>
	                        		<th>Tanggal Daftar</th>
					                <th style="width:15%;">Aksi</th>
					            </tr>
				            </thead>
				        	<tbody>
				        		<?php foreach ($pasien as $p): ?>
                  				<tr>
                    				<td><?php echo $p->ID_PASIEN; ?></td>
                    				<td><?php echo $p->NM_PASIEN; ?></td>
                    				<td><?php echo $p->JK_PASIEN; ?></td>
                    				<td>
                    					<?php 
                    					echo $p->TMPT_LHR_PASIEN==null?'':$p->TMPT_LHR_PASIEN;
                    					if (!is_null($p->TMPT_LHR_PASIEN) && !is_null($p->TMPT_LHR_PASIEN)) echo ", ";
                    					echo $p->TGL_LHR_PASIEN==null?'':date('d-m-Y', strtotime($p->TGL_LHR_PASIEN)); 
                    					?>
                					</td>
                    				<td><?php echo $p->ALMT_PASIEN; ?></td>
                    				<td><?php echo $p->TELP_PASIEN; ?></td>
                    				<td><?php echo date('d-m-Y', strtotime($p->TGL_DAFTAR)); ?></td>
                    				<td align="center">
                    					<button type="submit" class="btn btn-flat btn-warning btn-xs" data-toggle="modal" 
                    						data-target="#myModal" onclick="edit('<?php echo $p->ID_PASIEN; ?>')">
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
<div class="modal fade" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Ubah Data pasien</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>pasien/edit" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="e-id_pasien">Kode Pasien</label>
						<div class="col-sm-4">
							<input type="text" id="e-id_pasien" class="form-control" name="e-id_pasien" readonly required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="e-nm_pasien">Nama Pasien</label>
						<div class="col-sm-4">
						    <input type="type" id="e-nm_pasien" class="form-control" name="e-nm_pasien" required>
						</div>
					</div>
					
					<div class="form-group">
	                  	<label class="col-sm-2 control-label" for="e-tmpt_lhr_pasien">Tempat/Tanggal Lahir</label>
	                  	<div class="col-sm-3">
	                    	<input type="text" id="e-tmpt_lhr_pasien" class="form-control" name="e-tmpt_lhr_pasien">
	                  	</div>
	                  	<div class="col-sm-3">
	                  		<div class="input-group">
		                  		<div class="input-group-addon">
		                    		<i class="fa fa-calendar"></i>
		                  		</div>
		                  		<input type="date" class="form-control" id="e-tgl_lhr_pasien" name="e-tgl_lhr_pasien">
		                	</div>
	                  	</div>            
	                </div>

					<div class="form-group">
	                	<label class="col-sm-2 control-label" for="e-jk_pasien">Jenis Kelamin</label>
	                  		<div class="radio" >
                              	<div class="col-sm-2">
                                	<label><input class="flat-red" id="jk_pasien_l" name="e-jk_pasien" value="Laki-laki" type="radio"> Laki-laki</label>
                                </div>
                              	<div class="col-sm-2">
                                	<label><input class="flat-red" id="jk_pasien_p" name="e-jk_pasien" value="Perempuan" type="radio"> Perempuan</label>
                              	</div>
                            </div>
                   	</div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="e-almt_pasien">Alamat</label>
	                  	<div class="col-sm-6">
	                    	<textarea id="e-almt_pasien" class="form-control" name="e-almt_pasien"></textarea>
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="e-telp_pasien">Telepon</label>
	                  	<div class="col-sm-3">
	                    	<input type="text" id="e-telp_pasien" class="form-control" name="e-telp_pasien">
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="e-tgl_daftar">Tanggal Daftar</label>
	                  	<div class="col-sm-3">
	                    	<input type="text" class="form-control" id="e-tgl_daftar" name="e-tgl_daftar" required readonly>
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
		$('#e-id_pasien').val(id);
		$.ajax({
			url: '<?php echo base_url()."pasien/get"; ?>',
			method: 'post',
			data: {'id': id},
			dataType: 'json',
			success: function(result) {
				console.log(result);
				$('#e-nm_pasien').val(result[0].NM_PASIEN);
				$('#e-tmpt_lhr_pasien').val(result[0].TMPT_LHR_PASIEN);
				$('#e-tgl_lhr_pasien').val(result[0].TGL_LHR_PASIEN);
				$('#e-almt_pasien').val(result[0].ALMT_PASIEN);
				$('#e-telp_pasien').val(result[0].TELP_PASIEN);
				$('#e-tgl_daftar').val(result[0].TGL_DAFTAR);
			},
			error: function(xhr, status, error) {
				console.log(error);
			}
		});
	}
</script>
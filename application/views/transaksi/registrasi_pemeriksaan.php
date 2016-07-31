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
			<!--Body Content-->
			<div class="box-body">
				<div class="col-md-6 col-xs-6">
					<button type="submit" class="btn btn-flat btn-info btn-lg btn-block" data-toggle="modal" data-target="#myModalAdd">
						<i class="fa fa-plus"></i> Daftar Pemeriksaan 
					</button>
				</div>
				<div class="col-md-6 col-xs-6">
					<button type="submit" class="btn btn-flat btn-info btn-lg btn-block" data-toggle="modal" data-target="#myModalNew">
						<i class="fa fa-user"></i> Daftar Pasien Baru
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Antrian Pasien</h3>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		    		<div class="row">
				    	<div class="col-sm-12">
				        	<table id="example1" class="table table-bordered table-striped">
					            <thead>
					                <tr>
						                <th width="25px">#Antrian</th>
						                <th>#Pasien</th>
						                <th>Nama</th>
						                <th>Poli</th>
						                <th>Status</th>
						                <th style="width:15%;">Aksi</th>
						            </tr>
					            </thead>
					        	<tbody>
					        		<?php foreach ($antrian as $antri): ?>
	                  				<tr>
	                    				<td align="right"><?php echo $antri->ID_ANTRIAN; ?>.</td>
	                    				<td><?php echo $antri->ID_PASIEN; ?></td>
	                    				<td><?php echo $antri->NM_PASIEN; ?></td>
	                    				<td><?php echo $antri->NM_POLI; ?></td>
	                    				<?php
	                    				$label_type = "label-info";
	                    				if($antri->STATUS_ANTRIAN == 'Menunggu')
	                    					$label_type = "label-info";
	                    				elseif($antri->STATUS_ANTRIAN == 'Selesai')
	                    					$label_type = "label-success";
	                    				elseif($antri->STATUS_ANTRIAN == 'Sedang Berlangsung')
	                    					$label_type = "label-warning";
	                    				elseif($antri->STATUS_ANTRIAN == 'Batal')
	                    					$label_type = "label-danger";
	                    				?>
	                    				<td align="center">
	                    					<span class="label <?php echo $label_type ?>">
	                    						<?php echo $antri->STATUS_ANTRIAN; ?>
	                    					</span>
                    					</td>
	                    				<td align="center">
	                    					<?php if ($antri->STATUS_ANTRIAN == "Menunggu"): ?>
	                    					<a href="<?php echo base_url().'antrian/push/'.$antri->ID_ANTRIAN.'/'.$antri->ID_PASIEN.'/'.$antri->ID_POLI ?>" class="btn btn-flat btn-info btn-xs">
	                    						<i class="fa fa-volume-up"></i> Panggil 
	                    					</a>
	                    					<a href="<?php echo base_url().'antrian/cancel/'.$antri->ID_ANTRIAN.'/'.$antri->ID_PASIEN.'/'.$antri->ID_POLI ?>" class="btn btn-flat btn-danger btn-xs" onclick="return confirm('Anda yakin?')">
	                    						<i class="fa fa-remove"></i> Batal
	                    					</a>
	                    					<?php elseif($antri->STATUS_ANTRIAN == "Sedang Berlangsung"): ?>
	                    					<a href="<?php echo base_url().'antrian/done/'.$antri->ID_ANTRIAN.'/'.$antri->ID_PASIEN.'/'.$antri->ID_POLI ?>" class="btn btn-flat btn-success btn-xs" onclick="return confirm('Anda yakin?')">
	                    						<i class="fa fa-check"></i> Selesai
	                    					</a>
	                    					<a href="<?php echo base_url().'antrian/cancel/'.$antri->ID_ANTRIAN.'/'.$antri->ID_PASIEN.'/'.$antri->ID_POLI ?>" class="btn btn-flat btn-danger btn-xs" onclick="return confirm('Anda yakin?')">
	                    						<i class="fa fa-remove"></i> Batal
	                    					</a>
	                    					<?php else: ?>
	                    						<?php echo $antri->STATUS_ANTRIAN; ?>
	                    					<?php endif ?>
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

<!--MODAL ADD-->
<div class="modal fade" tabindex="-1" role="dialog" id="myModalAdd" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Registrasi Pemeriksaan</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-info" style="text-align: center;font-weight: bold;font-size: 24pt;">
					<span id="nomer_antrian">Pilih Poli Terlebih Dahulu</span>
              	</div>
				<form method="POST" action="<?php echo base_url(); ?>registrasi_pemeriksaan/new" class="form-horizontal">
					<input type="hidden" name="nomer" id="nomer" required>
					<div class="form-group">
	              		<label for="message-text" class="col-sm-3 control-label" for="pasien">Cari Pasien</label>
	              		<div class="col-sm-9">
	                		<select class="form-control select2" name="pasien" id="pasien" style="width: 100%;" required>
	                			<option></option>
	                			<?php foreach ($pasien as $pas): ?>
	                			<option value="<?php echo $pas->ID_PASIEN ?>">#<?php echo $pas->ID_PASIEN.' - '.$pas->NM_PASIEN ?></option>
	                			<?php endforeach ?>
	                		</select>
	                    </div>
	            	</div>

	            	<div class="form-group">
	              		<label for="message-text" class="col-sm-3 control-label" for="poli">Poli</label>
	              		<div class="col-sm-9">
	                		<select class="form-control select2" name="poli" id="poli" style="width: 100%;" required>
	                			<option></option>
	                			<?php foreach ($poli as $pol): ?>
	                			<option value="<?php echo $pol->ID_POLI ?>"><?php echo 	$pol->NM_POLI ?></option>
	                			<?php endforeach ?>
	                		</select>
	              		</div>
	            	</div>
	        
					<div class="modal-footer">
						<button type="button" class="btn btn-flat btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
						<button type="submit" class="btn btn-flat btn-warning"><i class="fa fa-check"></i> Simpan</button>
					</div>
				</form>
			</div>           					
		</div>
	</div>
</div>
<!--END MODAL-->

<!--MODAL ADD-->
<div class="modal fade" tabindex="-1" role="dialog" id="myModalNew" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Registrasi Pasien Baru</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>registrasi_pemeriksaan/pasien_baru" class="form-horizontal">
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="id_pasien">#Pasien</label>
						<div class="col-sm-3">
							<input type="text" id="id_pasien" class="form-control" name="id_pasien" value="<?php echo $kodepasien; ?>" readonly required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="nm_pasien">Nama Pasien</label>
						<div class="col-sm-9">
						    <input type="text" id="nm_pasien" class="form-control" name="nm_pasien" required autofocus>
						</div>
					</div>
					
					<div class="form-group">
	                  	<label class="col-sm-3 control-label" for="tmpt_lhr_pasien">Tempat/Tanggal Lahir</label>
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
	                	<label class="col-sm-3 control-label" for="jk_pasien">Jenis Kelamin</label>
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
	                  	<label class="col-sm-3 control-label" for="almt_pasien">Alamat</label>
	                  	<div class="col-sm-9">
	                    	<textarea id="almt_pasien" class="form-control" name="almt_pasien"></textarea>
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-3 control-label" for="telp_pasien">Telepon</label>
	                  	<div class="col-sm-5">
	                    	<input type="text" id="telp_pasien" class="form-control" name="telp_pasien">
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-3 control-label" for="tgl_daftar">Tanggal Daftar</label>
	                  	<div class="col-sm-3">
	                    	<input type="text" class="form-control" id="tgl_daftar" name="tgl_daftar" value="<?php echo date('d/m/Y'); ?>" required readonly>
	                  	</div>
	                </div>
	        
					<div class="modal-footer">
						<button type="button" class="btn btn-flat btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
						<button type="submit" class="btn btn-flat btn-warning"><i class="fa fa-check"></i>  Simpan</button>
					</div>
				</form>
			</div>           					
		</div>
	</div>
</div>
<!--END MODAL-->

<script type="text/javascript">
	function get_antrian(poli) {
		$.ajax({
        	url : '<?php echo base_url(); ?>' + 'registrasi_pemeriksaan/get_antrian',
        	type: 'post',
        	data: {'poli': poli},
        	dataType: 'html',
        	success: function(result) {
        		if(result == 0) {
					$("#nomer_antrian").html("Pilih Poli Terlebih Dahulu");
					$("#nomer").val(null);
        		} else {
					$("#nomer_antrian").html("Nomer Antrian: " + result);
					$("#nomer").val(result);
        		}
        	},
        	error: function(xhr, status, error) {
        		$("#nomer_antrian").html("Pilih Poli Terlebih Dahulu");
				$("#nomer").val(null);
        	}
		})
	}

	$(document).ready(function() {
		var poli = $("#poli").val();
		get_antrian(poli);

		$("#poli").change(function() {
			var poli = $(this).val();
			get_antrian(poli);
		});
	});
</script>
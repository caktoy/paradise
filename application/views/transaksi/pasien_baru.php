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
				<form action="<?php echo base_url().'pasien/tambah_direct'; ?>" method="POST" class="form-horizontal" style="margin-top:10px" enctype="multipart/form-data">
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
	                    	<select id="tmpt_lhr_pasien" class="form-control select2" name="tmpt_lhr_pasien" required>
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
				        <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-plus"></i> Simpan</button>&nbsp;
				        <button type="reset" class="btn btn-flat btn-default"><i class="fa fa-refresh"></i> Reset</button>&nbsp;&nbsp;&nbsp;
				        <a href="<?php echo base_url().'registrasi_pemeriksaan' ?>" class="btn btn-flat btn-danger"><i class="fa fa-chevron-left"></i> Kembali</a>
				    </div> 	               	   			              						              	
				</form>
			</div>
		</div>
	</div>
</div>
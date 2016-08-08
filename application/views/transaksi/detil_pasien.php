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
				<h3 class="box-title">Data Pasien</h3>
			</div>

			<div class="box-body">
				<form class="form-horizontal" style="margin-top:10px" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="id_pasien">Kode Pasien</label>
						<div class="col-sm-4">
							<input type="text" id="id_pasien" class="form-control" name="id_pasien" value="<?php echo $pasien->ID_PASIEN ?>" readonly required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="nm_pasien">Nama Pasien</label>
						<div class="col-sm-4">
						    <input type="type" id="nm_pasien" class="form-control" name="nm_pasien" value="<?php echo $pasien->NM_PASIEN ?>" readonly required autofocus>
						</div>
					</div>
					
					<div class="form-group">
	                  	<label class="col-sm-2 control-label" for="tmpt_lhr_pasien">Tempat/Tanggal Lahir</label>
	                  	<div class="col-sm-3">
	                  		<input type="text" id="tmpt_lhr_pasien" class="form-control" name="tmpt_lhr_pasien" value="<?php echo $pasien->NM_KOTA ?>" readonly required>
	                  	</div>
	                  	<div class="col-sm-3">
	                  		<div class="input-group">
		                  		<div class="input-group-addon">
		                    		<i class="fa fa-calendar"></i>
		                  		</div>
		                  		<input type="text" class="form-control" id="tgl_lhr_pasien" name="tgl_lhr_pasien" value="<?php echo date('d/m/Y', strtotime($pasien->TGL_LHR_PASIEN)) ?>" readonly>
		                	</div>
	                  	</div>            
	                </div>

					<div class="form-group">
	                	<label class="col-sm-2 control-label" for="jk_pasien">Jenis Kelamin</label>
	                  	<div class="col-sm-6">
	                  		<input type="text" id="jk_pasien" class="form-control" name="jk_pasien" value="<?php echo $pasien->JK_PASIEN ?>" readonly>
	                  	</div>
                   	</div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="almt_pasien">Alamat</label>
	                  	<div class="col-sm-6">
	                    	<textarea id="almt_pasien" class="form-control" name="almt_pasien" readonly><?php echo $pasien->ALMT_PASIEN ?></textarea>
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="telp_pasien">Telepon</label>
	                  	<div class="col-sm-3">
	                    	<input type="text" id="telp_pasien" class="form-control" name="telp_pasien" value="<?php echo $pasien->TELP_PASIEN ?>" readonly>
	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label class="col-sm-2 control-label" for="tgl_daftar">Tanggal Daftar</label>
	                  	<div class="col-sm-3">
	                    	<input type="text" class="form-control" id="tgl_daftar" name="tgl_daftar" value="<?php echo date('d/m/Y', strtotime($pasien->TGL_DAFTAR)); ?>" required readonly>
	                  	</div>
	                </div>

					<div class="col-md-offset-2 col-md-5">
				        <a href="<?php echo base_url().'pasien/cetak_kartu/'.$pasien->ID_PASIEN ?>" class="btn btn-flat btn-success" target="_blank"><i class="fa fa-print"></i> Cetak Kartu</a>&nbsp;&nbsp;&nbsp;
				        <a href="<?php echo base_url().'registrasi_pemeriksaan' ?>" class="btn btn-flat btn-info"><i class="fa fa-edit"></i> Registrasi Pemeriksaan</a>
				    </div> 	               	   			              						              	
				</form>
			</div>
		</div>
	</div>
</div>
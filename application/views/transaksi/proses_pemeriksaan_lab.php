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
				<h3 class="box-title">Unggah Hasil</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form action="<?php echo base_url().'pemeriksaan_lab/simpan'; ?>" method="POST" class="form-horizontal" style="margin-top:10px" enctype="multipart/form-data">
					<div class="col-xs-6 col-md-6">
						<input type="hidden" name="id_rekam_medis" value="<?php echo $pemeriksaan_lab[0]->ID_REKAM_MEDIS; ?>">
						<input type="hidden" name="id_lab" value="<?php echo $pemeriksaan_lab[0]->ID_LAB; ?>">
						<input type="hidden" name="id_pasien" value="<?php echo $pemeriksaan_lab[0]->ID_PASIEN; ?>">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="nm_pasien">Pasien</label>
							<div class="col-sm-9">
								<input type="text" id="nm_pasien" class="form-control" name="nm_pasien" value="<?php echo $pemeriksaan_lab[0]->NM_PASIEN; ?>" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="jk_pasien">Jenis Kelamin</label>
							<div class="col-sm-9">
								<input type="text" id="jk_pasien" class="form-control" name="jk_pasien" value="<?php echo $pemeriksaan_lab[0]->JK_PASIEN; ?>" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="ttl_pasien">Tempat, Tanggal Lahir</label>
							<div class="col-sm-9">
								<input type="text" id="ttl_pasien" class="form-control" name="ttl_pasien" value="<?php echo $pasien[0]->NM_KOTA.', '.date('d-m-Y', strtotime($pemeriksaan_lab[0]->TGL_LHR_PASIEN)); ?>" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="umur_pasien">Umur</label>
							<div class="col-sm-9">
								<input type="text" id="umur_pasien" class="form-control" name="umur_pasien" 
									value="<?php echo date_diff(date_create($pemeriksaan_lab[0]->TGL_LHR_PASIEN), date_create('today'))->y; ?> Tahun" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="almt_pasien">Alamat</label>
							<div class="col-sm-9">
								<textarea id="almt_pasien" class="form-control" name="almt_pasien" readonly><?php echo $pemeriksaan_lab[0]->ALMT_PASIEN; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="telp_pasien">No. Telepon</label>
							<div class="col-sm-9">
								<input type="text" id="telp_pasien" class="form-control" name="telp_pasien" value="<?php echo $pemeriksaan_lab[0]->TELP_PASIEN; ?>" readonly />
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-md-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="dokter">Dokter Referensi</label>
							<div class="col-sm-9">
								<input type="text" id="dokter" class="form-control" name="dokter" value="<?php echo $pemeriksaan_lab[0]->NM_DOKTER; ?>" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="periksa">Lab Periksa</label>
							<div class="col-sm-9">
								<input type="text" id="periksa" class="form-control" name="periksa" value="<?php echo $pemeriksaan_lab[0]->LAB; ?>" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="hasil">Hasil Lab</label>
							<div class="col-sm-9">
								<input type="file" id="hasil" class="form-control" name="hasil" />
							</div>
						</div>
						<div class="col-md-offset-3 col-md-5">
					        <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-upload"></i> Unggah</button>&nbsp;
					        <button type="button" class="btn btn-flat btn-default" onclick="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i> Kembali</button>
					    </div>		              						              	
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
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
			<!--Body Content-->
			<div class="box-body">
				<form class="form-horizontal" style="margin-top:10px">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="id">#Pasien</label>
						<div class="col-sm-3">
							<input type="text" id="id" class="form-control" value="<?php echo $pasien[0]->ID_PASIEN; ?>" readonly required />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Nama Pasien</label>
						<div class="col-sm-9">
						    <input type="text" class="form-control" name="nama" value="<?php echo $pasien[0]->NM_PASIEN; ?>" readonly required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Jenis Kelamin</label>
						<div class="col-sm-9">
						    <input type="text" class="form-control" name="jk" value="<?php echo $pasien[0]->JK_PASIEN; ?>" readonly required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Tempat, Tanggal Lahir</label>
						<div class="col-sm-9">
						    <input type="text" class="form-control" name="ttl" value="<?php echo $pasien[0]->TMPT_LHR_PASIEN.', '.date('d-m-Y', strtotime($pasien[0]->TGL_LHR_PASIEN)); ?>" readonly required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Alamat</label>
						<div class="col-sm-9">
						    <textarea class="form-control" name="alamat" readonly required><?php echo $pasien[0]->JK_PASIEN; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">No. Telepon</label>
						<div class="col-sm-9">
						    <input type="text" class="form-control" name="telp" value="<?php echo $pasien[0]->TELP_PASIEN; ?>" readonly required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Tanggal Daftar</label>
						<div class="col-sm-5">
						    <input type="text" class="form-control" name="tgl_daftar" value="<?php echo $pasien[0]->TGL_DAFTAR; ?>" readonly required>
						</div>
					</div>
					<div class="col-md-offset-2 col-md-5">
				        <button type="reset" class="btn btn-flat btn-danger" onclick="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i> Kembali</button>
				    </div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Riwayat Pemeriksaan</h3>
			</div>

			<div class="box-body">
				<div class="col-sm-4 col-md-4" id="left-history" style="border-right: solid 2px #eee;">
					<?php $no = 1; foreach ($rekam_medis as $history): ?>
					<a href="#" onclick="load_history('<?php echo $history->ID_REKAM_MEDIS; ?>')"><?php echo $no.'. ['.date('d-m-Y', strtotime($history->TGL_PERIKSA)).'] '.$history->NM_DOKTER ?></a><br>
					<?php $no++; endforeach ?>
				</div>
				<div class="col-sm-8 col-md-8" id="content-history" style="border-left: solid 2px #eee;"></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function load_history(id) {
		$.ajax({
			url: '<?php echo base_url()."rekam_medis/get/"; ?>',
			data: {'id_rekam_medis': id},
			dataType: 'html',
			method: 'post',
			success: function(result) {
				$('#content-history').html(result);
			},
			error: function(xhr, status, error) {
				$('#content-history').html('<h1>Maaf!</h1><br>Gagal menampilkan data.<br><br>Error: ' + error);
			}
		});
	}
</script>
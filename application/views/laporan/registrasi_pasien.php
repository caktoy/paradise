<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Pilih Periode</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form action="<?php echo base_url().'laporan/registrasi_pasien/lihat'; ?>" method="POST" class="form-horizontal" style="margin-top:10px">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="bulan">Bulan</label>
						<div class="col-sm-4">
							<select id="bulan" class="form-control" name="bulan" required>
								<option value="1">Januari</option>
								<option value="2">Februari</option>
								<option value="3">Maret</option>
								<option value="4">April</option>
								<option value="5">Mei</option>
								<option value="6">Juni</option>
								<option value="7">Juli</option>
								<option value="8">Agustus</option>
								<option value="9">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="tahun">Tahun</label>
						<div class="col-sm-4">
						    <input type="number" id="tahun" class="form-control" name="tahun" value="<?php echo date('Y'); ?>" required>
						</div>
					</div>
					<div class="col-md-offset-2 col-md-5">
				        <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-eye"></i> Lihat</button>&nbsp;
				        <button type="reset" class="btn btn-flat btn-default"><i class="fa fa-refresh"></i> Reset</button>
				    </div> 	               	   			              						              	
				</form>
			</div>
		</div>
	</div>
</div>
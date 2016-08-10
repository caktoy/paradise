<?php if ($_SESSION['userrole'] == 'Administrasi'): ?>
<div class="row">
	<div class="col-xs-6">
		<div class="box box-success">
			<!--Body Content-->
			<div class="box-body">
				<div style="width: 100%;height: 400px;margin: 0 auto;" id="grafikKunjungan"></div>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="box box-success">
			<!--Body Content-->
			<div class="box-body">
				<div style="width: 100%;height: 400px;margin: 0 auto;" id="grafikRegistrasi"></div>
			</div>
		</div>
	</div>
</div>
<?php endif ?>

<?php if ($_SESSION['userrole'] == 'Kasir/Apotik'): ?>
<div class="row">
	<div class="col-xs-6">
		<div class="box box-success">
			<!--Body Content-->
			<div class="box-body">
				<div style="width: 100%;height: 400px;margin: 0 auto;" id="grafikObat"></div>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="box box-success">
			<!--Body Content-->
			<div class="box-body">
				<div style="width: 100%;height: 400px;margin: 0 auto;" id="grafikPendapatan"></div>
			</div>
		</div>
	</div>
</div>
<?php endif ?>

<?php if ($_SESSION['userrole'] == 'Dokter'): ?>
<div class="row">
	<div class="col-xs-6">
		<div class="box box-success">
			<!--Body Content-->
			<div class="box-body">
				<div style="width: 100%;height: 400px;margin: 0 auto;" id="grafikPenyakit"></div>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="box box-success">
			<!--Body Content-->
			<div class="box-body">
				<div style="width: 100%;height: 400px;margin: 0 auto;" id="grafikPemeriksaan"></div>
			</div>
		</div>
	</div>
</div>
<?php endif ?>

<?php if ($_SESSION['userrole'] == 'Laboratorium'): ?>
<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<!--Body Content-->
			<div class="box-body">
				<div style="width: 100%;height: 400px;margin: 0 auto;" id="grafikLab"></div>
			</div>
		</div>
	</div>
</div>
<?php endif ?>

<script src="<?php echo base_url(); ?>assets/beranda.js"></script>
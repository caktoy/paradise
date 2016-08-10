<?php if (isset($_SESSION['pesan'])) { ?>
  <div class="alert alert-block alert-info" role="alert">
    <button type="button" class="close" data-dismiss="alert">
      <i class="ace-icon fa fa-times"></i>
    </button>
    <?php echo $this->session->flashdata('pesan'); ?>
  </div>
<?php } ?>
<div class="row">
	<div class="col-xs-12 col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Registrasi Pemeriksaan</h3>
			</div>

			<div class="box-body">
				<form method="POST" action="<?php echo base_url(); ?>registrasi_pemeriksaan/new_order" class="form-horizontal">
					<input type="hidden" name="nomer" id="nomer" required>

					<div class="form-group">
	              		<label for="message-text" class="col-sm-2 control-label" for="pasien">Cari Pasien</label>
	              		<div class="col-sm-6">
	              			<div class="input-group">
								<select class="form-control select2" name="pasien" id="pasien" style="width: 100%;" required>
		                			<option></option>
		                			<?php foreach ($pasien as $pas): ?>
		                			<option value="<?php echo $pas->ID_PASIEN ?>">#<?php echo $pas->ID_PASIEN.' - '.$pas->NM_PASIEN ?></option>
		                			<?php endforeach ?>
		                		</select>
								<div class="input-group-btn">
									<a href="<?php echo base_url().'registrasi_pemeriksaan/add_pasien_baru' ?>" 
										class="btn btn-default"><i class="fa fa-plus"></i> Tambah</a>
								</div>
							</div>
	                    </div>
	            	</div>

	            	<div class="form-group">
	              		<label for="message-text" class="col-sm-2 control-label" for="poli">Poli</label>
	              		<div class="col-sm-6">
	                		<select class="form-control select2" name="poli" id="poli" style="width: 100%;" required>
	                			<option></option>
	                			<?php foreach ($poli as $pol): ?>
	                			<option value="<?php echo $pol->ID_POLI ?>"><?php echo 	$pol->NM_POLI ?></option>
	                			<?php endforeach ?>
	                		</select>
	              		</div>
	            	</div>

	            	<div class="form-group">
	              		<label for="message-text" class="col-sm-2 control-label" for="antrian">Antrian</label>
	              		<div class="col-sm-6">
							<div class="alert alert-info" style="text-align: center;font-weight: bold;font-size: 24pt;">
								<span id="nomer_antrian">Pilih Poli Terlebih Dahulu</span>
			              	</div>
	              		</div>
	            	</div>

	            	<div class="col-md-offset-2 col-md-6">
						<button type="submit" class="btn btn-flat btn-success"><i class="fa fa-check"></i> Simpan</button>
				        <button type="button" class="btn btn-flat btn-warning" onclick="location.reload();"><i class="fa fa-refresh"></i> Refresh</button>
				        <button type="button" class="btn btn-flat btn-info pull-right" id="btn-print-no"><i class="fa fa-print"></i> Cetak No. Antri</button>
				    </div>
				</form>
			</div>
		</div>
	</div>

	<div id="div-antrian"></div>
</div>

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
					$("#btn-print-no").hide();
        		} else {
					$("#nomer_antrian").html("Nomer Antrian: " + result);
					$("#nomer").val(result);
					$("#btn-print-no").show();
        		}
        	},
        	error: function(xhr, status, error) {
        		$("#nomer_antrian").html("Pilih Poli Terlebih Dahulu");
				$("#nomer").val(null);
				$("#btn-print-no").hide();
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

		$("#btn-print-no").click(function() {
			var no = $("#nomer").val();
			var poli = $("#poli").val();
			var pasien = $("#pasien").val();
			window.open("<?php echo base_url().'registrasi_pemeriksaan/cetak_antrian/' ?>" + pasien + "/" + poli + "/" + no, "_blank");
		});

		setInterval(function() {
			$.ajax({
				url: "<?php echo base_url().'registrasi_pemeriksaan/tbl_antrian' ?>",
				type: "get",
				dataType: "html",
				success: function(result) {
					$("#div-antrian").html(result);
				},
				error: function(xhr, status, error) {
					console.log(error);
					$("#div-antrian").html(error);
				}
			});
		}, 1000);
	});
</script>
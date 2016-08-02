<?php if (isset($_SESSION['pesan'])) { ?>
  <div class="alert alert-block alert-info" role="alert">
    <button type="button" class="close" data-dismiss="alert">
      <i class="ace-icon fa fa-times"></i>
    </button>
    <?php echo $this->session->flashdata('pesan'); ?>
  </div>
<?php } ?>
<?php  
$sub_total_tindakan = 0;
$sub_total_terapi = 0;
$sub_total_resep = 0;
?>
<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Detil Pemeriksaan</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<form class="form-horizontal" style="margin-top:10px">
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-sm-3 control-label">#Pemeriksaan</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" value="<?php echo $rekam_medis[0]->ID_REKAM_MEDIS; ?>" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tanggal Periksa</label>
							<div class="col-sm-9">
							    <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($rekam_medis[0]->TGL_PERIKSA)); ?>" readonly />
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Pasien</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" value="<?php echo $rekam_medis[0]->NM_PASIEN; ?>" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Dokter Referensi</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" value="<?php echo $rekam_medis[0]->NM_DOKTER; ?>" readonly />
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Hasil Pemeriksaan</h3>
			</div>

			<div class="box-body">
				<fieldset>
					<legend>Diagnosa</legend>
					<table id="tbl-diagnosa" class="table table-bordered table-striped" style="margin-top: 10px;">
			            <thead>
			                <tr>
				                <th style="width: 100px;">Kode</th>
				                <th>Penyakit</th>
				                <th>Keterangan</th>
				            </tr>
			            </thead>
			        	<tbody>
			        		<?php if (count($detil_diagnosis) > 0): ?>
			        		<?php foreach ($detil_diagnosis as $det_dg): ?>
			        		<tr>
			        			<td><?php echo $det_dg->KODE_ICD_10 ?></td>
			        			<td><?php echo $det_dg->NM_ICD_10 ?></td>
			        			<td><?php echo $det_dg->KETERANGAN_DG ?></td>
			        		</tr>
			        		<?php endforeach ?>
			        		<?php else: ?>
			        		<tr><td colspan="3">Tidak ada data yang ditampilkan.</td></tr>
			        		<?php endif ?>
	                   	</tbody>
            		</table>
				</fieldset>
				<fieldset>
					<legend>Tindakan</legend>
					<table id="tbl-tindakan" class="table table-bordered table-striped" style="margin-top: 10px;">
			            <thead>
			                <tr>
				                <th>Kode</th>
				                <th>Tindakan</th>
				                <th>Keterangan</th>
				                <th style="width: 200px;">Biaya</th>
				            </tr>
			            </thead>
			        	<tbody>
			        		<?php if (count($detil_tindakan) > 0): ?>
			        		<?php foreach ($detil_tindakan as $det_td): ?>
			        		<tr>
			        			<td><?php echo $det_td->KODE_ICD_9 ?></td>
			        			<td><?php echo $det_td->NM_ICD_9 ?></td>
			        			<td><?php echo $det_td->DETAIL_TINDAKAN ?></td>
			        			<td style="text-align: right;">Rp<?php echo number_format($det_td->HARGA_TINDAKAN, 2, ",", ".") ?></td>
			        		</tr>
			        		<?php $sub_total_tindakan += $det_td->HARGA_TINDAKAN; ?>
			        		<?php endforeach ?>
			        		<tr>
			        			<td style="text-align: right" colspan="3">SUB TOTAL</td>
			        			<td style="text-align: right"><?php echo 'Rp'.number_format($sub_total_tindakan, 2, ",", "."); ?></td>
			        		</tr>
			        		<?php else: ?>
			        		<tr><td colspan="4">Tidak ada data yang ditampilkan.</td></tr>
			        		<?php endif ?>
	                   	</tbody>
            		</table>
				</fieldset>
				<fieldset>
					<legend>Terapi</legend>
					<table id="tbl-terapi" class="table table-bordered table-striped" style="margin-top: 10px;">
			            <thead>
			                <tr>
				                <th>Kode</th>
				                <th>Terapi</th>
				                <th>Perawat</th>
				                <th>Keterangan</th>
				                <th style="width: 200px;">Biaya</th>
				            </tr>
			            </thead>
			        	<tbody>
			        		<?php if (count($detil_terapi) > 0): ?>
			        		<?php foreach ($detil_terapi as $det_tp): ?>
			        		<tr>
			        			<td><?php echo $det_tp->ID_TERAPI ?></td>
			        			<td><?php echo $det_tp->NM_TERAPI ?></td>
			        			<td><?php echo $det_tp->NM_PERAWAT ?></td>
			        			<td><?php echo $det_tp->KETERANGAN_TERAPI ?></td>
			        			<td style="text-align: right;">Rp<?php echo number_format($det_tp->BAYAR_TERAPI, 2, ",", ".") ?></td>
			        		</tr>
			        		<?php $sub_total_terapi += $det_td->BAYAR_TERAPI; ?>
			        		<?php endforeach ?>
			        		<tr>
			        			<td style="text-align: right" colspan="4">SUB TOTAL</td>
			        			<td style="text-align: right"><?php echo 'Rp'.number_format($sub_total_terapi, 2, ",", "."); ?></td>
			        		</tr>
			        		<?php else: ?>
			        		<tr><td colspan="5">Tidak ada data yang ditampilkan.</td></tr>
			        		<?php endif ?>
	                   	</tbody>
            		</table>
				</fieldset>
				<fieldset>
					<legend>Resep Obat</legend>
					<table id="tbl-obat" class="table table-bordered table-striped" style="margin-top: 10px;">
			            <thead>
			                <tr>
				                <th>Kode</th>
				                <th>Obat</th>
				                <th style="width:200px;">Harga Satuan</th>
				                <th>Jumlah</th>
				                <th style="width:15%;">Aksi</th>
				                <th style="width:200px;">Biaya</th>
				            </tr>
			            </thead>
			        	<tbody>
			        		<?php if (count($resep_obat) > 0): ?>
			        		<?php foreach ($resep_obat as $ro): ?>
			        		<tr>
			        			<td><?php echo $ro->ID_OBAT ?></td>
			        			<td><?php echo $ro->NM_OBAT ?></td>
			        			<td><?php echo 'Rp'.number_format($ro->HRG_OBAT, 2, ",", ".") ?></td>
			        			<td><?php echo $ro->KUANTITAS_OBAT ?></td>
			        			<td align="center">
			        			<button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#myModal" onclick="edit('<?php echo $ro->NO_RESEP ?>', '<?php echo $ro->NM_OBAT ?>', '<?php echo $ro->KUANTITAS_OBAT ?>')"><i class="fa fa-edit"></i> Ubah</button>
			        			<a href="<?php echo base_url().'pembayaran/remove_resep/'.$rekam_medis[0]->ID_REKAM_MEDIS.'/'.$ro->NO_RESEP ?>" class="btn btn-xs btn-danger" onclick="return confirm('Anda yakin?')"><i class="fa fa-remove"></i> Hapus</a>
			        			</td>
			        			<td style="text-align: right;">Rp<?php echo number_format($ro->SUB_TOTAL_RESEP, 2, ",", ".") ?></td>
			        		</tr>
			        		<?php $sub_total_resep += $ro->SUB_TOTAL_RESEP; ?>
			        		<?php endforeach ?>
			        		<tr>
			        			<td style="text-align: right" colspan="5">SUB TOTAL</td>
			        			<td style="text-align: right"><?php echo 'Rp'.number_format($sub_total_resep, 2, ",", "."); ?></td>
			        		</tr>
			        		<?php else: ?>
			        		<tr><td colspan="4">Tidak ada data yang ditampilkan.</td></tr>
			        		<?php endif ?>
	                   	</tbody>
            		</table>
				</fieldset>
				<fieldset>
					<legend>Summary</legend>
					<form method="post" action="<?php echo base_url().'pembayaran/simpan' ?>">
						<input type="hidden" name="txt_id_bayar" value="<?php echo $pembayaran[0]->ID_BAYAR; ?>">
						<input type="hidden" name="txt_rekam_medis" value="<?php echo $pembayaran[0]->ID_REKAM_MEDIS; ?>">
						<table class="table table-bordered table-striped" style="margin-top: 10px;">
							<tr>
								<td style="text-align: right;width: 80%;font-weight: bold;">TOTAL KESELURUHAN</td>
			        			<td style="text-align: right;width: 20%;font-weight: bold;">
			        				<?php echo 'Rp'.number_format(($sub_total_tindakan + $sub_total_terapi + $sub_total_resep), 2, ",", "."); ?>
			        				<input type="hidden" id="txt_total" name="txt_total" value="<?php echo ($sub_total_tindakan + $sub_total_terapi + $sub_total_resep) ?>">
			        			</td>
							</tr>
							<tr>
								<td style="text-align: right;width: 80%;font-weight: bold;">DISKON (%)</td>
			        			<td style="text-align: right;width: 20%;font-weight: bold;">
			        				<input type="number" id="txt_diskon" class="form-control col-xs-3" name="txt_diskon" value="<?php echo $pembayaran[0]->DISKON!=null?$pembayaran[0]->DISKON:'0'; ?>" min="0" max="100" style="text-align: right;">
			        			</td>
							</tr>
							<tr>
								<td style="text-align: right;width: 80%;font-weight: bold;">TOTAL BAYAR</td>
			        			<td style="text-align: right;width: 20%;font-weight: bold;">
			        				<span id="lbl_total_bayar" style="font-size: 18pt;">Rp0,00</span>
			        				<input type="hidden" id="txt_total_bayar" name="txt_total_bayar" value="<?php echo $pembayaran[0]->TOTAL_BAYAR!=null?$pembayaran[0]->TOTAL_BAYAR:($sub_total_tindakan + $sub_total_terapi + $sub_total_resep); ?>">
			        			</td>
							</tr>
						</table>

						<div align="center" style="margin-top: 10px;padding-top: 10px;border-top: solid #eee 2px;">
							<button type="button" class="btn btn-danger" onclick="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i> Kembali</button>
							<button type="submit" class="btn btn-success">
								<i class="fa fa-check"></i> Selesai
							</button>&nbsp;&nbsp;&nbsp;
							<?php if ($pembayaran[0]->TOTAL_BAYAR != null): ?>
							<a href="<?php echo base_url().'pembayaran/cetak/'.$pembayaran[0]->ID_REKAM_MEDIS; ?>" class="btn btn-info" target="_blank">
								<i class="fa fa-file-pdf-o"></i> PDF
							</a>
							<?php endif ?>
						</div>
					</form>
				</fieldset>
			</div>
		</div>
	</div>
</div>

<!--MODAL-->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Ubah Resep Obat</h4>
			</div>
			<div class="modal-body">     
				<form method="POST" action="<?php echo base_url(); ?>pembayaran/ubah_resep" class="form-horizontal">
					<input type="hidden" name="rekam_medis" value="<?php echo $rekam_medis[0]->ID_REKAM_MEDIS; ?>">
					<div class="form-group">
	              		<label for="message-text" class="col-sm-3 control-label">No. Resep</label>
	              		<div class="col-sm-9">
	                		<input type="text" class="form-control" name="editkode" id="editkode" readonly required>
	                    </div>
	            	</div>

	            	<div class="form-group">
	              		<label for="message-text" class="col-sm-3 control-label">Nama Obat</label>
	              		<div class="col-sm-9">
	                		<input type="text" class="form-control" name="editnama" id="editnama" readonly required>
	              		</div>
	            	</div>

	            	<div class="form-group">
	              		<label for="message-text" class="col-sm-3 control-label">Kuantitas</label>
	              		<div class="col-sm-9">
	                		<input type="number" class="form-control" name="editkuantitas" id="editkuantitas" required>
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
	function edit(id, nama, kuantitas) {
		$('#editkode').val(id);
		$('#editnama').val(nama);
		$('#editkuantitas').val(kuantitas);
	}

	$(function() {
		var diskon = $('#txt_diskon').val();
		var total = $('#txt_total').val();
		var total_bayar = total - (total * (diskon / 100));
		$('#lbl_total_bayar').html('Rp' + total_bayar);
		$('#txt_total_bayar').val(total_bayar);
		$('#txt_diskon').change(function() {
			var diskon = $(this).val();
			var total = $('#txt_total').val();
			var total_bayar = total - (total * (diskon / 100));
			$('#lbl_total_bayar').html('Rp' + total_bayar);
			$('#txt_total_bayar').val(total_bayar);
		});
	});
</script>
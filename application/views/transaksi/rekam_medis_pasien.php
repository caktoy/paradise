<div class="row">
	<div class="col-xs-12 col-md-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabRekamMedis" data-toggle="tab">Rekam Medis</a></li>
				<?php if ($is_odontogram): ?>
				<li><a href="#tabOdontogram" data-toggle="tab">Odontogram</a></li>
				<?php endif ?>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tabRekamMedis">
						<fieldset>
							<legend>Anamnesis</legend>
							<form class="form-horizontal" method="POST" action="<?php echo base_url().'rekam_medis/update/'.$rekam_medis[0]->ID_REKAM_MEDIS; ?>">
								<div class="col-xs-6 col-md-6">
									<input type="hidden" name="id_pasien" value="<?php echo $rekam_medis[0]->ID_PASIEN; ?>">
									<input type="hidden" name="id_rekam_medis" value="<?php echo $rekam_medis[0]->ID_REKAM_MEDIS; ?>">
									<div class="form-group">
										<label class="col-sm-3 control-label" for="nm_pasien">Pasien</label>
										<div class="col-sm-9">
											<input type="text" id="nm_pasien" class="form-control" name="nm_pasien" value="<?php echo $rekam_medis[0]->NM_PASIEN; ?>" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="keluhan">Keluhan</label>
										<div class="col-sm-9">
											<textarea id="keluhan" class="form-control" name="keluhan"><?php echo $rekam_medis[0]->ANAMNESIS; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="catatan_fisik">Catatan Fisik/Penunjang</label>
										<div class="col-sm-9">
											<textarea id="catatan_fisik" class="form-control" name="catatan_fisik"><?php echo $rekam_medis[0]->CATATAN_FISIK ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="alergi_obat">Alergi Obat</label>
										<div class="col-sm-9">
											<textarea id="alergi_obat" class="form-control" name="alergi_obat"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="alergi_makanan">Alergi Makanan</label>
										<div class="col-sm-9">
											<textarea id="alergi_makanan" class="form-control" name="alergi_makanan"></textarea>
										</div>
									</div>
								</div>
								<div class="col-xs-6 col-md-6">
									<div class="form-group">
										<label class="col-sm-3 control-label" for="jk_pasien">Jenis Kelamin</label>
										<div class="col-sm-9">
											<input type="text" id="jk_pasien" class="form-control" name="jk_pasien" value="<?php echo $rekam_medis[0]->JK_PASIEN; ?>" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="ttl_pasien">Tempat, Tanggal Lahir</label>
										<div class="col-sm-9">
											<input type="text" id="ttl_pasien" class="form-control" name="ttl_pasien" value="<?php echo $rekam_medis[0]->TMPT_LHR_PASIEN.', '.date('d-m-Y', strtotime($rekam_medis[0]->TGL_LHR_PASIEN)); ?>" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="umur_pasien">Umur</label>
										<div class="col-sm-9">
											<input type="text" id="umur_pasien" class="form-control" name="umur_pasien" 
												value="<?php echo date_diff(date_create($rekam_medis[0]->TGL_LHR_PASIEN), date_create('today'))->y; ?> Tahun" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="almt_pasien">Alamat</label>
										<div class="col-sm-9">
											<textarea id="almt_pasien" class="form-control" name="almt_pasien" readonly><?php echo $rekam_medis[0]->ALMT_PASIEN; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="telp_pasien">No. Telepon</label>
										<div class="col-sm-9">
											<input type="text" id="telp_pasien" class="form-control" name="telp_pasien" value="<?php echo $rekam_medis[0]->TELP_PASIEN; ?>" readonly />
										</div>
									</div>
									<div class="col-md-offset-3 col-md-9">
								        <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-plus"></i> Simpan</button>&nbsp;
								    </div>
								</div>
							</form>
						</fieldset>

						<fieldset>
							<legend>Diagnosis</legend>
							<div class="col-xs-12 col-md-12">
								<form class="form-horizontal" method="POST" action="<?php echo base_url().'rekam_medis/add_diagnosa/'.$rekam_medis[0]->ID_REKAM_MEDIS; ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label" for="diagnosis">Penyakit</label>
										<div class="col-sm-4">
											<select id="diagnosis" class="form-control select2" name="diagnosis" required>
												<option></option>
												<?php foreach ($diagnosis as $diagnosa): ?>
												<option value="<?php echo $diagnosa->KODE_ICD_10 ?>"><?php echo $diagnosa->NM_ICD_10 ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="keterangan">Keterangan</label>
										<div class="col-sm-4">
											<textarea id="keterangan" class="form-control" name="keterangan"></textarea>
										</div>
									</div>
									<div class="col-md-offset-2 col-md-4">
								        <button type="submit" id="add-diagnosa" class="btn btn-flat btn-success"><i class="fa fa-plus"></i> Tambah</button>&nbsp;
								    </div>
								</form>
					        	<table id="tbl-diagnosa" class="table table-bordered table-striped" style="margin-top: 10px;">
						            <thead>
						                <tr>
							                <th>#</th>
							                <th>Penyakit</th>
							                <th>Keterangan</th>
							                <th style="width:15%;">Aksi</th>
							            </tr>
						            </thead>
						        	<tbody>
						        		<?php if (count($detil_diagnosis) > 0): ?>
						        		<?php foreach ($detil_diagnosis as $det_dg): ?>
						        		<tr>
						        			<td><?php echo $det_dg->KODE_ICD_10 ?></td>
						        			<td><?php echo $det_dg->NM_ICD_10 ?></td>
						        			<td><?php echo $det_dg->KETERANGAN_DG ?></td>
						        			<td align="center"><a href="<?php echo base_url().'rekam_medis/remove_diagnosa/'.$rekam_medis[0]->ID_REKAM_MEDIS.'/'.$det_dg->KODE_ICD_10 ?>" class="btn btn-xs btn-danger">Hapus</a></td>
						        		</tr>
						        		<?php endforeach ?>
						        		<?php else: ?>
						        		<tr><td colspan="4">Tidak ada data yang ditampilkan.</td></tr>
						        		<?php endif ?>
				                   	</tbody>
		                		</table>
							</div>
						</fieldset>

						<fieldset>
							<legend>Tindakan</legend>
							<div class="col-xs-12 col-md-12">
								<form class="form-horizontal" method="POST" action="<?php echo base_url().'rekam_medis/add_tindakan/'.$rekam_medis[0]->ID_REKAM_MEDIS; ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label" for="tindakan">Tindakan</label>
										<div class="col-sm-4">
											<select id="tindakan" class="form-control select2" name="tindakan" required>
												<option></option>
												<?php foreach ($tindakan as $tindak): ?>
												<option value="<?php echo $tindak->KODE_ICD_9 ?>"><?php echo $tindak->NM_ICD_9 ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="keterangan">Keterangan</label>
										<div class="col-sm-4">
											<textarea id="keterangan" class="form-control" name="keterangan"></textarea>
										</div>
									</div>
									<div class="col-md-offset-2 col-md-4">
								        <button type="submit" id="add-tindakan" class="btn btn-flat btn-success"><i class="fa fa-plus"></i> Tambah</button>&nbsp;
								    </div>
								</form>
					        	<table id="tbl-tindakan" class="table table-bordered table-striped" style="margin-top: 10px;">
						            <thead>
						                <tr>
							                <th>#</th>
							                <th>Tindakan</th>
							                <th>Keterangan</th>
							                <th style="width:15%;">Aksi</th>
							            </tr>
						            </thead>
						        	<tbody>
						        		<?php if (count($detil_tindakan) > 0): ?>
						        		<?php foreach ($detil_tindakan as $det_td): ?>
						        		<tr>
						        			<td><?php echo $det_td->KODE_ICD_9 ?></td>
						        			<td><?php echo $det_td->NM_ICD_9 ?></td>
						        			<td><?php echo $det_td->DETAIL_TINDAKAN ?></td>
						        			<td align="center"><a href="<?php echo base_url().'rekam_medis/remove_tindakan/'.$rekam_medis[0]->ID_REKAM_MEDIS.'/'.$det_td->KODE_ICD_9 ?>" class="btn btn-xs btn-danger">Hapus</a></td>
						        		</tr>
						        		<?php endforeach ?>
						        		<?php else: ?>
						        		<tr><td colspan="4">Tidak ada data yang ditampilkan.</td></tr>
						        		<?php endif ?>
				                   	</tbody>
		                		</table>
							</div>
						</fieldset>

						<fieldset>
							<legend>Terapi</legend>
							<div class="col-xs-12 col-md-12">
								<form class="form-horizontal" method="POST" action="<?php echo base_url().'rekam_medis/add_terapi/'.$rekam_medis[0]->ID_REKAM_MEDIS; ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label" for="terapi">Terapi</label>
										<div class="col-sm-4">
											<select id="terapi" class="form-control select2" name="terapi" required>
												<option></option>
												<?php foreach ($terapi as $ter): ?>
												<option value="<?php echo $ter->ID_TERAPI ?>"><?php echo $ter->NM_TERAPI ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="perawat">Perawat</label>
										<div class="col-sm-4">
											<select id="perawat" class="form-control select2" name="perawat" required>
												<option></option>
												<?php foreach ($perawat as $per): ?>
												<option value="<?php echo $per->ID_PERAWAT ?>"><?php echo '#'.$per->ID_PERAWAT.' '.$per->NM_PERAWAT ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="keterangan">Keterangan</label>
										<div class="col-sm-4">
											<textarea id="keterangan" class="form-control" name="keterangan"></textarea>
										</div>
									</div>
									<div class="col-md-offset-2 col-md-4">
								        <button type="submit" id="add-terapi" class="btn btn-flat btn-success"><i class="fa fa-plus"></i> Tambah</button>&nbsp;
								    </div>
								</form>
					        	<table id="tbl-terapi" class="table table-bordered table-striped" style="margin-top: 10px;">
						            <thead>
						                <tr>
							                <th>#</th>
							                <th>Terapi</th>
							                <th>Perawat</th>
							                <th>Keterangan</th>
							                <th style="width:15%;">Aksi</th>
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
						        			<td align="center"><a href="<?php echo base_url().'rekam_medis/remove_terapi/'.$rekam_medis[0]->ID_REKAM_MEDIS.'/'.$det_tp->ID_TERAPI ?>" class="btn btn-xs btn-danger">Hapus</a></td>
						        		</tr>
						        		<?php endforeach ?>
						        		<?php else: ?>
						        		<tr><td colspan="4">Tidak ada data yang ditampilkan.</td></tr>
						        		<?php endif ?>
				                   	</tbody>
		                		</table>
							</div>
						</fieldset>

						<fieldset>
							<legend>Obat</legend>
							<div class="col-xs-12 col-md-12">
								<form class="form-horizontal" method="POST" action="<?php echo base_url().'rekam_medis/add_resep_obat/'.$rekam_medis[0]->ID_REKAM_MEDIS; ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label" for="obat">Obat</label>
										<div class="col-sm-4">
											<select id="obat" class="form-control select2" name="obat" required>
												<option></option>
												<?php foreach ($obat as $o): ?>
												<option value="<?php echo $o->ID_OBAT ?>"><?php echo $o->NM_OBAT ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="jumlah">Jumlah</label>
										<div class="col-sm-4">
											<input type="number" id="jumlah" class="form-control" name="jumlah" value="0" required>
										</div>
									</div>
									<div class="col-md-offset-2 col-md-4">
								        <button type="submit" id="add-obat" class="btn btn-flat btn-success"><i class="fa fa-plus"></i> Tambah</button>&nbsp;
								    </div>
								</form>
					        	<table id="tbl-obat" class="table table-bordered table-striped" style="margin-top: 10px;">
						            <thead>
						                <tr>
							                <th>#</th>
							                <th>Obat</th>
							                <th>Jumlah</th>
							                <th style="width:15%;">Aksi</th>
							            </tr>
						            </thead>
						        	<tbody>
						        		<?php if (count($resep_obat) > 0): ?>
						        		<?php foreach ($resep_obat as $ro): ?>
						        		<tr>
						        			<td><?php echo $ro->ID_OBAT ?></td>
						        			<td><?php echo $ro->NM_OBAT ?></td>
						        			<td><?php echo $ro->KUANTITAS_OBAT ?></td>
						        			<td align="center"><a href="<?php echo base_url().'rekam_medis/remove_resep_obat/'.$rekam_medis[0]->ID_REKAM_MEDIS.'/'.$ro->NO_RESEP ?>" class="btn btn-xs btn-danger">Hapus</a></td>
						        		</tr>
						        		<?php endforeach ?>
						        		<?php else: ?>
						        		<tr><td colspan="4">Tidak ada data yang ditampilkan.</td></tr>
						        		<?php endif ?>
				                   	</tbody>
		                		</table>
							</div>
						</fieldset>

					<div align="center" style="margin-top: 10px;padding-top: 10px;border-top: solid #eee 2px;">
						<button type="button" class="btn btn-success"><i class="fa fa-check"></i> Selesai</button>
						<button type="button" class="btn btn-danger" onclick="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i> Kembali</button>
					</div>
				</div>
				<div class="tab-pane" id="tabOdontogram">Odontogram</div>
			</div>
		</div>
	</div>
</div>
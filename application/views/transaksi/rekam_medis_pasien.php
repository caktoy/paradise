<div class="row">
	<div class="col-xs-12 col-md-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li <?php if(!isset($_SESSION['active_odontogram'])) echo "class='active'"; ?>><a href="#tabRekamMedis" data-toggle="tab">Rekam Medis</a></li>
				
				<?php if ($is_odontogram): ?>
				<li <?php if(isset($_SESSION['active_odontogram'])) echo "class='active'"; ?>><a href="#tabOdontogram" data-toggle="tab">Odontogram</a></li>
				<?php endif ?>

				<?php if (isset($history_rekam_medis)): ?>
				<li><a href="#tabHistory" data-toggle="tab">Riwayat</a></li>
				<?php endif ?>
			</ul>
			<div class="tab-content">
				<div class="tab-pane <?php if(!isset($_SESSION['active_odontogram'])) echo 'active'; ?>" id="tabRekamMedis">
					<fieldset>
						<legend>Pemeriksaan Pasien</legend>
						<form class="form-horizontal" method="POST" action="<?php echo base_url().'rekam_medis/record'; ?>">
							<div class="col-xs-6 col-md-6">
								<input type="hidden" name="id_pasien" value="<?php echo $rekam_medis[0]->ID_PASIEN; ?>">
								<input type="hidden" name="id_dokter" value="<?php echo $rekam_medis[0]->ID_DOKTER; ?>">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="nm_pasien">No. Rekam Medis</label>
									<div class="col-sm-9">
										<input type="text" name="id_rekam_medis" class="form-control" value="<?php echo $rekam_medis[0]->ID_REKAM_MEDIS; ?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="nm_pasien">Pasien</label>
									<div class="col-sm-9">
										<input type="text" id="nm_pasien" class="form-control" name="nm_pasien" value="<?php echo $rekam_medis[0]->NM_PASIEN; ?>" readonly />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="nm_dokter">Dokter</label>
									<div class="col-sm-9">
										<input type="text" id="nm_dokter" class="form-control" name="nm_dokter" value="<?php echo $rekam_medis[0]->NM_DOKTER; ?>" readonly />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="anamnesis">Anamnesis</label>
									<div class="col-sm-9">
										<textarea id="anamnesis" class="form-control" name="anamnesis" placeholder="Anamnesis"><?php echo $rekam_medis[0]->ANAMNESIS; ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="catatan_fisik">Catatan Fisik</label>
									<div class="col-sm-9">
										<textarea id="catatan_fisik" class="form-control" name="catatan_fisik" placeholder="Catatan Fisik"><?php echo $rekam_medis[0]->CTTN_FISIK ?></textarea>
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
										<input type="text" id="ttl_pasien" class="form-control" name="ttl_pasien" value="<?php echo $pasien[0]->NM_KOTA.', '.date('d-m-Y', strtotime($rekam_medis[0]->TGL_LHR_PASIEN)); ?>" readonly />
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
									<label class="col-sm-3 control-label" for="telp_pasien">No. Telepon</label>
									<div class="col-sm-9">
										<input type="text" id="telp_pasien" class="form-control" name="telp_pasien" value="<?php echo $rekam_medis[0]->TELP_PASIEN; ?>" readonly />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="almt_pasien">Alamat</label>
									<div class="col-sm-9">
										<textarea id="almt_pasien" class="form-control" name="almt_pasien" rows="3" readonly><?php echo $rekam_medis[0]->ALMT_PASIEN; ?></textarea>
									</div>
								</div>
							</div>
							
							<div class="col-xs-12 col-md-12" style="padding-top: 20px; border-top: 2px solid #ececec;">
								<div class="form-group">
									<label class="col-sm-2 control-label" for="diagnosis">Diagnosis</label>
									<div class="col-sm-10">
										<select id="diagnosis" name="diagnosis[]" class="form-control select2" multiple="multiple" data-placeholder="Hasil diagnosis penyakit" style="width: 100%;">
											<?php foreach ($diagnosis as $diagnosa): ?>
											<option value="<?php echo $diagnosa->KODE_ICD_10 ?>" 
												<?php echo in_array($diagnosa->KODE_ICD_10, $detil_diagnosis)?"selected":""; ?>>
												<?php echo $diagnosa->NM_ICD_10 ?>
											</option>
											<?php endforeach ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label" for="tindakan">Tindakan</label>
									<div class="col-sm-10">
										<select id="tindakan" name="tindakan[]" class="form-control select2" multiple="multiple" data-placeholder="Tindakan yang dilakukan" style="width: 100%;">
											<?php foreach ($tindakan as $tindak): ?>
											<option value="<?php echo $tindak->KODE_ICD_9 ?>" 
												<?php echo in_array($tindak->KODE_ICD_9, $detil_tindakan)?"selected":""; ?>>
												<?php echo $tindak->NM_ICD_9 ?>
											</option>
											<?php endforeach ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label" for="terapi">Terapi</label>
									<div class="col-sm-10">
										<div class="row">
											<div class="col-xs-6">
												<select id="terapi" name="terapi[]" class="form-control select2" multiple="multiple" data-placeholder="Terapi yang perlu dilakukan" style="width: 100%;">
													<option></option>
													<?php foreach ($terapi as $ter): ?>
													<option value="<?php echo $ter->ID_TERAPI ?>" 
														<?php echo in_array($ter->ID_TERAPI, $detil_terapi)?"selected":""; ?>>
														<?php echo $ter->NM_TERAPI ?>
													</option>
													<?php endforeach ?>
												</select>
											</div>
											<div class="col-xs-6">
												<select id="perawat_terapi" name="perawat_terapi" class="form-control select2" data-placeholder="Pendamping terapi" style="width: 100%;">
													<option></option>
													<?php foreach ($perawat as $per): ?>
													<option value="<?php echo $per->ID_PERAWAT ?>" 
														<?php echo $per->ID_PERAWAT==$perawat_terapi?"selected":""; ?>>
														<?php echo $per->NM_PERAWAT ?>
													</option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label" for="lab">Pemeriksaan Lab</label>
									<div class="col-sm-10">
										<select id="lab" name="lab[]" class="form-control select2" multiple="multiple" data-placeholder="Pemeriksaan lab" style="width: 100%;">
											<?php foreach ($pemeriksaan_lab as $lab): ?>
											<option value="<?php echo $lab->ID_LAB ?>" 
												<?php echo in_array($lab->ID_LAB, $hasil_lab)?"selected":""; ?>>
												<?php echo $lab->LAB ?>
											</option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>

							<div class="col-xs-12 col-md-12" style="padding-top: 20px; border-top: 2px solid #ececec;">
								<div class="row">
					            	<div class="col-sm-5">
					            		<div class="form-group">
					                  		<label class="col-sm-3 control-label">Obat</label>
					                    	<div class="col-sm-9">
					                    		<select id="obat" class="form-control select2" name="obat" data-placeholder="Pilih Obat...">
													<option></option>
													<?php foreach ($obat as $o): ?>
													<option value="<?php echo $o->ID_OBAT ?>"><?php echo $o->NM_OBAT ?></option>
													<?php endforeach ?>
												</select>
					                    	</div>
			                			</div>
					            	</div>
					            	<div class="col-sm-4">
					            		<div class="form-group">
					                  		<label class="col-sm-2 control-label" for="dosis">Dosis</label>
					                    	<div class="col-sm-10">
					                    		<input type="text" id="dosis" class="form-control" name="dosis" placeholder="Dosis Pakai">
					                    	</div>
			                			</div>
					            	</div>
					            	<div class="col-sm-2">
					            		<div class="form-group">
					                  		<label class="col-sm-2 control-label" for="jumlah">Qty</label>
					                    	<div class="col-sm-10">
					                    		<input type="number" id="jumlah" class="form-control" name="jumlah" placeholder="Quantity">
					                    	</div>
			                			</div>
					            	</div>
					            	<div class="col-sm-1">
					                  	<button type="button" id="add-obat" class="btn btn-flat btn-primary"><i class="fa fa-plus"></i></button>
					            	</div>
					            </div>
					        	<table id="tbl-obat" class="table table-bordered table-striped" style="margin-top: 10px;">
						            <thead>
						                <tr>
							                <th>#</th>
							                <th>Obat</th>
							                <th>Dosis</th>
							                <th>Qty</th>
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
						        			<td align="center">
						        				<!-- <a href="<?php echo base_url().'rekam_medis/remove_resep_obat/'.$rekam_medis[0]->ID_REKAM_MEDIS.'/'.$ro->NO_RESEP ?>" class="btn btn-xs btn-danger">Hapus</a> -->
						        				<button class='btn btn-danger btn-xs hapus_obat'>Hapus</button>
						        			</td>
						        		</tr>
						        		<?php endforeach ?>
						        		<?php endif ?>
				                   	</tbody>
		                		</table>
							</div>
							
							<div align="center" class="col-xs-12 col-md-12" style="margin-top: 10px;padding-top: 10px;border-top: solid #eee 2px;">
								<!-- <a href="<?php echo base_url().'rekam_medis/close_proses/'.$rekam_medis[0]->ID_PASIEN; ?>" class="btn btn-success" 
									onclick="return confirm('Anda yakin akan mengakhiri pemeriksaan?')">
									<i class="fa fa-check"></i> Selesai
								</a> -->
								<button type="submit" class="btn btn-success" onclick="return confirm('Anda yakin akan mengakhiri pemeriksaan?')"><i class="fa fa-check"></i> Selesai</button>
								<button type="button" class="btn btn-danger" onclick="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i> Kembali</button>
							</div>
						</form>
					</fieldset>

				</div>

				<?php if ($is_odontogram): ?>
				<div class="tab-pane <?php if(isset($_SESSION['active_odontogram'])) echo 'active'; ?>" id="tabOdontogram">
					<fieldset>
						<legend>Diagram Odontogram</legend>
						<div class="col-xs-12 col-md-12">
							<table cellspacing="0" cellpadding="0" border="0" width="100%">
								<tr>
									<td style="width: 50%; border-right: black solid 2px;border-bottom: black solid 2px;text-align: right;padding: 15px;">
										<table cellspacing="0" cellpadding="0" border="0" width="100%">
											<tr>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(18)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														18<br>
														<?php if (isset($odontogram[18])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[18]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo18">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(17)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														17<br>
														<?php if (isset($odontogram[17])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[17]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo17">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(16)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														16<br>
														<?php if (isset($odontogram[16])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[16]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo16">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(15)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														15<br>
														<?php if (isset($odontogram[15])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[15]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo15">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(14)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														14<br>
														<?php if (isset($odontogram[14])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[14]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo14">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(13)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														13<br>
														<?php if (isset($odontogram[13])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[13]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo13">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(12)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														12<br>
														<?php if (isset($odontogram[12])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[12]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo12">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(11)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														11<br>
														<?php if (isset($odontogram[11])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[11]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo11">
														<?php endif ?>
													</button>
												</td>
											</tr>
											<tr>
												<td colspan="3">&nbsp;</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(55)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														55<br>
														<?php if (isset($odontogram[55])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[55]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo55">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(54)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														54<br>
														<?php if (isset($odontogram[54])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[54]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo54">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(53)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														53<br>
														<?php if (isset($odontogram[53])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[53]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo53">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(52)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														52<br>
														<?php if (isset($odontogram[52])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[52]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo52">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(51)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														51<br>
														<?php if (isset($odontogram[51])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[51]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo51">
														<?php endif ?>
													</button>
												</td>
											</tr>
										</table>
									</td>
									<td style="width: 50%; border-left: black solid 2px;border-bottom: black solid 2px;text-align: left;padding: 15px;">
										<table cellspacing="0" cellpadding="0" border="0" width="100%">
											<tr>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(21)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														21<br>
														<?php if (isset($odontogram[21])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[21]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo21">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(22)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														22<br>
														<?php if (isset($odontogram[22])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[22]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo22">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(23)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														23<br>
														<?php if (isset($odontogram[23])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[23]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo23">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(24)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														24<br>
														<?php if (isset($odontogram[24])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[24]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo24">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(25)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														25<br>
														<?php if (isset($odontogram[25])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[25]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo25">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(26)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														26<br>
														<?php if (isset($odontogram[26])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[26]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo26">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(27)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														27<br>
														<?php if (isset($odontogram[27])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[27]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo27">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(28)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														28<br>
														<?php if (isset($odontogram[28])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[28]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo28">
														<?php endif ?>
													</button>
												</td>
											</tr>
											<tr>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(61)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														61<br>
														<?php if (isset($odontogram[61])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[61]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo61">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(62)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														62<br>
														<?php if (isset($odontogram[62])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[62]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo62">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(63)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														63<br>
														<?php if (isset($odontogram[63])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[63]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo63">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(64)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														64<br>
														<?php if (isset($odontogram[64])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[64]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo64">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(65)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														65<br>
														<?php if (isset($odontogram[65])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[65]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo65">
														<?php endif ?>
													</button>
												</td>
												<td colspan="3">&nbsp;</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td style="width: 50%; border-right: black solid 2px;border-top: black solid 2px;text-align: right;padding: 15px;">
										<table cellspacing="0" cellpadding="0" border="0" width="100%">
											<tr>
												<td colspan="3">&nbsp;</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(85)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														85<br>
														<?php if (isset($odontogram[85])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[85]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo85">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(84)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														84<br>
														<?php if (isset($odontogram[84])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[84]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo84">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(83)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														83<br>
														<?php if (isset($odontogram[83])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[83]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo83">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(82)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														82<br>
														<?php if (isset($odontogram[82])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[82]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo82">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(81)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														81<br>
														<?php if (isset($odontogram[81])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[81]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo81">
														<?php endif ?>
													</button>
												</td>
											</tr>
											<tr>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(48)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														48<br>
														<?php if (isset($odontogram[48])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[48]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo48">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(47)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														47<br>
														<?php if (isset($odontogram[47])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[47]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo47">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(46)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														46<br>
														<?php if (isset($odontogram[46])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[46]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo46">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(45)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														45<br>
														<?php if (isset($odontogram[45])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[45]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo45">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(44)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														44<br>
														<?php if (isset($odontogram[44])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[44]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo44">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(43)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														43<br>
														<?php if (isset($odontogram[43])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[43]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo43">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(42)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														42<br>
														<?php if (isset($odontogram[42])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[42]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo42">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(41)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														41<br>
														<?php if (isset($odontogram[41])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[41]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo41">
														<?php endif ?>
													</button>
												</td>
											</tr>
										</table>
									</td>
									<td style="width: 50%; border-left: black solid 2px;border-top: black solid 2px;text-align: left;padding: 15px;">
										<table cellspacing="0" cellpadding="0" border="0" width="100%">
											<tr>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(71)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														71<br>
														<?php if (isset($odontogram[71])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[71]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo71">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(72)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														72<br>
														<?php if (isset($odontogram[72])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[72]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo72">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(73)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														73<br>
														<?php if (isset($odontogram[73])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[73]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo73">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(74)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														74<br>
														<?php if (isset($odontogram[74])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[74]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo74">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(75)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														75<br>
														<?php if (isset($odontogram[75])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[75]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo75">
														<?php endif ?>
													</button>
												</td>
												<td colspan="3">&nbsp;</td>
											</tr>
											<tr>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(31)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														31<br>
														<?php if (isset($odontogram[31])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[31]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo31">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(32)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														32<br>
														<?php if (isset($odontogram[32])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[32]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo32">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(33)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														33<br>
														<?php if (isset($odontogram[33])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[33]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo33">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(34)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														34<br>
														<?php if (isset($odontogram[34])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[34]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo34">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(35)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														35<br>
														<?php if (isset($odontogram[35])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[35]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo35">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(36)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														36<br>
														<?php if (isset($odontogram[36])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[36]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo36">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(37)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														37<br>
														<?php if (isset($odontogram[37])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[37]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo37">
														<?php endif ?>
													</button>
												</td>
												<td>
													<button class="btn btn-default" data-toggle="modal" data-target="#modalOdontogram" type="button" onclick="setNomenklatur(38)" style="background-color: Transparent;background-repeat:no-repeat;border: none;">
														38<br>
														<?php if (isset($odontogram[38])): ?>
														<img src="<?php echo base_url().'assets/images/odontogram/'.$odontogram[38]; ?>" height="30px">
														<?php else: ?>
														<img src="<?php echo base_url().'assets/images/default-odontogram.png'; ?>" height="30px" id="imgNo38">
														<?php endif ?>
													</button>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<div class="col-xs-12 col-md-12">
								<strong>Keterangan Status Gigi:</strong><br>
								<table width="100%">
									<?php foreach ($status_gigi as $sg): ?>
									<tr valign="center">
										<td width="30px"><img src="<?php echo base_url().'assets/images/odontogram/'.$sg->GAMBAR; ?>" width="25px"></td>
										<td><?php echo $sg->STATUS.' ('.$sg->KODE_STATUS.')' ?></td>
									</tr>
									<?php endforeach ?>
								</table>
							</div>
						</div>
					</fieldset>
				</div>
				<?php endif ?>
				
				<?php if (isset($history_rekam_medis)): ?>
				<div class="tab-pane" id="tabHistory">
					<fieldset>
						<legend>Riwayat Rekam Medis Pasien</legend>
						<div class="col-xs-4 col-md-4" id="left-history" style="border-right: solid 2px #eee;">
							<?php $no = 1; foreach ($history_rekam_medis as $history): ?>
							<a href="#" onclick="load_history('<?php echo $history->ID_REKAM_MEDIS; ?>')"><?php echo $no.'. ['.date('d-m-Y', strtotime($history->TGL_PERIKSA)).'] '.$history->NM_DOKTER ?></a><br>
							<?php $no++; endforeach ?>
						</div>
						<div class="col-xs-8 col-md-8" id="content-history" style="border-left: solid 2px #eee;"></div>
					</fieldset>
				</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>

<!--MODAL ADD-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalOdontogram" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Status Gigi</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<input type="hidden" name="rekam_medis" id="rekam_medis" value="<?php echo $rekam_medis[0]->ID_REKAM_MEDIS; ?>" required>
					<input type="hidden" name="dokter-odo" id="dokter-odo" value="<?php echo $rekam_medis[0]->ID_DOKTER; ?>" required>
					<input type="hidden" name="pasien-odo" id="pasien-odo" value="<?php echo $rekam_medis[0]->ID_PASIEN; ?>" required>
					<div class="form-group">
	              		<label for="message-text" class="col-sm-3 control-label" for="nomenklatur">Nomenklatur</label>
	              		<div class="col-sm-9">
	                		<input type="text" class="form-control" name="nomenklatur" id="nomenklatur" readonly required>
	                    </div>
	            	</div>

	            	<div class="form-group">
	              		<label for="message-text" class="col-sm-3 control-label" for="catatan-odo">Catatan</label>
	              		<div class="col-sm-9">
	                		<textarea class="form-control" name="catatan-odo" id="catatan-odo" placeholder="Catatan odontogram"></textarea>
	                    </div>
	            	</div>

	            	<div class="form-group">
	              		<label for="message-text" class="col-sm-3 control-label" for="status">Status Gigi</label>
	              		<div class="col-sm-9">
	              			<select id="status" name="status" class="form-control select2" data-placeholder="Status gigi" style="width: 100%;">
		              			<option></option>
		              			<?php foreach ($status_gigi as $sg): ?>
		              			<option value="<?php echo $sg->GAMBAR ?>"><?php echo $sg->STATUS.' ('.$sg->KODE_STATUS.')'; ?></option>
		              			<?php endforeach ?>
	              			</select>
	              		</div>
	            	</div>
	        
					<div class="modal-footer">
						<button type="button" class="btn btn-flat btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
						<button type="button" class="btn btn-flat btn-warning" id="btn-save-odontogram"><i class="fa fa-check"></i> Simpan</button>
					</div>
				</form>
			</div>           					
		</div>
	</div>
</div>
<!--END MODAL-->

<script type="text/javascript">
	function setNomenklatur(nomer) {
		$("#nomenklatur").val(nomer);
	}

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

	function load_resep(id) {
		$('#tbl-obat tr').not(function(){ return !!$(this).has('th').length; }).remove();
		$.getJSON("<?php echo base_url().'resep_obat/get/' ?>" + id, function(result) {
			$.each(result, function(i, obat) {
				var str_row = "<tr>" + 
					"<td>" + obat.ID_OBAT + "</td>" +
					"<td>" + obat.NM_OBAT + "</td>" +
					"<td>" + obat.PEMAKAIAN + "</td>" +
					"<td>" + obat.KUANTITAS_OBAT + " " + obat.SATUAN + "</td>" +
					"<td align='center'>" + 
					"<button type='button' class='btn btn-danger btn-xs hapus_obat' data-noresep='" + obat.NO_RESEP + "'>" + 
					"<i class='fa fa-trash'></i> Hapus</button></td>" +
					"</tr>";
				$("#tbl-obat > tbody:last-child").append(str_row);
			});
			$('.hapus_obat').click(function(e) {
				var noresep = $(this).data('noresep');
				delete_resep(noresep);
				$(this).closest('tr').remove();
			});
		});
	}

	function delete_resep(noresep) {
		$.ajax({
			url: "<?php echo base_url().'resep_obat/delete_resep' ?>",
			type: "post",
			data: {"noresep": noresep}
		});
	}

	$(document).ready(function() {
		// obat
		var rekam_medis = $("#rekam_medis").val();
		var dokter = $("#dokter-odo").val();
		var pasien = $("#pasien-odo").val();
		
		load_resep(rekam_medis);
		
		$("#add-obat").click(function() {
			// var rekam_medis = $("#rekam_medis").val();
			// var dokter = $("#dokter-odo").val();
			// var pasien = $("#pasien-odo").val();

			var id = $("#obat").val();
			var dosis = $("#dosis").val();
			var jumlah = $("#jumlah").val();
			$.ajax({
				url: '<?php echo base_url()."resep_obat/add_obat"; ?>',
				type: 'post',
				data: {
					'rekam_medis': rekam_medis,
					'dokter': dokter,
					'pasien': pasien,
					'obat': id,
					'dosis': dosis,
					'jumlah': jumlah
				},
				success: function(result) {
					if (result == "sukses") {
						load_resep(rekam_medis);
					} else {
						alert("Gagal menambahkan obat.");
						load_resep(rekam_medis);
					}

					$("#obat").select2("val", "");
					$("#dosis").val(null);
					$("#jumlah").val(null);
				},
				error: function(xhr, status, error) {
					alert('Gagal menambahkan obat.');
					load_resep(rekam_medis);
				}
			});
		});

		$("#btn-save-odontogram").click(function() {
			var status = $("#status").val();
			var nomer = $("#nomenklatur").val();
			var catatan = $("#catatan-odo").val();
			// var rekam_medis = $("#rekam_medis").val();
			// var dokter = $("#dokter-odo").val();
			// var pasien = $("#pasien-odo").val();
			$.ajax({
				url: "<?php echo base_url().'odontogram/simpan_odo' ?>",
				type: "post",
				data: {
					"rekam_medis": rekam_medis, 
					"kode_status": status, 
					"dokter": dokter, 
					"pasien": pasien, 
					"nomenklatur": nomer, 
					"cttn_od": catatan
				},
				success: function(result) {
					if(result == "sukses") {
						$("#imgNo" + nomer).prop("src", "<?php echo base_url().'assets/images/odontogram/'; ?>" + status);
					} else {
						alert("Gagal menyimpan data odontogram.");
					}

					$("#status").select2("val", "");
					$("#catatan-odo").val(null);
					$('#modalOdontogram').modal('hide');
				},
				error: function(xhr, status, error) {
					alert("Gagal menyimpan data odontogram.");
					console.log(error);

					$("#status").val(null);
					$("#catatan-odo").val(null);
					$('#modalOdontogram').modal('hide');
				}
			});
		});
		
		$("#anamnesis").blur(function() {
			var anamnesis = $(this).val();
			$.ajax({
				url: "<?php echo base_url().'rekam_medis/set_anamnesis' ?>",
				type: "post",
				data: {"id_rekam_medis": rekam_medis, "anamnesis": anamnesis}
			});
		});

		$("#catatan_fisik").blur(function() {
			var catatan = $(this).val();
			$.ajax({
				url: "<?php echo base_url().'rekam_medis/set_catatan_fisik' ?>",
				type: "post",
				data: {"id_rekam_medis": rekam_medis, "catatan": catatan}
			});
		});
	})
</script>
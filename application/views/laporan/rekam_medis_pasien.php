<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Pilih Pasien</h3>
			</div>
			<!--Body Content-->
			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		    		<div class="row">
				    	<div class="col-sm-12">
				        	<table id="example1" class="table table-bordered table-striped">
					            <thead>
					                <tr>
						                <th>#Pasien</th>
						                <th>Nama Pasien</th>
						                <th>Tempat, Tanggal Lahir</th>
						                <th>Jenis Kelamin</th>
						                <th style="width:15%;">Aksi</th>
						            </tr>
					            </thead>
					        	<tbody>
					        		<?php if (count($data) > 0): ?>
					        		<?php $no=1; foreach ($data as $d): ?>
					        			<?php if (count($d) > 0): ?>
					        			<?php foreach ($d as $key => $val): ?>
					        				<?php if($key == 'pasien'): ?>
					        					<tr data-tt-id="<?php echo $no; ?>" style="font-weight: bold;">
					        						<td><?php echo $val->ID_PASIEN; ?></td>
					        						<td><?php echo $val->NM_PASIEN; ?></td>
					        						<td><?php echo $val->TMPT_LHR_PASIEN.', '.date('d-m-Y', strtotime($val->TGL_LHR_PASIEN)); ?></td>
					        						<td><?php echo $val->JK_PASIEN; ?></td>
					        						<td align="center">
					        							<button type="button" id="btn-expand-<?php echo $no; ?>" class="btn btn-flat btn-info btn-xs btn-expand" onclick="expand_data('<?php echo $no; ?>')">
				                    						<i class="fa fa-folder-open"></i> Buka 
				                    					</button>
				                    					<button type="button" id="btn-collapse-<?php echo $no; ?>" class="btn btn-flat btn-warning btn-xs btn-collapse" onclick="collapse_data('<?php echo $no; ?>')">
				                    						<i class="fa fa-folder"></i> Tutup 
				                    					</button>
					        						</td>
					        					</tr>
					        				<?php elseif($key == 'rekam_medis'): ?>
					        					<?php if (count($val)): ?>
				        						<?php foreach ($val as $rm): ?>
				                  				<tr data-tt-id="<?php echo 'anak'.$no ?>" data-tt-parent-id="<?php echo $no; ?>" style="color: black;font-style: italic;">
				                    				<td><?php echo $rm->ID_REKAM_MEDIS; ?></td>
				                    				<td><?php echo $rm->TGL_PERIKSA; ?></td>
				                    				<td><?php echo $rm->NM_DOKTER; ?></td>
				                    				<td><?php echo $rm->CATATAN_FISIK; ?></td>
				                    				<td align="center">
				                    					<a href="<?php echo base_url().'laporan/rekam_medis_pasien/lihat/'.$rm->ID_REKAM_MEDIS ?>" class="btn btn-flat btn-success btn-xs" style="font-style: normal;">
				                    						<i class="fa fa-eye"></i> Lihat 
				                    					</a>
				                					</td>
				                  				</tr>
				        						<?php endforeach ?>
					        					<?php endif ?>
				        					<?php endif ?>
					        			<?php endforeach ?>
					        			<?php $no++; ?>
			        					<?php endif ?>
					        		<?php endforeach ?>
					        		<?php endif ?>
			                   </tbody>
	                		</table>
			       	 	</div>
		    		</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function expand_data(id) {
		$("#example1").treetable("expandNode", id);
		$("#btn-expand-" + id).hide();
		$("#btn-collapse-" + id).show();
	}

	function collapse_data(id) {
		$("#example1").treetable("collapseNode", id);
		$("#btn-expand-" + id).show();
		$("#btn-collapse-" + id).hide();
	}
	
	$(document).ready(function() {
		$(".btn-expand").show();
		$(".btn-collapse").hide();
	});
</script>
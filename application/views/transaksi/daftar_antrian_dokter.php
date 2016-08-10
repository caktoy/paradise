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
				<h3 class="box-title">Antrian Pasien</h3>
				<span class="pull-right">
					<?php echo date('d M Y') ?> &nbsp;&nbsp;
					<button type="button" class="btn btn-xs btn-success" onclick="location.reload();">
						<i class="fa fa-refresh"></i>
					</button>
				</span>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		    		<div class="row">
				    	<div class="col-sm-12">
				        	<table id="example1" class="table table-bordered table-striped">
					            <thead>
					                <tr>
						                <th width="25px">No.</th>
						                <th>#Pasien</th>
						                <th>Nama</th>
						                <th>Tanggal Lahir</th>
						                <th>Status</th>
						                <th style="width:15%;">Aksi</th>
						            </tr>
					            </thead>
					        	<tbody>
					        		<?php if (count($antrian) > 0): ?>
					        		<?php $no = 1; foreach ($antrian as $antri): ?>
	                  				<tr>
	                    				<td align="right"><?php echo $no; ?>.</td>
	                    				<td><?php echo $antri->ID_PASIEN; ?></td>
	                    				<td><?php echo $antri->NM_PASIEN; ?></td>
	                    				<td><?php echo date('d-m-Y', strtotime($antri->TGL_LHR_PASIEN)); ?></td>
	                    				<?php
	                    				$label_type = "label-info";
	                    				if($antri->STATUS_ANTRIAN == 'Menunggu')
	                    					$label_type = "label-info";
	                    				elseif($antri->STATUS_ANTRIAN == 'Selesai')
	                    					$label_type = "label-success";
	                    				elseif($antri->STATUS_ANTRIAN == 'Sedang Berlangsung')
	                    					$label_type = "label-warning";
	                    				elseif($antri->STATUS_ANTRIAN == 'Batal')
	                    					$label_type = "label-danger";
	                    				?>
	                    				<td align="center">
	                    					<span class="label <?php echo $label_type ?>">
	                    						<?php echo $antri->STATUS_ANTRIAN; ?>
	                    					</span>
                    					</td>
	                    				<td align="center">
	                    					<?php if ($antri->STATUS_ANTRIAN == "Menunggu"): ?>
	                    					<!-- <a href="<?php echo base_url().'rekam_medis/push/'.$antri->ID_ANTRIAN.'/'.$antri->ID_PASIEN.'/'.$antri->ID_POLI ?>" class="btn btn-flat btn-info btn-xs">
	                    						<i class="fa fa-volume-up"></i> Panggil 
	                    					</a>
	                    					<a href="<?php echo base_url().'rekam_medis/cancel_proses/'.$antri->ID_ANTRIAN.'/'.$antri->ID_PASIEN.'/'.$antri->ID_POLI ?>" class="btn btn-flat btn-danger btn-xs" onclick="return confirm('Anda yakin?')">
	                    						<i class="fa fa-remove"></i> Batal
	                    					</a> -->
	                    					<i class="fa fa-circle-o"></i>
	                    					<?php elseif($antri->STATUS_ANTRIAN == "Sedang Berlangsung"): ?>
	                    					<a href="<?php echo base_url().'rekam_medis/pre_proses/'.$antri->ID_PASIEN.'/'.$antri->ID_POLI.'/'.strtotime($antri->TGL_ANTRIAN) ?>" class="btn btn-flat btn-success btn-xs">
	                    						<i class="fa fa-heartbeat"></i> Proses
	                    					</a>
	                    					<!-- <a href="<?php echo base_url().'rekam_medis/cancel_proses/'.$antri->ID_ANTRIAN.'/'.$antri->ID_PASIEN.'/'.$antri->ID_POLI ?>" class="btn btn-flat btn-danger btn-xs" onclick="return confirm('Anda yakin?')">
	                    						<i class="fa fa-remove"></i> Batal
	                    					</a> -->
	                    					<?php elseif($antri->STATUS_ANTRIAN == "Selesai"): ?>
                    						<a href="<?php echo base_url().'rekam_medis/pre_proses/'.$antri->ID_PASIEN.'/'.$antri->ID_POLI.'/'.strtotime($antri->TGL_ANTRIAN) ?>" class="btn btn-flat btn-success btn-xs">
	                    						<i class="fa fa-edit"></i> Ubah
	                    					</a>
	                    					<?php else: ?>
	                    						<?php echo $antri->STATUS_ANTRIAN ?>
	                    					<?php endif ?>
	                					</td>
	                  				</tr>
					        		<?php $no++; endforeach ?>
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
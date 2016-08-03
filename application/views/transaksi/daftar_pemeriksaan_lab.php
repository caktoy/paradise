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
				<h3 class="box-title">Permintaan Pemeriksaan</h3>
				<span class="pull-right"><?php echo date('d M Y') ?></span>
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
						                <th>Nama Pasien</th>
						                <th>Dokter Referensi</th>
						                <th>Tanggal Periksa</th>
						                <th>Lab Periksa</th>
						                <th style="width:15%;">Aksi</th>
						            </tr>
					            </thead>
					        	<tbody>
					        		<?php if (count($pemeriksaan_lab) > 0): ?>
					        		<?php $no = 1; foreach ($pemeriksaan_lab as $pl): ?>
	                  				<tr>
	                    				<td align="right"><?php echo $no; ?>.</td>
	                    				<td><?php echo $pl->ID_PASIEN; ?></td>
	                    				<td><?php echo $pl->NM_PASIEN; ?></td>
	                    				<td><?php echo $pl->NM_DOKTER; ?></td>
	                    				<td><?php echo date('d-m-Y', strtotime($pl->TGL_PERIKSA)); ?></td>
	                    				<td><?php echo $pl->LAB; ?></td>
	                    				<td align="center">
                    						<a href="<?php echo base_url().'pemeriksaan_lab/periksa/'.$pl->ID_REKAM_MEDIS.'/'.$pl->ID_LAB ?>" class="btn btn-flat btn-success btn-xs">
	                    						<i class="fa fa-upload"></i> Unggah Hasil
	                    					</a>
	                    					<?php if ($pl->FILE_HASIL != null): ?>
	                    					<a href="<?php echo base_url().'assets/images/hasil_lab/'.$pl->FILE_HASIL ?>" class="btn btn-flat btn-info btn-xs" target="_blank">
	                    						<i class="fa fa-eye"></i> Lihat File
	                    					</a>
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
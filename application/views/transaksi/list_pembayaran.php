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
				<h3 class="box-title">Tagihan Pemeriksaan</h3>
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
						                <th>Tanggal Pemeriksaan</th>
						                <th style="width:15%;">Aksi</th>
						            </tr>
					            </thead>
					        	<tbody>
					        		<?php if (count($rekam_medis) > 0): ?>
					        		<?php $no = 1; foreach ($rekam_medis as $rm): ?>
	                  				<tr>
	                    				<td align="right"><?php echo $no; ?>.</td>
	                    				<td><?php echo $rm->ID_PASIEN; ?></td>
	                    				<td><?php echo $rm->NM_PASIEN; ?></td>
	                    				<td><?php echo $rm->NM_DOKTER; ?></td>
	                    				<td><?php echo date('d-m-Y', strtotime($rm->TGL_PERIKSA)); ?></td>
	                    				<td align="center">
	                    					<?php if ($rm->BAYAR == 0): ?>
	                    						<a href="<?php echo base_url().'pembayaran/create/'.$rm->ID_REKAM_MEDIS ?>" class="btn btn-flat btn-info btn-xs">
		                    						<i class="fa fa-dollar"></i> Bayar
		                    					</a>
	                    					<?php else: ?>
		                    					<a href="<?php echo base_url().'pembayaran/edit/'.$rm->ID_REKAM_MEDIS ?>" class="btn btn-flat btn-warning btn-xs">
		                    						<i class="fa fa-edit"></i> Tinjau ulang
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
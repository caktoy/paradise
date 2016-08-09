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
				<h3 class="box-title">Data Pasien</h3>
			</div>

			<div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
			    	<div class="col-sm-12">
			        	<table id="example1" class="table table-bordered table-striped">
				            <thead>
				                <tr>
					                <th style="width: 50px;">#Pasien</th>
	                        		<th>Nama Pasien</th>
	                        		<th>Jenis Kelamin</th>
	                        		<th>Tempat, Tanggal Lahir</th>
	                        		<th>Alamat</th>
	                        		<th>No. Telepon</th>
	                        		<th>Tanggal Daftar</th>
					                <th style="width:40px;">Aksi</th>
					            </tr>
				            </thead>
				        	<tbody>
				        		<?php foreach ($pasien as $p): ?>
                  				<tr>
                    				<td><?php echo $p->ID_PASIEN; ?></td>
                    				<td><?php echo $p->NM_PASIEN; ?></td>
                    				<td><?php echo $p->JK_PASIEN; ?></td>
                    				<td><?php echo $p->NM_KOTA.", ".date('d-m-Y', strtotime($p->TGL_LHR_PASIEN)); ?></td>
                    				<td><?php echo $p->ALMT_PASIEN; ?></td>
                    				<td><?php echo $p->TELP_PASIEN; ?></td>
                    				<td><?php echo date('d-m-Y', strtotime($p->TGL_DAFTAR)); ?></td>
                    				<td align="center">
                    					<a href="<?php echo base_url().'pasien/lihat_riwayat/'.$p->ID_PASIEN ?>" class="btn btn-flat btn-info btn-xs">
                    						<i class="fa fa-eye"></i> Lihat Riwayat
                    					</a>
                					</td>
                  				</tr>
				        		<?php endforeach ?>
		                   </tbody>
                		</table>
		       	 	</div>
				</div>
			</div>
		</div>
	</div>
</div>
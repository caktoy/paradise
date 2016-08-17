<?php  
/**
* 
*/
class Registrasi_Pemeriksaan extends CI_Controller
{

	private function dayname($dayname)
	{
		switch (strtolower($dayname)) {
			case 'sun':return 'Minggu';break;
			case 'mon':return 'Senin';break;
			case 'tue':return 'Selasa';break;
			case 'wed':return 'Rabu';break;
			case 'thu':return 'Kamis';break;
			case 'fri':return 'Jumat';break;
			case 'sat':return 'Sabtu';break;
			default:return 'Minggu';break;
		}
	}

	public function index()
	{
		date_default_timezone_set("Asia/Jakarta");
		$this->m_security->check();
		$data['aktif'] = "transaksi";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Registrasi Pemeriksaan");
		$data['judul'] = "Registrasi Pemeriksaan";
		$data['konten'] = "transaksi/registrasi_pemeriksaan";

		$data['kodepasien'] = $this->m_security->gen_ai_id("pasien", "id_pasien");
		$data['antrian'] = $this->m_antrian->get(array('tgl_antrian' => date('Y-m-d')));
		$data['pasien'] = $this->m_pasien->get(array());

		$hari = $this->dayname(date('D'));
		$data['poli'] = $this->m_security->query("select distinct dokter.ID_POLI, poli.NM_POLI from dokter 
			INNER JOIN jadwal_dokter ON jadwal_dokter.ID_DOKTER = dokter.ID_DOKTER 
			INNER JOIN poli ON dokter.ID_POLI = poli.ID_POLI 
			WHERE jadwal_dokter.HARI = '".$hari."' AND jadwal_dokter.JADWAL_MULAI <= '".date('H:i:s')."' AND 
			jadwal_dokter.JADWAL_SELESAI >= '".date('H:i:s')."'");
		
		$this->load->view('layout', $data);
	}

	public function get_antrian()
	{
		date_default_timezone_set("Asia/Jakarta");
		$poli = $this->input->post('poli');

		if($poli != null) {
			$antrian = $this->m_antrian->get(array(
				'antrian.id_poli' => $poli,
				'tgl_antrian' => date('Y-m-d')
				));
			echo count($antrian) + 1;
		} else {
			echo 0;
		}
	}

	public function pasien_baru()
	{
		date_default_timezone_set("Asia/Jakarta");
		$id_pasien = $this->input->post('id_pasien');
        $nm_pasien = $this->input->post('nm_pasien');
        $tmpt_lhr_pasien = $this->input->post('tmpt_lhr_pasien');
        $tgl_lhr_pasien = $this->input->post('tgl_lhr_pasien');
        $almt_pasien = $this->input->post('almt_pasien');
        $telp_pasien = $this->input->post('telp_pasien');
        $tgl_daftar = $this->input->post('tgl_daftar');
        $jk_pasien = $this->input->post('jk_pasien');

        $check_pasien = $this->m_pasien->get(array(
        	'lower(nm_pasien)' => strtolower($nm_pasien),
        	'tgl_lhr_pasien' => $tgl_lhr_pasien
        	));
        if(count($check_pasien) > 0) {
            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data pasien dengan nama \''.$nm_pasien.'\' sudah ada.');
        } else {
            $act = $this->m_pasien->create(array(
            	'id_pasien' => $id_pasien,
            	'nm_pasien' => $nm_pasien,
            	'tmpt_lhr_pasien' => $tmpt_lhr_pasien,
            	'tgl_lhr_pasien' => $tgl_lhr_pasien,
            	'almt_pasien' => $almt_pasien,
            	'telp_pasien' => $telp_pasien,
            	'tgl_daftar' => date('Y-m-d'),
            	'jk_pasien' => $jk_pasien
            	));
	        
	        if ($act > 0) 
	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data pasien telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data pasien gagal disimpan.');
        }
        
        redirect('registrasi_pemeriksaan');
	}

	public function new_order()
	{
		date_default_timezone_set("Asia/Jakarta");
		$nomer = $this->input->post('nomer');
		$pasien = $this->input->post('pasien');
		$poli = $this->input->post('poli');

		$check_pasien = $this->m_security->query("select * 
			from antrian 
			where id_pasien = '".$pasien."' 
			and tgl_antrian = '".date('Y-m-d')."'
			and status_antrian in ('Menunggu', 'Sedang Berlangsung')");
		if(count($check_pasien) == 0) {
			$act = $this->m_antrian->create(array(
				'id_antrian' => $nomer,
				'id_poli' => $poli,
				'id_pasien' => $pasien,
				'tgl_antrian' => date('Y-m-d'),
				'jam_antrian' => date('H:i:s'),
				'status_antrian' => 'Menunggu'
				));

			if ($act > 0) 
		        $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Registrasi Pemeriksaan telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Registrasi Pemeriksaan gagal disimpan.');
		} else {
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Pasien sudah terdaftar dan masih mengantri atau sedang melakukan pemeriksaan.');
		}

        redirect('registrasi_pemeriksaan');
	}

	public function tbl_antrian()
	{
		date_default_timezone_set("Asia/Jakarta");
		
		$poli = $this->m_poli->get(array());

		$hasil = "";
		foreach ($poli as $p) {
			$hasil .= '<div class="col-xs-4 col-md-4">
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">Antrian '.$p->NM_POLI.'</h3>
					</div>

					<div class="box-body">
						<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
				    		<div class="row">
						    	<div class="col-sm-12">
						        	<table id="table-'.$p->ID_POLI.'" class="table table-bordered table-striped">
							            <thead>
							                <tr>
								                <th width="25px">No.</th>
								                <th>Pasien</th>
								                <th>Status</th>
								                <th>StatusNo</th>
								                <th style="width:20%;">Aksi</th>
								            </tr>
							            </thead>
							        	<tbody>';
							        		$antrian = $this->m_antrian->get(
							        			array('tgl_antrian' => date('Y-m-d'), 'antrian.id_poli' => $p->ID_POLI)
							        			);
							        		foreach ($antrian as $antri) {
				                  				$hasil .= '<tr>
				                    				<td align="right">'.$antri->ID_ANTRIAN.'.</td>
				                    				<td>#'.$antri->ID_PASIEN.' - '.$antri->NM_PASIEN.'</td>';

				                    				$label_type = "label-info";
				                    				$status_no = 2;
				                    				if($antri->STATUS_ANTRIAN == "Menunggu") {
				                    					$label_type = "label-info";
				                    					$status_no = 2;
				                    				} elseif($antri->STATUS_ANTRIAN == "Selesai") {
				                    					$label_type = "label-success";
				                    					$status_no = 3;
				                    				} elseif($antri->STATUS_ANTRIAN == "Sedang Berlangsung") {
				                    					$label_type = "label-warning";
				                    					$status_no = 1;
				                    				} elseif($antri->STATUS_ANTRIAN == "Batal") {
				                    					$label_type = "label-danger";
				                    					$status_no = 4;
				                    				}

				                    				$hasil .= '<td align="center">
				                    					<span class="label '.$label_type.'">'.$antri->STATUS_ANTRIAN.'</span>
			                    					</td>
			                    					<td>'.$status_no.'</td>
				                    				<td align="center">';
				                    					if ($antri->STATUS_ANTRIAN == "Menunggu") {
					                    					$hasil .= '<a href="'.base_url().'antrian/push/'.$antri->ID_ANTRIAN.'/'.$antri->ID_PASIEN.'/'.$antri->ID_POLI.'" class="btn btn-flat btn-info btn-xs">
					                    						<i class="fa fa-volume-up"></i>  
					                    					</a>
					                    					<a href="'.base_url().'antrian/cancel/'.$antri->ID_ANTRIAN.'/'.$antri->ID_PASIEN.'/'.$antri->ID_POLI.'" class="btn btn-flat btn-danger btn-xs" onclick="return confirm(\'Anda yakin?\')">
					                    						<i class="fa fa-remove"></i> 
					                    					</a> 
					                    					<a href="'.base_url().'registrasi_pemeriksaan/cetak_antrian/'.$antri->ID_PASIEN.'/'.$antri->ID_POLI.'/'.$antri->ID_ANTRIAN.'" class="btn btn-flat btn-primary btn-xs" target="_blank">
					                    						<i class="fa fa-print"></i> 
					                    					</a>';
					                    				} elseif($antri->STATUS_ANTRIAN == "Sedang Berlangsung") {
					                    					// $hasil .= '<a href="'.base_url().'antrian/done/'.$antri->ID_ANTRIAN.'/'.$antri->ID_PASIEN.'/'.$antri->ID_POLI.'" class="btn btn-flat btn-success btn-xs" onclick="return confirm(\'Anda yakin?\')">
					                    					// 	<i class="fa fa-check"></i> 
					                    					// </a>';
					                    					$hasil .= '<a href="'.base_url().'antrian/cancel/'.$antri->ID_ANTRIAN.'/'.$antri->ID_PASIEN.'/'.$antri->ID_POLI.'" class="btn btn-flat btn-danger btn-xs" onclick="return confirm(\'Anda yakin?\')">
					                    						<i class="fa fa-remove"></i> 
					                    					</a>';
				                    					} else {
				                    						$hasil .= $antri->STATUS_ANTRIAN;
				                    					}
				                					$hasil .='</td>
				                  				</tr>';
			                  				}
					                   $hasil .= '</tbody>
			                		</table>
					       	 	</div>
				    		</div>
						</div>
					</div>
				</div>
			</div>';
		}

		foreach ($poli as $p) {
			$hasil .= '<script>';
			$hasil .= '$("#table-'.$p->ID_POLI.'").DataTable({
				"order": [[3, "asc"]],
				"columnDefs": [
					{"visible": false, "targets": 3},
					{"searchable": false, "orderable": false, "targets": [0, 1, 2, 4]}
				],
				"filter": false,
				"language": {
					"lengthMenu": "Menampilkan _MENU_ data per halaman",
					"zeroRecords": "Maaf, tidak ada data yang ditampilkan.",
					"info": "Halaman _PAGE_ dari _PAGES_",
					"infoEmpty": "Tidak ada data yang tersedia",
					"search": "Cari:",
					"decimal": ",",
					"thousands": ".",
					"paginate": {
						"previous": "<",
						"next": ">",
						"first": "<<",
						"last": ">>"
					},
					"infoFiltered": "(Penyaringan dari _MAX_ total data)"
				}
			});';
			$hasil .= '</script>';
		}

		echo $hasil;
	}

	public function add_pasien_baru()
	{
		$data['aktif'] = "transaksi";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Registrasi Pemeriksaan", "Tambah Pasien");
		$data['judul'] = "Registrasi Pasien Baru";
		$data['konten'] = "transaksi/pasien_baru";
		$data['kodepasien'] = $this->m_security->gen_ai_id("pasien", "id_pasien");
		$data['pasien'] = $this->m_pasien->get(array());
		$data['kota'] = $this->m_kota->get(array());
		
		$this->load->view('layout', $data);
	}

	public function cetak_antrian($id_pasien, $id_poli, $no_antri)
	{
		$data['poli'] = $this->m_poli->get(array('poli.id_poli' => $id_poli), 1);
		$data['pasien'] = $this->m_pasien->get(array('pasien.id_pasien' => $id_pasien), 1);
		$data['no_antri'] = $no_antri;

		$this->load->view('transaksi/cetak_antrian', $data);
	}
}
?>
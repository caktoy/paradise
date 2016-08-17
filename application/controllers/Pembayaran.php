<?php  
/**
* 
*/
class Pembayaran extends CI_Controller
{
	
	public function index()
	{
		$data['aktif'] = "transaksi";
        $data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Pembayaran");
        $data['judul'] = "Pembayaran";
        $data['konten'] = "transaksi/list_pembayaran";
        // $data['rekam_medis'] = $this->m_rekam_medis->get(array('rekam_medis.tgl_periksa' => date('Y-m-d')));
        $data['rekam_medis'] = $this->m_security->query("
        	select *, (select count(*) from pembayaran where id_rekam_medis = rekam_medis.id_rekam_medis) as BAYAR 
        	from rekam_medis 
        	inner join dokter on rekam_medis.id_dokter = dokter.id_dokter 
        	inner join pasien on rekam_medis.id_pasien = pasien.id_pasien
        	where rekam_medis.tgl_periksa = '".date('Y-m-d')."'");
        
        $this->load->view('layout', $data);
	}

	public function create($id_rekam_medis)
	{
		$rekam_medis = $this->m_rekam_medis->get(array('rekam_medis.id_rekam_medis' => $id_rekam_medis), 1);
		if (count($rekam_medis) > 0) {
			# pre proses, insert into table pembayaran
			$id_bayar = $this->m_security->gen_ai_id('pembayaran', 'id_bayar');
			$id_perawat = $_SESSION['userid'];
			$tgl_bayar = date('Y-m-d');

			$act = $this->m_pembayaran->create(array(
				'id_bayar' => $id_bayar,
				'id_perawat' => $id_perawat,
				'id_rekam_medis' => $id_rekam_medis,
				'id_dokter' => $rekam_medis[0]->ID_DOKTER,
				'id_pasien' => $rekam_medis[0]->ID_PASIEN,
				'tgl_bayar' => $tgl_bayar
				));

			if ($act > 0) {
				$id_jual = $this->m_security->gen_non_ai_id(date("ymd")."-", "penjualan", "id_jual", 3);
				$act = $this->m_penjualan->create(array(
					'id_jual' => $id_jual,
					'id_perawat' => $id_perawat,
					'id_bayar' => $id_bayar,
					'id_dokter' => $rekam_medis[0]->ID_DOKTER,
					'id_pasien' => $rekam_medis[0]->ID_PASIEN,
					'id_rekam_medis' => $id_rekam_medis,
					'tgl_jual' => date('Y-m-d')
					));

				if ($act > 0) {
					# get detail resep obat
					$detail_resep = $this->m_security->query("select 
						detail_resep_obat.*, resep_obat.ID_DOKTER, resep_obat.ID_PASIEN, 
						resep_obat.ID_REKAM_MEDIS, (detail_resep_obat.QTY_OBAT * obat.HRG_OBAT) as SUB_TOTAL 
						from detail_resep_obat 
						inner join resep_obat on detail_resep_obat.NO_RESEP = resep_obat.NO_RESEP 
						INNER JOIN obat ON detail_resep_obat.ID_OBAT = obat.ID_OBAT 
						where resep_obat.id_rekam_medis = '".$id_rekam_medis."'");
					if (count($detail_resep) > 0) {
						foreach ($detail_resep as $resep) {
							$this->m_detail_penjualan->create(array(
								'id_jual' => $id_jual,
								'no_resep' => $resep->NO_RESEP,
								'id_obat' => $resep->ID_OBAT,
								'qty_jual' => $resep->QTY_OBAT,
								'sub_total' => $resep->SUB_TOTAL
								));
						}
					}
				}

				redirect('pembayaran/edit/'.$id_rekam_medis);
			} else {
				$this->session->set_flashdata('pesan', '<strong>Gagal!</strong> Proses pembayaran gagal dilakukan.');
				redirect('pembayaran');
			}
		} else {
			$this->session->set_flashdata('pesan', '<strong>Gagal!</strong> Proses pembayaran gagal dilakukan.');
			redirect('pembayaran');
		}
	}

	public function edit($id_rekam_medis)
	{
		$pembayaran = $this->m_pembayaran->get(array('pembayaran.id_rekam_medis' => $id_rekam_medis));
		if (count($pembayaran) > 0) {
			$data['aktif'] = "transaksi";
	        $data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Pembayaran", "Pembayaran Pemeriksaan");
	        $data['judul'] = "Pembayaran Pemeriksaan";
	        $data['konten'] = "transaksi/do_pembayaran";

	        $data['pembayaran'] = $pembayaran;
	        $data['rekam_medis'] = $this->m_rekam_medis->get(array('rekam_medis.id_rekam_medis' => $id_rekam_medis));

	        #detil
			$data['detil_diagnosis'] = $this->m_detail_diagnosa->get(array('detail_diagnosa.id_rekam_medis' => $id_rekam_medis));
			$data['detil_tindakan'] = $this->m_detail_tindakan->get(array('detail_tindakan.id_rekam_medis' => $id_rekam_medis));
			$data['detil_terapi'] = $this->m_detail_terapi->get(array('detail_terapi.id_rekam_medis' => $id_rekam_medis));
			$data['hasil_lab'] = $this->m_hasil_lab->get(array('hasil_lab.id_rekam_medis' => $id_rekam_medis));
			
			// $data['resep_obat'] = $this->m_resep_obat->get(array('resep_obat.id_rekam_medis' => $id_rekam_medis));
			$data['resep_obat'] = $this->m_security->query("select *
				from detail_penjualan 
				inner join detail_resep_obat on detail_penjualan.NO_RESEP = detail_resep_obat.NO_RESEP 
					and detail_penjualan.ID_OBAT = detail_resep_obat.ID_OBAT 
				inner join resep_obat ON detail_resep_obat.NO_RESEP = resep_obat.NO_RESEP 
				inner join obat ON detail_resep_obat.ID_OBAT = obat.ID_OBAT 
				where resep_obat.ID_REKAM_MEDIS = '".$id_rekam_medis."'");
	        
	        $this->load->view('layout', $data);
		} else {
			$this->session->set_flashdata('pesan', '<strong>Gagal!</strong> Proses pembayaran gagal dilakukan.');
			redirect('pembayaran');
		}
	}
	public function ubah_resep()
	{
		$id_rekam_medis = $this->input->post('id_rekam_medis');
		$id_jual = $this->input->post('id_jual');
		$no_resep = $this->input->post('no_resep');
		$id_obat = $this->input->post('id_obat');
		$qty_jual = $this->input->post('qty_jual');

		$detail_penjualan = $this->m_detail_penjualan->get(array(
			'detail_penjualan.id_jual' => $id_jual, 
			'detail_penjualan.no_resep' => $no_resep,
			'detail_penjualan.id_obat' => $id_obat
			));
		if (count($detail_penjualan) > 0) {
			$obat = $this->m_obat->get(array('obat.id_obat' => $id_obat));
			if (count($obat)) {
				if (isset($obat[0]->HRG_OBAT) && !is_null($obat[0]->HRG_OBAT))
					$harga_obat = $obat[0]->HRG_OBAT;
				else 
					$harga_obat = 0;
			} else {
				$harga_obat = 0;
			}
			$sub_total = $qty_jual * $harga_obat;
			$this->m_detail_penjualan->patch(
				array(
					'detail_penjualan.id_jual' => $id_jual, 
					'detail_penjualan.no_resep' => $no_resep,
					'detail_penjualan.id_obat' => $id_obat
					),
				array(
					'detail_penjualan.qty_jual' => $qty_jual, 
					'detail_penjualan.sub_total' => $sub_total
					)
				);
		}

		redirect('pembayaran/edit/'.$id_rekam_medis);
	}

	public function remove_resep($id_rekam_medis, $id_jual, $no_resep, $id_obat)
	{
		$detail_penjualan = $this->m_detail_penjualan->get(array(
			'detail_penjualan.id_jual' => $id_jual, 
			'detail_penjualan.no_resep' => $no_resep,
			'detail_penjualan.id_obat' => $id_obat
			));
		if (count($detail_penjualan) > 0) {
			$this->m_detail_penjualan->remove(array(
				'detail_penjualan.id_jual' => $id_jual, 
				'detail_penjualan.no_resep' => $no_resep,
				'detail_penjualan.id_obat' => $id_obat
				));
		}

		redirect('pembayaran/edit/'.$id_rekam_medis);
	}

	public function simpan()
	{
		$id_bayar = $this->input->post('txt_id_bayar');
		$id_rekam_medis = $this->input->post('txt_rekam_medis');
		$uang_bayar = $this->input->post('txt_bayar');
		$total_bayar = $this->input->post('txt_total');

		$act = $this->m_pembayaran->patch(
			array('pembayaran.id_bayar' => $id_bayar),
			array(
				'pembayaran.tgl_bayar' => date('Y-m-d'),
				'pembayaran.uang_bayar' => $uang_bayar,
				'pembayaran.total_bayar' => $total_bayar
				)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Pembayaran telah disimpan');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Pembayaran gagal disimpan.');

        redirect('pembayaran/edit/'.$id_rekam_medis);
	}

	public function cetak($id_rekam_medis)
	{
		$pembayaran = $this->m_pembayaran->get(array('pembayaran.id_rekam_medis' => $id_rekam_medis));

        $data['judul'] = 'Biaya Pemeriksaan';
        
        $data['pembayaran'] = $pembayaran;
        $data['rekam_medis'] = $this->m_rekam_medis->get(array('rekam_medis.id_rekam_medis' => $id_rekam_medis));

        #detil
		$data['detil_diagnosis'] = $this->m_detail_diagnosa->get(array('detail_diagnosa.id_rekam_medis' => $id_rekam_medis));
		$data['detil_tindakan'] = $this->m_detail_tindakan->get(array('detail_tindakan.id_rekam_medis' => $id_rekam_medis));
		$data['detil_terapi'] = $this->m_detail_terapi->get(array('detail_terapi.id_rekam_medis' => $id_rekam_medis));
		$data['hasil_lab'] = $this->m_hasil_lab->get(array('hasil_lab.id_rekam_medis' => $id_rekam_medis));

		// $data['resep_obat'] = $this->m_resep_obat->get(array('resep_obat.id_rekam_medis' => $id_rekam_medis));
		$data['resep_obat'] = $this->m_security->query("select *
				from detail_penjualan 
				inner join detail_resep_obat on detail_penjualan.NO_RESEP = detail_resep_obat.NO_RESEP 
					and detail_penjualan.ID_OBAT = detail_resep_obat.ID_OBAT 
				inner join resep_obat ON detail_resep_obat.NO_RESEP = resep_obat.NO_RESEP 
				inner join obat ON detail_resep_obat.ID_OBAT = obat.ID_OBAT 
				where resep_obat.ID_REKAM_MEDIS = '".$id_rekam_medis."'");
		$data['penjualan'] = $this->m_security->query("select * 
			from penjualan 
			inner join pembayaran on penjualan.ID_PERAWAT = pembayaran.ID_PERAWAT 
			and penjualan.ID_BAYAR = pembayaran.ID_BAYAR 
			and penjualan.ID_DOKTER = pembayaran.ID_DOKTER 
			and penjualan.ID_PASIEN = pembayaran.ID_PASIEN 
			and penjualan.ID_REKAM_MEDIS = pembayaran.ID_REKAM_MEDIS
			where pembayaran.id_rekam_medis = '".$id_rekam_medis."'");
        
        $this->load->view('laporan/pembayaran_pemeriksaan', $data);
        // $this->pdfgenerator->generate('laporan/pembayaran_pemeriksaan', 'pembayaran_'.$id_rekam_medis, 'portrait', 'a5', $data);
	}
}
?>
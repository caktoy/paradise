<?php  
/**
* 
*/
class Rekam_Medis extends CI_Controller
{
	
	public function index()
	{
		$this->m_security->check();
		$data['aktif'] = "transaksi";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Pencatatan Rekam Medis");
		$data['judul'] = "Pencatatan Rekam Medis";
		$data['konten'] = "transaksi/daftar_antrian_dokter";

		$dokter = $this->m_dokter->get(array('dokter.id_dokter' => $_SESSION['userid']));

		$data['antrian'] = $this->m_antrian->get(array(
			'tgl_antrian' => date('Y-m-d'),
			'antrian.id_poli' => $dokter[0]->ID_POLI
			));
		
		$this->load->view('layout', $data);
	}

	public function pre_proses($id_pasien, $id_poli, $tgl_antri)
	{
		$tgl_periksa = date('Y-m-d', $tgl_antri);
		$cek_rekam_medis = $this->m_rekam_medis->get(array(
			'rekam_medis.id_pasien' => $id_pasien,
			'rekam_medis.id_dokter' => $_SESSION['userid'],
			'rekam_medis.tgl_periksa' => $tgl_periksa 
			));
		if (count($cek_rekam_medis) > 0) {
			$id_rekam_medis = $cek_rekam_medis[0]->ID_REKAM_MEDIS;
		} else {
			# insert into rekam_medis
			$id_rekam_medis = $this->m_security->gen_ai_id('rekam_medis', 'id_rekam_medis');
			$this->m_rekam_medis->create(array(
				'id_rekam_medis' => $id_rekam_medis,
				'id_pasien' => $id_pasien,
				'id_dokter' => $_SESSION['userid'],
				'tgl_periksa' => $tgl_periksa
				));
		}
		
		redirect('rekam_medis/proses/'.$id_rekam_medis);
	}

	public function proses($id_rekam_medis)
	{
		$this->m_security->check();
		$data['aktif'] = "transaksi";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Pencatatan Rekam Medis");
		$data['judul'] = "Pemeriksaan Pasien";
		$data['konten'] = "transaksi/rekam_medis_pasien";

		$rekam_medis = $this->m_rekam_medis->get(array('id_rekam_medis' => $id_rekam_medis));
		$data['rekam_medis'] = $rekam_medis;

		$id_dokter = $_SESSION['userid'];
		$data['is_odontogram'] = false;
		$dokter = $this->m_dokter->get(array('dokter.id_dokter' => $id_dokter));
		if(count($dokter) > 0) {
			if(strpos(strtolower($dokter[0]->NM_POLI), 'gigi') !== false)
				$data['is_odontogram'] = true;
		}
		$data['dokter'] = $dokter;

		#detil
		$data['detil_diagnosis'] = $this->m_detail_diagnosa->get(array('detail_diagnosa.id_rekam_medis' => $id_rekam_medis));
		$data['detil_tindakan'] = $this->m_detail_tindakan->get(array('detail_tindakan.id_rekam_medis' => $id_rekam_medis));
		$data['detil_terapi'] = $this->m_detail_terapi->get(array('detail_terapi.id_rekam_medis' => $id_rekam_medis));
		$data['resep_obat'] = $this->m_resep_obat->get(array('resep_obat.id_rekam_medis' => $id_rekam_medis));

		$data['diagnosis'] = $this->m_diagnosa_icd_10->get(array());
		$data['tindakan'] = $this->m_tindakan_icd_9->get(array());
		$data['terapi'] = $this->m_terapi->get(array());
		$data['obat'] = $this->m_obat->get(array());
		$data['perawat'] = $this->m_perawat->get(array());

		$this->load->view('layout', $data);
	}

	public function update($rekam_medis)
	{
		$anamnesis = $this->input->post('keluhan');
		$catatan = $this->input->post('catatan_fisik');

		$this->m_rekam_medis->patch(
			array('id_rekam_medis' => $rekam_medis), 
			array('anamnesis' => $anamnesis, 'catatan_fisik' => $catatan_fisik)
			);

		redirect('rekam_medis/proses/'.$rekam_medis);
	}

	public function add_diagnosa($rekam_medis)
	{
		$kode_icd = $this->input->post('diagnosis');
		$keterangan = $this->input->post('keterangan');

		$check = $this->m_detail_diagnosa->get(array(
			'detail_diagnosa.kode_icd_10' => $kode_icd,
			'detail_diagnosa.id_rekam_medis' => $rekam_medis
			));
		if (count($check) > 0) {
			$this->m_detail_diagnosa->patch(
				array(
					'kode_icd_10' => $kode_icd,
					'id_rekam_medis' => $rekam_medis
				),
				array('keterangan_dg' => $keterangan)
			);
		} else {
			$this->m_detail_diagnosa->create(array(
				'kode_icd_10' => $kode_icd,
				'id_rekam_medis' => $rekam_medis,
				'keterangan_dg' => $keterangan
				));
		}

		redirect('rekam_medis/proses/'.$rekam_medis);
	}

	public function remove_diagnosa($rekam_medis, $kode_icd)
	{
		$this->m_detail_diagnosa->remove(array(
			'kode_icd_10' => $kode_icd,
			'id_rekam_medis' => $rekam_medis
			));

		redirect('rekam_medis/proses/'.$rekam_medis);
	}

	public function add_tindakan($rekam_medis)
	{
		$kode_icd = $this->input->post('tindakan');
		$keterangan = $this->input->post('keterangan');

		$tindakan = $this->m_tindakan_icd_9->get(array('kode_icd_9' => $kode_icd));

		$check = $this->m_detail_tindakan->get(array(
			'detail_tindakan.kode_icd_9' => $kode_icd,
			'detail_tindakan.id_rekam_medis' => $rekam_medis
			));
		if (count($check) > 0) {
			$this->m_detail_tindakan->patch(
				array(
					'kode_icd_9' => $kode_icd,
					'id_rekam_medis' => $rekam_medis
				),
				array(
					'bayar_tindakan' => $tindakan[0]->HARGA_TINDAKAN,
					'detail_tindakan' => $keterangan
				)
			);
		} else {
			$this->m_detail_tindakan->create(array(
				'kode_icd_9' => $kode_icd,
				'id_rekam_medis' => $rekam_medis,
				'bayar_tindakan' => $tindakan[0]->HARGA_TINDAKAN,
				'detail_tindakan' => $keterangan
				));
		}

		redirect('rekam_medis/proses/'.$rekam_medis);
	}

	public function remove_tindakan($rekam_medis, $kode_icd)
	{
		$this->m_detail_tindakan->remove(array(
			'kode_icd_9' => $kode_icd,
			'id_rekam_medis' => $rekam_medis
			));

		redirect('rekam_medis/proses/'.$rekam_medis);
	}

	public function add_terapi($rekam_medis)
	{
		$id_terapi = $this->input->post('terapi');
		$perawat = $this->input->post('perawat');
		$keterangan = $this->input->post('keterangan');

		$terapi = $this->m_terapi->get(array('id_terapi' => $id_terapi));

		$check = $this->m_detail_terapi->get(array(
			'detail_terapi.id_terapi' => $id_terapi,
			'detail_terapi.id_rekam_medis' => $rekam_medis
			));
		if (count($check) > 0) {
			$this->m_detail_terapi->patch(
				array(
					'id_terapi' => $id_terapi,
					'id_rekam_medis' => $rekam_medis
				),
				array(
					'id_perawat' => $perawat,
					'bayar_terapi' => $terapi[0]->HARGA_TERAPI,
					'keterangan_terapi' => $keterangan
				)
			);
		} else {
			$this->m_detail_terapi->create(array(
				'id_perawat' => $perawat,
				'id_rekam_medis' => $rekam_medis,
				'id_terapi' => $id_terapi,
				'bayar_terapi' => $terapi[0]->HARGA_TERAPI,
				'keterangan_terapi' => $keterangan
				));
		}

		redirect('rekam_medis/proses/'.$rekam_medis);
	}

	public function remove_terapi($rekam_medis, $id_terapi)
	{
		$this->m_detail_terapi->remove(array(
			'id_terapi' => $id_terapi,
			'id_rekam_medis' => $rekam_medis
			));

		redirect('rekam_medis/proses/'.$rekam_medis);
	}

	public function add_resep_obat($rekam_medis)
	{
		$id_obat = $this->input->post('obat');
		$jumlah = $this->input->post('jumlah');

		$obat = $this->m_obat->get(array('id_obat' => $id_obat));
		$sub_total = $jumlah * $obat[0]->HRG_OBAT;

		$check = $this->m_resep_obat->get(array(
			'resep_obat.id_obat' => $id_obat,
			'resep_obat.id_rekam_medis' => $rekam_medis
			));
		if (count($check) > 0) {
			$this->m_resep_obat->patch(
				array(
					'id_obat' => $id_obat,
					'id_rekam_medis' => $rekam_medis
				),
				array(
					'kuantitas_obat' => $jumlah,
					'sub_total_resep' => $sub_total
				)
			);
		} else {
			$no_resep = $this->m_security->gen_ai_id('resep_obat', 'no_resep');
			$this->m_resep_obat->create(array(
				'no_resep' => $no_resep,
				'id_rekam_medis' => $rekam_medis,
				'id_obat' => $id_obat,
				'kuantitas_obat' => $jumlah,
				'sub_total_resep' => $sub_total
				));
		}

		redirect('rekam_medis/proses/'.$rekam_medis);
	}

	public function remove_resep_obat($rekam_medis, $no_resep)
	{
		$this->m_resep_obat->remove(array(
			'no_resep' => $no_resep
			));

		redirect('rekam_medis/proses/'.$rekam_medis);
	}
}
?>
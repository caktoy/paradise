<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller 
{
	public function index()
	{
		if(isset($_SESSION['userid']))
			redirect('page/beranda');
		else
			redirect('auth');
	}

	public function beranda_old()
	{
		$this->m_security->check();

		$data['aktif'] = "beranda";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home");
		$data['judul'] = "Beranda";
		$data['konten'] = "beranda";

		$kunjungan_pasien_bulan = array();
		$poli = $this->m_poli->get(array());
		foreach ($poli as $p) {
			$arr_poli = array();
			$data_kunjungan_poli = array();
			for ($i=1; $i <= 12; $i++) { 
				$rekam_medis = $this->m_rekam_medis->get(array(
					'month(rekam_medis.tgl_periksa)' => $i,
					'year(rekam_medis.tgl_periksa)' => date('Y'),
					'dokter.id_poli' => $p->ID_POLI
					));

				array_push($data_kunjungan_poli, count($rekam_medis));
			}
			$arr_poli['name'] = $p->NM_POLI;
			$arr_poli['data'] = $data_kunjungan_poli;
			array_push($kunjungan_pasien_bulan, $arr_poli);
		}
		$data['kunjungan_pasien_bulan'] = $kunjungan_pasien_bulan;

		$penyakit_terbanyak_bulan = array();
		$diagnosis = $this->m_diagnosa_icd_10->get(array());
		foreach ($diagnosis as $d) {
			$arr_diagnosis = array();
			$data_diagnosis = array();
			for ($i=1; $i <= 12; $i++) { 
				$rekam_medis = $this->m_detail_diagnosa->get(array(
					'month(rekam_medis.tgl_periksa)' => $i,
					'year(rekam_medis.tgl_periksa)' => date('Y'),
					'diagnosa_icd_10.kode_icd_10' => $d->KODE_ICD_10
					));

				array_push($data_diagnosis, count($rekam_medis));
			}
			$arr_diagnosis['name'] = $d->NM_ICD_10;
			$arr_diagnosis['data'] = $data_diagnosis;
			array_push($penyakit_terbanyak_bulan, $arr_diagnosis);
		}
		$data['penyakit_terbanyak_bulan'] = $penyakit_terbanyak_bulan;
		
		$this->load->view('layout', $data);
	}

	public function beranda()
	{
		$this->m_security->check();

		$data['aktif'] = "beranda";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home");
		$data['judul'] = "Beranda";
		$data['konten'] = "beranda";

		$this->load->view('layout', $data);
	}

	public function kunjungan()
	{
		$arr_data = array();
		$poli = $this->m_poli->get(array());
		foreach ($poli as $p) {
			$data = array();
			for ($i=1; $i <= 12; $i++) { 
				$rekam_medis = $this->m_rekam_medis->get(array(
					'month(rekam_medis.tgl_periksa)' => $i,
					'year(rekam_medis.tgl_periksa)' => date('Y'),
					'dokter.id_poli' => $p->ID_POLI
					));

				array_push($data, count($rekam_medis));
			}
			$obj_series = (object) [
				'name' => $p->NM_POLI,
				'data' => $data
				];

			array_push($arr_data, $obj_series);
		}

		header("Content-Type: application/json");
        echo json_encode($arr_data);
	}

	public function registrasi()
	{
		$arr_data = array();
		for ($i=1; $i <= 12; $i++) { 
			$pasien = $this->m_pasien->get(array(
				'month(pasien.tgl_daftar)' => $i,
				'year(pasien.tgl_daftar)' => date('Y')
				));

			array_push($arr_data, count($pasien));
		}
		
		header("Content-Type: application/json");
        echo json_encode($arr_data);
	}

	public function penyakit()
	{
		$dokter = $this->m_dokter->get(array('dokter.id_dokter' => $_SESSION['userid']));
		$arr_data = array();
		$diagnosa = $this->m_diagnosa_icd_10->get(array('diagnosa_icd_10.id_poli' => $dokter[0]->ID_POLI));
		foreach ($diagnosa as $dg) {
			$data = array();
			for ($i=1; $i <= 12; $i++) { 
				$rekam_medis = $this->m_detail_diagnosa->get(array(
					'month(rekam_medis.tgl_periksa)' => $i,
					'year(rekam_medis.tgl_periksa)' => date('Y'),
					'detail_diagnosa.kode_icd_10' => $dg->KODE_ICD_10
					));

				array_push($data, count($rekam_medis));
			}
			$obj_series = (object) [
				'name' => $dg->NM_ICD_10,
				'data' => $data
				];

			array_push($arr_data, $obj_series);
		}

		header("Content-Type: application/json");
        echo json_encode($arr_data);
	}

	public function kunjungan_dokter()
	{
		$arr_data = array();
		for ($i=1; $i <= 12; $i++) { 
			$rekam_medis = $this->m_rekam_medis->get(array(
				'month(rekam_medis.tgl_periksa)' => $i,
				'year(rekam_medis.tgl_periksa)' => date('Y'),
				'rekam_medis.id_dokter' => $_SESSION['userid']
				));

			array_push($arr_data, count($rekam_medis));
		}
		
		header("Content-Type: application/json");
        echo json_encode($arr_data);
	}

	public function pemeriksaan_lab()
	{
		$arr_data = array();
		for ($i=1; $i <= 12; $i++) { 
			$hasil_lab = $this->m_hasil_lab->get(array(
				'month(rekam_medis.tgl_periksa)' => $i,
				'year(rekam_medis.tgl_periksa)' => date('Y'),
				));

			array_push($arr_data, count($hasil_lab));
		}
		
		header("Content-Type: application/json");
        echo json_encode($arr_data);
	}

	public function obat_keluar()
	{
		$arr_data = array();
		for ($i=1; $i <= 12; $i++) { 
			$resep_obat = $this->m_security->query("select sum(kuantitas_obat) as JUMLAH 
				from resep_obat 
					left join rekam_medis on resep_obat.id_rekam_medis = rekam_medis.id_rekam_medis
					left join obat on resep_obat.id_obat = obat.id_obat 
				where 
					month(rekam_medis.tgl_periksa) = '".$i."' and 
					year(rekam_medis.tgl_periksa) = '".date('Y')."'");
			if ($resep_obat[0]->JUMLAH == null) 
				$jumlah = 0;
			else 
				$jumlah = (int)$resep_obat[0]->JUMLAH;
			array_push($arr_data, $jumlah);
		}
		
		header("Content-Type: application/json");
        echo json_encode($arr_data);
	}

	public function pendapatan()
	{
		$arr_data = array();
		for ($i=1; $i <= 12; $i++) { 
			$pembayaran = $this->m_security->query("select sum(total_bayar) as JUMLAH 
				from pembayaran 
					left join rekam_medis on pembayaran.id_rekam_medis = rekam_medis.id_rekam_medis
				where 
					month(rekam_medis.tgl_periksa) = '".$i."' and 
					year(rekam_medis.tgl_periksa) = '".date('Y')."'");
			if ($pembayaran[0]->JUMLAH == null) 
				$jumlah = 0;
			else 
				$jumlah = (int)$pembayaran[0]->JUMLAH;
			array_push($arr_data, $jumlah);
		}
		
		header("Content-Type: application/json");
        echo json_encode($arr_data);
	}
}
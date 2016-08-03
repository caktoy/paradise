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

	public function beranda()
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
}

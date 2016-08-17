<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Tindakan_ICD_9 extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Tindakan ICD 9");
		$data['judul'] = "Maintenance Master Tindakan ICD 9";
		$data['konten'] = "master/tindakan_icd_9";
		$data['kodetindakan_icd_9'] = $this->m_security->gen_non_ai_id("ICD09", "tindakan_icd_9", "kode_icd_9", 5);
		$data['diagnosa'] = $this->m_diagnosa_icd_10->get(array());

		$arr_tindakan = array();
		$tindakan_icd_9 = $this->m_tindakan_icd_9->get(array());
		foreach ($tindakan_icd_9 as $tindakan) {
			$diagnosis = $this->m_tindakan_diagnosa->get(array('tindakan_diagnosa.kode_icd_9' => $tindakan->KODE_ICD_9));

			$obj = (object) [
				'KODE_ICD_9' => $tindakan->KODE_ICD_9,
				'NM_ICD_9' => $tindakan->NM_ICD_9,
				'KET_ICD_9' => $tindakan->KET_ICD_9,
				'HARGA_TINDAKAN' => $tindakan->HARGA_TINDAKAN,
				'DIAGNOSA' => $diagnosis
			];

			array_push($arr_tindakan, $obj);
		}
		$data['tindakan_icd_9'] = $arr_tindakan;
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$kode_icd_9 = $this->input->post('kode_icd_9');
		$diagnosa = $this->input->post('diagnosa');
        $nm_icd_9 = $this->input->post('nm_icd_9');
        $ket_icd_9 = $this->input->post('ket_icd_9');
        $harga_tindakan = $this->input->post('harga_tindakan');
        
        $check_tindakan_icd_9 = $this->m_tindakan_icd_9->get(array('lower(nm_icd_9)' => strtolower($nm_icd_9)));
        if(count($check_tindakan_icd_9) > 0) {
            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data Tindakan ICD 9 dengan nama \''.$nama_tindakan_icd_9.'\' sudah ada.');
        } else {
            $act = $this->m_tindakan_icd_9->create(array(
            	'kode_icd_9' => $kode_icd_9,
            	'nm_icd_9' => $nm_icd_9,
            	'ket_icd_9' => $ket_icd_9,
            	'harga_tindakan' => $harga_tindakan
            	));
	        
	        if ($act > 0) {
	        	foreach ($diagnosa as $d) {
	        		$this->m_tindakan_diagnosa->create(array(
	        			'kode_icd_9' => $kode_icd_9,
	        			'kode_icd_10' => $d
	        			));
	        	}

	        	$this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data Tindakan ICD 9 telah disimpan.');
	        } else {
	        	$this->session->set_flashdata('pesan', '<b>Gagal!</b> Data Tindakan ICD 9 gagal disimpan.');
	        }
        }
        
        redirect('tindakan_icd_9');
	}

	public function edit()
	{
		$kode_icd_9 = $this->input->post('e-kode_icd_9');
		$diagnosa = $this->input->post('e-diagnosa');
        $nm_icd_9 = $this->input->post('e-nm_icd_9');
        $ket_icd_9 = $this->input->post('e-ket_icd_9');
        $harga_tindakan = $this->input->post('e-harga_tindakan');

		$act = $this->m_tindakan_icd_9->patch(
			array('kode_icd_9' => $kode_icd_9),
			array(
				'nm_icd_9' => $nm_icd_9,
            	'ket_icd_9' => $ket_icd_9,
            	'harga_tindakan' => $harga_tindakan
				)
			);

		if ($act > 0) {
			$this->m_tindakan_diagnosa->remove(array('kode_icd_9' => $kode_icd_9));
			foreach ($diagnosa as $d) {
        		$this->m_tindakan_diagnosa->create(array(
        			'kode_icd_9' => $kode_icd_9,
        			'kode_icd_10' => $d
        			));
        	}

            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data Tindakan ICD 9 telah diubah.');
		}
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data Tindakan ICD 9 gagal diubah.');

        redirect('tindakan_icd_9');
	}

	public function get()
	{
		$id = $this->input->post('id');
		$data = $this->m_tindakan_icd_9->get(array('kode_icd_9' => $id));
		header("Content-Type: application/json");
        echo json_encode($data);
	}
}
?>
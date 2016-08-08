<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Diagnosis_ICD_10 extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Diagnosis ICD 10");
		$data['judul'] = "Maintenance Master Diagnosis ICD 10";
		$data['konten'] = "master/diagnosis_icd_10";
		$data['kodediagnosis_icd_10'] = $this->m_security->gen_non_ai_id("ICD10", "diagnosa_icd_10", "kode_icd_10", 5);
		$data['diagnosis_icd_10'] = $this->m_diagnosa_icd_10->get(array());
		$data['poli'] = $this->m_poli->get(array());
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$kode_icd_10 = $this->input->post('kode_icd_10');
        $id_poli = $this->input->post('id_poli');
        $nm_icd_10 = $this->input->post('nm_icd_10');
        $ket_icd_10 = $this->input->post('ket_icd_10');
        
        $check_diagnosis_icd_10 = $this->m_diagnosa_icd_10->get(array('lower(nm_icd_10)' => strtolower($nm_icd_10)));
        if(count($check_diagnosis_icd_10) > 0) {
            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data Diagnosis ICD 10 dengan nama \''.$nama_diagnosis_icd_10.'\' sudah ada.');
        } else {
            $act = $this->m_diagnosa_icd_10->create(array(
            	'kode_icd_10' => $kode_icd_10,
            	'id_poli' => $id_poli,
            	'nm_icd_10' => $nm_icd_10,
            	'ket_icd_10' => $ket_icd_10
            	));
	        
	        if ($act > 0) 
	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data Diagnosis ICD 10 telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data Diagnosis ICD10 gagal disimpan.');
        }
        
        redirect('diagnosis_icd_10');
	}

	public function edit()
	{
		$kode_icd_10 = $this->input->post('e-kode_icd_10');
		$id_poli = $this->input->post('e-id_poli');
        $nm_icd_10 = $this->input->post('e-nm_icd_10');
        $ket_icd_10 = $this->input->post('e-ket_icd_10');

		$act = $this->m_diagnosa_icd_10->patch(
			array('kode_icd_10' => $kode_icd_10),
			array(
				'id_poli' => $id_poli, 
				'nm_icd_10' => $nm_icd_10, 
				'ket_icd_10' => $ket_icd_10)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data Diagnosis ICD 10 telah diubah.');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data Diagnosis ICD10 gagal diubah.');

        redirect('diagnosis_icd_10');
	}

	public function get()
	{
		$id = $this->input->post('id');
		$data = $this->m_diagnosa_icd_10->get(array('kode_icd_10' => $id));
		header("Content-Type: application/json");
        echo json_encode($data);
	}
}
?>
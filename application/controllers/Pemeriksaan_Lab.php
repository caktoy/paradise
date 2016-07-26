<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Pemeriksaan_Lab extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Pemeriksaan Lab");
		$data['judul'] = "Maintenance Master Pemeriksaan Lab";
		$data['konten'] = "master/pemeriksaan_lab";
		$data['kodepemeriksaan_lab'] = $this->m_security->gen_non_ai_id("LAB", "pemeriksaan_lab", "id_lab", 4);
		$data['pemeriksaan_lab'] = $this->m_pemeriksaan_lab->get(array());
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$id_lab = $this->input->post('id_lab');
        $lab = $this->input->post('lab');
        $harga = $this->input->post('harga');
        
        $check_pemeriksaan_lab = $this->m_pemeriksaan_lab->get(array('lower(lab)' => strtolower($lab)));
        if(count($check_pemeriksaan_lab) > 0) {
            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data pemeriksaan lab dengan nama lab \''.$lab.'\' sudah ada.');
        } else {
            $act = $this->m_pemeriksaan_lab->create(array(
            	'id_lab' => $id_lab,
            	'lab' => $lab,
            	'harga' => $harga
            	));
	        
	        if ($act > 0) 
	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data pemeriksaan lab telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data pemeriksaan lab gagal disimpan.');
        }
        
        redirect('pemeriksaan_lab');
	}

	public function edit()
	{
		$id_lab = $this->input->post('e-id_lab');
		$lab = $this->input->post('e-lab');
		$harga = $this->input->post('e-harga');

		$act = $this->m_pemeriksaan_lab->patch(
			array('id_lab' => $id_lab),
			array(
				'lab' => $lab,
				'harga' => $harga
				)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data pemeriksaan lab telah diubah.');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data pemeriksaan lab gagal diubah.');

        redirect('pemeriksaan_lab');
	}
}
?>
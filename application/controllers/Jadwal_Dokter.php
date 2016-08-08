<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Jadwal_Dokter extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Jadwal Dokter");
		$data['judul'] = "Maintenance Master Jadwal Dokter";
		$data['konten'] = "master/jadwal_dokter";
		$data['kode_jadwal_dokter'] = $this->m_security->gen_non_ai_id("JP", "jadwal_dokter", "id_jadwal", 3);
		$data['dokter'] = $this->m_dokter->get(array());
		$data['jadwal_dokter'] = $this->m_jadwal_dokter->get(array());
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$id_jadwal = $this->input->post('id_jadwal');
        $id_dokter = $this->input->post('id_dokter');
        $jadwal_mulai = $this->input->post('jadwal_mulai');
        $jadwal_selesai = $this->input->post('jadwal_selesai');
        $hari = $this->input->post('hari');
        
        // $check_jadwal_dokter = $this->m_jadwal_dokter->get(array(
        // 	'lower(jadwal_dokter.id_dokter)' => strtolower($id_dokter),
        // 	'lower(jadwal_dokter.hari)' => strtolower($hari)
        // 	));
        // if(count($check_jadwal_dokter) > 0) {
        //     $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data jadwal dokter bersangkutan pada hari '.$hari.' sudah ada.');
        // } else {
            $act = $this->m_jadwal_dokter->create(array(
            	'id_jadwal' => $id_jadwal,
            	'id_dokter' => $id_dokter,
            	'jadwal_mulai' => $jadwal_mulai,
            	'jadwal_selesai' => $jadwal_selesai,
            	'hari' => $hari
            	));
	        
	        if ($act > 0) 
	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data jadwal dokter telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data jadwal dokter gagal disimpan.');
        // }
        
        redirect('jadwal_dokter');
	}

	public function edit()
	{
		$id_jadwal = $this->input->post('e-id_jadwal');
        $id_dokter = $this->input->post('e-id_dokter');
        $jadwal_mulai = $this->input->post('e-jadwal_mulai');
        $jadwal_selesai = $this->input->post('e-jadwal_selesai');
        $hari = $this->input->post('e-hari');

		$act = $this->m_jadwal_dokter->patch(
			array('id_jadwal' => $id_jadwal),
			array(
				'id_dokter' => $id_dokter,
            	'jadwal_mulai' => $jadwal_mulai,
            	'jadwal_selesai' => $jadwal_selesai,
            	'hari' => $hari
				)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data jadwal dokter telah diubah.');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data jadwal dokter gagal diubah.');

        redirect('jadwal_dokter');
	}
}
?>
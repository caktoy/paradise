<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Nomenklatur extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Nomenklatur");
		$data['judul'] = "Maintenance Master Nomenklatur";
		$data['konten'] = "master/nomenklatur";
		$data['kodenomenklatur'] = $this->m_security->gen_non_ai_id("NOMEN", "nomenklatur", "nomor", 5);
		$data['nomenklatur'] = $this->m_nomenklatur->get(array());
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$nomor = $this->input->post('nomor');
        $nama = $this->input->post('nama');
        
        $check_nomenklatur = $this->m_nomenklatur->get(array('lower(nomor)' => strtolower($nomor)));
        if(count($check_nomenklatur) > 0) {
            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data nomenklatur dengan nomor \''.$nomor.'\' sudah ada.');
        } else {
            $act = $this->m_nomenklatur->create(array(
            	'nomor' => $nomor,
            	'nama' => $nama
            	));
	        
	        if ($act > 0) 
	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data nomenklatur telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data nomenklatur gagal disimpan.');
        }
        
        redirect('nomenklatur');
	}

	public function edit()
	{
		$nomor = $this->input->post('e-nomor');
		$nama = $this->input->post('e-nama');

		$act = $this->m_nomenklatur->patch(
			array('nomor' => $nomor),
			array('nama' => $nama)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data nomenklatur telah diubah.');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data nomenklatur gagal diubah.');

        redirect('nomenklatur');
	}
}
?>
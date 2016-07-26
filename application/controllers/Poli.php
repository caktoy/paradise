<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Poli extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Poli");
		$data['judul'] = "Maintenance Master Poli";
		$data['konten'] = "master/poli";
		$data['kodepoli'] = $this->m_security->gen_non_ai_id("PL", "poli", "id_poli", 3);
		$data['poli'] = $this->m_poli->get(array());
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$id_poli = $this->input->post('idpoli');
        $nama_poli = $this->input->post('namapoli');
        
        $check_poli = $this->m_poli->get(array('lower(nm_poli)' => strtolower($nama_poli)));
        if(count($check_poli) > 0) {
            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data Poli dengan nama \''.$nama_poli.'\' sudah ada.');
        } else {
            $act = $this->m_poli->create(array(
            	'id_poli' => $id_poli,
            	'nm_poli' => $nama_poli
            	));
	        
	        if ($act > 0) 
	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data Poli telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data Poli gagal disimpan.');
        }
        
        redirect('poli');
	}

	public function edit()
	{
		$id_poli = $this->input->post('editkode');
		$nm_poli = $this->input->post('editnama');

		$act = $this->m_poli->patch(
			array('id_poli' => $id_poli),
			array('nm_poli' => $nm_poli)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data Poli telah diubah.');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data Poli gagal diubah.');

        redirect('poli');
	}
}
?>
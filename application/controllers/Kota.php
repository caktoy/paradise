<?php  defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Kota extends CI_Controller
{
	
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Kota");
		$data['judul'] = "Maintenance Master Kota";
		$data['konten'] = "master/kota";
		$data['kodekota'] = $this->m_security->gen_non_ai_id("KOTA", "kota", "id_kota", 5);
		$data['kota'] = $this->m_kota->get(array());
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$id_kota = $this->input->post('id_kota');
        $nama_kota = $this->input->post('nm_kota');
        
        $check_kota = $this->m_kota->get(array('lower(nm_kota)' => strtolower($nama_kota)));
        if(count($check_kota) > 0) {
            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data kota dengan nama \''.$nama_kota.'\' sudah ada.');
        } else {
            $act = $this->m_kota->create(array(
            	'id_kota' => $id_kota,
            	'nm_kota' => $nama_kota
            	));
	        
	        if ($act > 0) 
	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data kota telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data kota gagal disimpan.');
        }
        
        redirect('kota');
	}

	public function edit()
	{
		$id_kota = $this->input->post('editkode');
		$nm_kota = $this->input->post('editnama');

		$act = $this->m_kota->patch(
			array('id_kota' => $id_kota),
			array('nm_kota' => $nm_kota)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data kota telah diubah.');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data kota gagal diubah.');

        redirect('kota');
	}
}
?>
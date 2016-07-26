<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Jenis_Obat extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Jenis Obat");
		$data['judul'] = "Maintenance Master Jenis Obat";
		$data['konten'] = "master/jenis_obat";
		$data['kodejenis_obat'] = $this->m_security->gen_non_ai_id("JO", "jenis_obat", "id_jenis_obat", 3);
		$data['jenis_obat'] = $this->m_jenis_obat->get(array());
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$id_jenis_obat = $this->input->post('id_jenis_obat');
        $nama_jenis_obat = $this->input->post('nama_jenis_obat');
        
        $check_jenis_obat = $this->m_jenis_obat->get(array('lower(nm_jenis_obat)' => strtolower($nama_jenis_obat)));
        if(count($check_jenis_obat) > 0) {
            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data jenis obat dengan nama \''.$nama_jenis_obat.'\' sudah ada.');
        } else {
            $act = $this->m_jenis_obat->create(array(
            	'id_jenis_obat' => $id_jenis_obat,
            	'nm_jenis_obat' => $nama_jenis_obat
            	));
	        
	        if ($act > 0) 
	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data jenis obat telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data jenis obat gagal disimpan.');
        }
        
        redirect('jenis_obat');
	}

	public function edit()
	{
		$id_jenis_obat = $this->input->post('editkode');
		$nm_jenis_obat = $this->input->post('editnama');

		$act = $this->m_jenis_obat->patch(
			array('id_jenis_obat' => $id_jenis_obat),
			array('nm_jenis_obat' => $nm_jenis_obat)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data jenis obat telah diubah.');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data jenis obat gagal diubah.');

        redirect('jenis_obat');
	}
}
?>
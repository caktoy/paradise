<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Obat extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Obat");
		$data['judul'] = "Maintenance Master Obat";
		$data['konten'] = "master/obat";
		$data['kodeobat'] = $this->m_security->gen_non_ai_id("OB", "obat", "id_obat", 4);
		$data['jenis_obat'] = $this->m_jenis_obat->get(array());
		$data['obat'] = $this->m_obat->get(array());
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$id_obat = $this->input->post('id_obat');
        $id_jenis_obat = $this->input->post('id_jenis_obat');
        $nm_obat = $this->input->post('nm_obat');
        $jml_obat = $this->input->post('jml_obat');
        $hrg_obat = $this->input->post('hrg_obat');
        $satuan = $this->input->post('satuan');
        
        $check_obat = $this->m_obat->get(array(
        	'lower(obat.id_jenis_obat)' => strtolower($id_jenis_obat),
        	'lower(nm_obat)' => strtolower($nm_obat)
        	));
        if(count($check_obat) > 0) {
            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data obat dengan nama \''.$nm_obat.'\' sudah ada.');
        } else {
            $act = $this->m_obat->create(array(
            	'id_obat' => $id_obat,
            	'id_jenis_obat' => $id_jenis_obat,
            	'nm_obat' => $nm_obat,
            	'jml_obat' => $jml_obat,
            	'hrg_obat' => $hrg_obat,
            	'satuan' => $satuan
            	));
	        
	        if ($act > 0) 
	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data obat telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data obat gagal disimpan.');
        }
        
        redirect('obat');
	}

	public function edit()
	{
		$id_obat = $this->input->post('e-id_obat');
        $id_jenis_obat = $this->input->post('e-id_jenis_obat');
        $nm_obat = $this->input->post('e-nm_obat');
        $jml_obat = $this->input->post('e-jml_obat');
        $hrg_obat = $this->input->post('e-hrg_obat');
        $satuan = $this->input->post('e-satuan');

		$act = $this->m_obat->patch(
			array('id_obat' => $id_obat),
			array(
				'id_jenis_obat' => $id_jenis_obat,
            	'nm_obat' => $nm_obat,
            	'jml_obat' => $jml_obat,
            	'hrg_obat' => $hrg_obat,
            	'satuan' => $satuan
				)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data obat telah diubah.');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data obat gagal diubah.');

        redirect('obat');
	}
}
?>
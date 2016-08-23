<?php  
/**
* 
*/
class Jenis_Lab extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Lab", "Master Jenis Lab");
		$data['judul'] = "Maintenance Master Jenis Lab";
		$data['konten'] = "master/jenis_lab";
		$data['kodejenis_lab'] = $this->m_security->gen_non_ai_id("JL", "jenis_lab", "id_jenis_lab", 3);
		$data['jenis_lab'] = $this->m_jenis_lab->get(array());
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$id_jenis_lab = $this->input->post('id_jenis_lab');
        $nama_jenis_lab = $this->input->post('nama_jenis_lab');
        
        $check_jenis_lab = $this->m_jenis_lab->get(array('lower(nm_lab)' => strtolower($nama_jenis_lab)));
        if(count($check_jenis_lab) > 0) {
            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data jenis lab dengan nama \''.$nama_jenis_lab.'\' sudah ada.');
        } else {
            $act = $this->m_jenis_lab->create(array(
            	'id_jenis_lab' => $id_jenis_lab,
            	'nm_lab' => $nama_jenis_lab
            	));
	        
	        if ($act > 0) 
	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data jenis lab telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data jenis lab gagal disimpan.');
        }
        
        redirect('jenis_lab');
	}

	public function edit()
	{
		$id_jenis_lab = $this->input->post('editkode');
		$nm_jenis_lab = $this->input->post('editnama');

		$act = $this->m_jenis_lab->patch(
			array('id_jenis_lab' => $id_jenis_lab),
			array('nm_lab' => $nm_jenis_lab)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data jenis lab telah diubah.');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data jenis lab gagal diubah.');

        redirect('jenis_lab');
	}
}
?>
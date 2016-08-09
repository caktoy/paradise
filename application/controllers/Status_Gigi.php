<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Status_Gigi extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Status Gigi");
		$data['judul'] = "Maintenance Master Status Gigi";
		$data['konten'] = "master/status_gigi";
		$data['kodestatus_gigi'] = $this->m_security->gen_non_ai_id("SG", "status_gigi", "kode_status", 4);
		$data['status_gigi'] = $this->m_status_gigi->get(array());
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$kode_status = $this->input->post('kode_status');
        $status = $this->input->post('status');
        $ket_status = $this->input->post('ket');
        
        // upload foto
        $config['file_name']            = $kode_status;
        $config['upload_path']          = './assets/images/odontogram/';
        $config['allowed_types']        = 'bmp|jpg|png';
        $config['overwrite']			= true;
        $config['max_size']             = 2048;

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('gambar')) {
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> '.$this->upload->display_errors());
            redirect('status_gigi');
        } else {
            $data_upload = $this->upload->data();
	        $check_status_gigi = $this->m_status_gigi->get(array('lower(status)' => strtolower($status)));
	        if(count($check_status_gigi) > 0) {
	            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data status gigi dengan status \''.$status.'\' sudah ada.');
	        } else {
	            $act = $this->m_status_gigi->create(array(
	            	'kode_status' => $kode_status,
	            	'status' => $status,
	            	'gambar' => $data_upload['file_name'],
	            	'ket_status' => $ket_status
	            	));
		        
		        if ($act > 0) 
		            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data status gigi telah disimpan.');
		        else
		            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data status gigi gagal disimpan.');
	        }
	        
	        redirect('status_gigi');
	    }
	}

	public function edit()
	{
		$kode_status = $this->input->post('e-kode_status');
        $status = $this->input->post('e-status');
        $ket_status = $this->input->post('e-ket');

		// upload foto
        $config['file_name']            = 'ODONTOGRAM_'.$kode_status;
        $config['upload_path']          = './assets/images/odontogram/';
        $config['allowed_types']        = 'bmp|jpg|png';
        $config['overwrite']			= true;
        $config['max_size']             = 2048;
        
        $this->upload->initialize($config);
        if ($this->upload->do_upload('e-gambar')) {
            $data_upload = $this->upload->data();
            $this->m_status_gigi->patch(
            	array('kode_status' => $kode_status),
            	array('gambar' => $data_upload['file_name'])
            	);
        }

		$act = $this->m_status_gigi->patch(
			array('kode_status' => $kode_status),
			array('status' => $status, 'ket_status' => $ket_status)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data status gigi telah diubah.');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data status gigi gagal diubah.');

        redirect('status_gigi');
	}
}
?>
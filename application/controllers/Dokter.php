<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Dokter extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Dokter");
		$data['judul'] = "Maintenance Master Dokter";
		$data['konten'] = "master/dokter";
		$data['kodedokter'] = $this->m_security->gen_non_ai_id("1", "dokter", "id_dokter", 4);
		$data['poli'] = $this->m_poli->get(array());
		$data['dokter'] = $this->m_dokter->get(array());
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$id_dokter = $this->input->post('iddokter');
		$id_poli = $this->input->post('idpoli');
        $nm_dokter = $this->input->post('namadokter');
        $tmpt_lhr_dokter = $this->input->post('tmptlahir');
        $tgl_lhr_dokter = $this->input->post('tgllahir');
        $jk_dokter = $this->input->post('jk');
        $almt_dokter = $this->input->post('almtdokter');
        $telp_dokter = $this->input->post('telpdokter');
        $pass_dokter = $this->input->post('passdokter');

        // upload foto
        $config['file_name']            = 'foto_'.$id_dokter;
        $config['upload_path']          = './assets/images/foto/';
        $config['allowed_types']        = 'bmp|jpg|png';
        $config['overwrite']			= true;
        $config['max_size']             = 2048;

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('fotodokter')) {
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> '.$this->upload->display_errors());
            redirect('dokter');
        } else {
            $data_upload = $this->upload->data();
	        $check_dokter = $this->m_dokter->get(array('lower(nm_dokter)' => strtolower($nm_dokter)));
	        if(count($check_dokter) > 0) {
	            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data Dokter dengan nama \''.$nama_dokter.'\' sudah ada.');
	        } else {
	            $act = $this->m_dokter->create(array(
	            	'id_dokter' => $id_dokter,
	            	'id_poli' => $id_poli,
	            	'nm_dokter' => $nm_dokter,
	            	'tmpt_lhr_dokter' => $tmpt_lhr_dokter,
	            	'tgl_lhr_dokter' => $tgl_lhr_dokter,
	            	'jk_dokter' => $jk_dokter,
	            	'almt_dokter' => $almt_dokter,
	            	'telp_dokter' => $telp_dokter,
	            	'pass_dokter' => md5($pass_dokter),
	            	'foto_dokter' => $data_upload['file_name']
	            	));
		        
		        if ($act > 0) 
		            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data dokter telah disimpan.');
		        else
		            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data dokter gagal disimpan.');
	        }
	        
	        redirect('dokter');
        }
	}

	public function edit()
	{
		$id_dokter = $this->input->post('e-iddokter');
		$id_poli = $this->input->post('e-idpoli');
        $nm_dokter = $this->input->post('e-namadokter');
        $tmpt_lhr_dokter = $this->input->post('e-tmptlahir');
        $tgl_lhr_dokter = $this->input->post('e-tgllahir');
        $jk_dokter = $this->input->post('e-jk');
        $almt_dokter = $this->input->post('e-almtdokter');
        $telp_dokter = $this->input->post('e-telpdokter');
        $pass_dokter = $this->input->post('e-passdokter');

        // upload foto
        $config['file_name']            = 'foto_'.$id_dokter;
        $config['upload_path']          = './assets/images/foto/';
        $config['allowed_types']        = 'bmp|jpg|png';
        $config['overwrite']			= true;
        $config['max_size']             = 2048;
        
        $this->upload->initialize($config);
        if ($this->upload->do_upload('e-fotodokter')) {
            $data_upload = $this->upload->data();
            $this->m_dokter->patch(
            	array('id_dokter' => $id_dokter),
            	array('foto_dokter' => $data_upload['file_name'])
            	);
        }

		$act = $this->m_dokter->patch(
			array('id_dokter' => $id_dokter),
			array(
				'id_poli' => $id_poli,
            	'nm_dokter' => $nm_dokter,
            	'tmpt_lhr_dokter' => $tmpt_lhr_dokter,
            	'tgl_lhr_dokter' => $tgl_lhr_dokter,
            	'jk_dokter' => $jk_dokter,
            	'almt_dokter' => $almt_dokter,
            	'telp_dokter' => $telp_dokter,
            	'pass_dokter' => md5($pass_dokter)
				)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data dokter telah diubah.');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data dokter gagal diubah.');

        redirect('dokter');
	}

	public function get()
	{
		$id = $this->input->post('id');
        $dokter = $this->m_dokter->get(array('id_dokter' => $id));
        header("Content-Type: application/json");
        echo json_encode($dokter);
	}
}
?>
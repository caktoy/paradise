<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Perawat extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Perawat");
		$data['judul'] = "Maintenance Master Perawat";
		$data['konten'] = "master/perawat";
		$data['kodeperawat'] = $this->m_security->gen_non_ai_id("2", "perawat", "id_perawat", 4);
		$data['perawat'] = $this->m_perawat->get(array());
		$data['kota'] = $this->m_kota->get(array());
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$id_perawat = $this->input->post('idperawat');
        $nm_perawat = $this->input->post('namaperawat');
        $tmpt_lhr_perawat = $this->input->post('tmptlahir');
        $tgl_lhr_perawat = $this->input->post('tgllahir');
        $jk_perawat = $this->input->post('jk');
        $almt_perawat = $this->input->post('almtperawat');
        $telp_perawat = $this->input->post('telpperawat');
        $pass_perawat = $this->input->post('passperawat');
		$bag_perawat = $this->input->post('bagperawat');

        // upload foto
        $config['file_name']            = 'foto_'.$id_perawat;
        $config['upload_path']          = './assets/images/foto/';
        $config['allowed_types']        = 'bmp|jpg|png';
        $config['overwrite']			= true;
        $config['max_size']             = 2048;

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('fotoperawat')) {
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> '.$this->upload->display_errors());
            redirect('perawat');
        } else {
            $data_upload = $this->upload->data();
	        $check_perawat = $this->m_perawat->get(array('lower(nm_perawat)' => strtolower($nm_perawat)));
	        if(count($check_perawat) > 0) {
	            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data perawat dengan nama \''.$nama_perawat.'\' sudah ada.');
	        } else {
	            $act = $this->m_perawat->create(array(
	            	'id_perawat' => $id_perawat,
	            	'id_kota' => $tmpt_lhr_perawat,
	            	'bag_perawat' => $bag_perawat,
	            	'nm_perawat' => $nm_perawat,
	            	'tgl_lhr_perawat' => $tgl_lhr_perawat,
	            	'jk_perawat' => $jk_perawat,
	            	'alamat_perawat' => $almt_perawat,
	            	'telp_perawat' => $telp_perawat,
	            	'pass_perawat' => md5($pass_perawat),
	            	'foto_perawat' => $data_upload['file_name']
	            	));
		        
		        if ($act > 0) 
		            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data perawat telah disimpan.');
		        else
		            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data perawat gagal disimpan.');
	        }
	        
	        redirect('perawat');
        }
	}

	public function edit()
	{
		$id_perawat = $this->input->post('e-idperawat');
        $nm_perawat = $this->input->post('e-namaperawat');
        $tmpt_lhr_perawat = $this->input->post('e-tmptlahir');
        $tgl_lhr_perawat = $this->input->post('e-tgllahir');
        $jk_perawat = $this->input->post('e-jk');
        $almt_perawat = $this->input->post('e-almtperawat');
        $telp_perawat = $this->input->post('e-telpperawat');
        $pass_perawat = $this->input->post('e-passperawat');
        $bag_perawat = $this->input->post('e-bagperawat');

        // upload foto
        $config['file_name']            = 'foto_'.$id_perawat;
        $config['upload_path']          = './assets/images/foto/';
        $config['allowed_types']        = 'bmp|jpg|png';
        $config['overwrite']			= true;
        $config['max_size']             = 2048;
        
        $this->upload->initialize($config);
        if ($this->upload->do_upload('e-fotoperawat')) {
            $data_upload = $this->upload->data();
            $this->m_perawat->patch(
            	array('id_perawat' => $id_perawat),
            	array('foto_perawat' => $data_upload['file_name'])
            	);
        }

		$act = $this->m_perawat->patch(
			array('id_perawat' => $id_perawat),
			array(
            	'id_kota' => $tmpt_lhr_perawat,
				'bag_perawat' => $bag_perawat,
            	'nm_perawat' => $nm_perawat,
            	'tgl_lhr_perawat' => $tgl_lhr_perawat,
            	'jk_perawat' => $jk_perawat,
            	'alamat_perawat' => $almt_perawat,
            	'telp_perawat' => $telp_perawat,
            	'pass_perawat' => md5($pass_perawat)
				)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data perawat telah diubah.');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data perawat gagal diubah.');

        redirect('perawat');
	}

	public function get()
	{
		$id = $this->input->post('id');
        $perawat = $this->m_perawat->get(array('id_perawat' => $id));
        header("Content-Type: application/json");
        echo json_encode($perawat);
	}
}
?>
<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Pemeriksaan_Lab extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Pemeriksaan Lab");
		$data['judul'] = "Maintenance Master Pemeriksaan Lab";
		$data['konten'] = "master/pemeriksaan_lab";
		$data['kodepemeriksaan_lab'] = $this->m_security->gen_non_ai_id("LAB", "pemeriksaan_lab", "id_lab", 4);
		$data['pemeriksaan_lab'] = $this->m_pemeriksaan_lab->get(array());
		$data['poli'] = $this->m_poli->get(array());
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$id_lab = $this->input->post('id_lab');
		$id_poli = $this->input->post('id_poli');
        $lab = $this->input->post('lab');
        $harga = $this->input->post('harga');
        
        $check_pemeriksaan_lab = $this->m_pemeriksaan_lab->get(array('lower(lab)' => strtolower($lab)));
        if(count($check_pemeriksaan_lab) > 0) {
            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data pemeriksaan lab dengan nama lab \''.$lab.'\' sudah ada.');
        } else {
            $act = $this->m_pemeriksaan_lab->create(array(
            	'id_lab' => $id_lab,
            	'id_poli' => $id_poli,
            	'lab' => $lab,
            	'harga' => $harga
            	));
	        
	        if ($act > 0) 
	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data pemeriksaan lab telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data pemeriksaan lab gagal disimpan.');
        }
        
        redirect('pemeriksaan_lab');
	}

	public function edit()
	{
		$id_lab = $this->input->post('e-id_lab');
		$id_poli = $this->input->post('e-id_poli');
		$lab = $this->input->post('e-lab');
		$harga = $this->input->post('e-harga');

		$act = $this->m_pemeriksaan_lab->patch(
			array('id_lab' => $id_lab),
			array(
				'id_poli' => $id_poli,
				'lab' => $lab,
				'harga' => $harga
				)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data pemeriksaan lab telah diubah.');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data pemeriksaan lab gagal diubah.');

        redirect('pemeriksaan_lab');
	}

	public function transaksi()
	{
		date_default_timezone_set("Asia/Jakarta");
		$data['aktif'] = "transaksi";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Pemeriksaan Lab");
		$data['judul'] = "Daftar Pemeriksaan Lab";
		$data['konten'] = "transaksi/daftar_pemeriksaan_lab";
		$data['pemeriksaan_lab'] = $this->m_hasil_lab->get(array());
		
		$this->load->view('layout', $data);
	}

	public function periksa($rekam_medis, $lab)
	{
		date_default_timezone_set("Asia/Jakarta");
		$data['aktif'] = "transaksi";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Pemeriksaan Lab");
		$data['judul'] = "Proses Pemeriksaan Lab";
		$data['konten'] = "transaksi/proses_pemeriksaan_lab";

		$pemeriksaan_lab = $this->m_hasil_lab->get(array(
			'hasil_lab.id_lab' => $lab,
			'hasil_lab.id_rekam_medis' => $rekam_medis
			));
		if (count($pemeriksaan_lab) > 0) {
			$data['pemeriksaan_lab'] = $pemeriksaan_lab;
			
			$this->load->view('layout', $data);
		} else {
			redirect('pemeriksaan_lab/transaksi');
		}
	}

	public function simpan()
	{
		$rekam_medis = $this->input->post('id_rekam_medis');
		$lab = $this->input->post('id_lab');

		// upload foto
        $config['file_name']            = 'HASIL_LAB_'.$rekam_medis.'_'.$lab;
        $config['upload_path']          = './assets/images/hasil_lab/';
        $config['allowed_types']        = 'bmp|jpg|jpeg|png|pdf|docx|doc|xls|xlsx|zip|rar';
        $config['overwrite']			= true;
        $config['max_size']             = 5000;

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('hasil')) {
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> '.$this->upload->display_errors());
            redirect('pemeriksaan_lab/periksa/'.$rekam_medis.'/'.$lab);
        } else {
            $data_upload = $this->upload->data();

            $act = $this->m_hasil_lab->patch(
	            	array(
						'hasil_lab.id_lab' => $lab,
						'hasil_lab.id_rekam_medis' => $rekam_medis
					),
					array(
						'hasil_lab.file_hasil' => $data_upload['file_name']
					)
				);

            if ($act > 0) 
	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Hasil pemeriksaan lab telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Hasil pemeriksaan lab gagal disimpan.');

	        redirect('pemeriksaan_lab/transaksi');
        }
	}
}
?>
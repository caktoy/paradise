<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Pasien extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Pasien");
		$data['judul'] = "Maintenance Master Pasien";
		$data['konten'] = "master/pasien";
		$data['kodepasien'] = $this->m_security->gen_ai_id("pasien", "id_pasien");
		$data['pasien'] = $this->m_pasien->get(array());
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$id_pasien = $this->input->post('id_pasien');
        $nm_pasien = $this->input->post('nm_pasien');
        $tmpt_lhr_pasien = $this->input->post('tmpt_lhr_pasien');
        $tgl_lhr_pasien = $this->input->post('tgl_lhr_pasien');
        $almt_pasien = $this->input->post('almt_pasien');
        $telp_pasien = $this->input->post('telp_pasien');
        $tgl_daftar = $this->input->post('tgl_daftar');
        $jk_pasien = $this->input->post('jk_pasien');

        $check_pasien = $this->m_pasien->get(array(
        	'lower(nm_pasien)' => strtolower($nm_pasien),
        	'tgl_lhr_pasien' => $tgl_lhr_pasien
        	));
        if(count($check_pasien) > 0) {
            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data pasien dengan nama \''.$nm_pasien.'\' sudah ada.');
        } else {
            $act = $this->m_pasien->create(array(
            	'id_pasien' => $id_pasien,
            	'nm_pasien' => $nm_pasien,
            	'tmpt_lhr_pasien' => $tmpt_lhr_pasien,
            	'tgl_lhr_pasien' => $tgl_lhr_pasien,
            	'almt_pasien' => $almt_pasien,
            	'telp_pasien' => $telp_pasien,
            	'tgl_daftar' => date('Y-m-d'),
            	'jk_pasien' => $jk_pasien
            	));
	        
	        if ($act > 0) 
	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data pasien telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data pasien gagal disimpan.');
        }
        
        redirect('pasien');
	}

	public function edit()
	{
		$id_pasien = $this->input->post('e-id_pasien');
        $nm_pasien = $this->input->post('e-nm_pasien');
        $tmpt_lhr_pasien = $this->input->post('e-tmpt_lhr_pasien');
        $tgl_lhr_pasien = $this->input->post('e-tgl_lhr_pasien');
        $almt_pasien = $this->input->post('e-almt_pasien');
        $telp_pasien = $this->input->post('e-telp_pasien');
        $jk_pasien = $this->input->post('e-jk_pasien');

		$act = $this->m_pasien->patch(
			array('id_pasien' => $id_pasien),
			array(
				'nm_pasien' => $nm_pasien,
            	'tmpt_lhr_pasien' => $tmpt_lhr_pasien,
            	'tgl_lhr_pasien' => $tgl_lhr_pasien,
            	'almt_pasien' => $almt_pasien,
            	'telp_pasien' => $telp_pasien,
            	'jk_pasien' => $jk_pasien
				)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data pasien telah diubah.');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data pasien gagal diubah.');

        redirect('pasien');
	}

	public function get()
	{
		$id = $this->input->post('id');
        $pasien = $this->m_pasien->get(array('id_pasien' => $id));
        header("Content-Type: application/json");
        echo json_encode($pasien);
	}

    public function cari()
    {
        $data['aktif'] = "transaksi";
        $data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Pencarian Data Pasien");
        $data['judul'] = "Pencarian Data Pasien";
        $data['konten'] = "transaksi/cari_pasien";
        $data['pasien'] = $this->m_pasien->get(array());
        
        $this->load->view('layout', $data);
    }

    public function lihat_riwayat($id_pasien)
    {
        $data['aktif'] = "transaksi";
        $data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Pencarian Data Pasien", "Riwayat Pemeriksaan Pasien");
        $data['judul'] = "Riwayat Pemeriksaan Pasien";
        $data['konten'] = "transaksi/riwayat_pemeriksaan_pasien";
        $data['pasien'] = $this->m_pasien->get(array('pasien.id_pasien' => $id_pasien));
        $data['rekam_medis'] = $this->m_rekam_medis->get(array('rekam_medis.id_pasien' => $id_pasien));
        
        $this->load->view('layout', $data);
    }
}
?>
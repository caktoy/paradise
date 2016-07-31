<?php  
/**
* 
*/
class Registrasi_Pemeriksaan extends CI_Controller
{

	public function index()
	{
		$this->m_security->check();
		$data['aktif'] = "transaksi";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Registrasi Pemeriksaan");
		$data['judul'] = "Registrasi Pemeriksaan";
		$data['konten'] = "transaksi/registrasi_pemeriksaan";

		$data['kodepasien'] = $this->m_security->gen_ai_id("pasien", "id_pasien");
		$data['antrian'] = $this->m_antrian->get(array('tgl_antrian' => date('Y-m-d')));
		$data['pasien'] = $this->m_pasien->get(array());
		$data['poli'] = $this->m_poli->get(array());
		
		$this->load->view('layout', $data);
	}

	public function get_antrian()
	{
		$poli = $this->input->post('poli');

		if($poli != null) {
			$antrian = $this->m_antrian->get(array(
				'antrian.id_poli' => $poli,
				'tgl_antrian' => date('Y-m-d')
				));
			echo count($antrian) + 1;
		} else {
			echo 0;
		}
	}

	public function pasien_baru()
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
        
        redirect('registrasi_pemeriksaan');
	}

	public function new()
	{
		date_default_timezone_set("Asia/Jakarta");
		$nomer = $this->input->post('nomer');
		$pasien = $this->input->post('pasien');
		$poli = $this->input->post('poli');

		$check_pasien = $this->m_security->query("select * 
			from antrian 
			where id_pasien = '".$pasien."' 
			and tgl_antrian = '".date('Y-m-d')."'
			and status_antrian in ('Menunggu', 'Sedang Berlangsung')");
		if(count($check_pasien) == 0) {
			$act = $this->m_antrian->create(array(
				'id_antrian' => $nomer,
				'id_poli' => $poli,
				'id_pasien' => $pasien,
				'tgl_antrian' => date('Y-m-d'),
				'jam_antrian' => date('H:i:s'),
				'status_antrian' => 'Menunggu'
				));

			if ($act > 0) 
		        $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Registrasi Pemeriksaan telah disimpan.');
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Registrasi Pemeriksaan gagal disimpan.');
		} else {
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Pasien sudah terdaftar dan masih mengantri atau sedang melakukan pemeriksaan.');
		}

        redirect('registrasi_pemeriksaan');
	}
}
?>
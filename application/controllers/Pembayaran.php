<?php  
/**
* 
*/
class Pembayaran extends CI_Controller
{
	
	public function index()
	{
		$data['aktif'] = "transaksi";
        $data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Pembayaran");
        $data['judul'] = "Pembayaran";
        $data['konten'] = "transaksi/list_pembayaran";
        // $data['rekam_medis'] = $this->m_rekam_medis->get(array('rekam_medis.tgl_periksa' => date('Y-m-d')));
        $data['rekam_medis'] = $this->m_security->query("
        	select *, (select count(*) from pembayaran where id_rekam_medis = rekam_medis.id_rekam_medis) as BAYAR 
        	from rekam_medis 
        	inner join dokter on rekam_medis.id_dokter = dokter.id_dokter 
        	inner join pasien on rekam_medis.id_pasien = pasien.id_pasien
        	where rekam_medis.tgl_periksa = '".date('Y-m-d')."'");
        
        $this->load->view('layout', $data);
	}

	public function create($id_rekam_medis)
	{
		$rekam_medis = $this->m_rekam_medis->get(array('rekam_medis.id_rekam_medis' => $id_rekam_medis), 1);
		if (count($rekam_medis) > 0) {
			# pre proses, insert into table pembayaran
			$id_bayar = $this->m_security->gen_ai_id('pembayaran', 'id_bayar');
			$id_perawat = $_SESSION['userid'];
			$tgl_bayar = date('Y-m-d');

			$act = $this->m_pembayaran->create(array(
				'id_bayar' => $id_bayar,
				'id_perawat' => $id_perawat,
				'id_rekam_medis' => $id_rekam_medis,
				'id_dokter' => $rekam_medis[0]->ID_DOKTER,
				'id_pasien' => $rekam_medis[0]->ID_PASIEN,
				'tgl_bayar' => $tgl_bayar
				));

			if ($act > 0) {
				redirect('pembayaran/edit/'.$id_rekam_medis);
			} else {
				$this->session->set_flashdata('pesan', '<strong>Gagal!</strong> Proses pembayaran gagal dilakukan.');
				redirect('pembayaran');
			}
		} else {
			$this->session->set_flashdata('pesan', '<strong>Gagal!</strong> Proses pembayaran gagal dilakukan.');
			redirect('pembayaran');
		}
	}

	public function edit($id_rekam_medis)
	{
		$pembayaran = $this->m_pembayaran->get(array('pembayaran.id_rekam_medis' => $id_rekam_medis));
		if (count($pembayaran) > 0) {
			$data['aktif'] = "transaksi";
	        $data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Pembayaran", "Pembayaran Pemeriksaan");
	        $data['judul'] = "Pembayaran Pemeriksaan";
	        $data['konten'] = "transaksi/do_pembayaran";

	        $data['pembayaran'] = $pembayaran;
	        $data['rekam_medis'] = $this->m_rekam_medis->get(array('rekam_medis.id_rekam_medis' => $id_rekam_medis));

	        #detil
			$data['detil_diagnosis'] = $this->m_detail_diagnosa->get(array('detail_diagnosa.id_rekam_medis' => $id_rekam_medis));
			$data['detil_tindakan'] = $this->m_detail_tindakan->get(array('detail_tindakan.id_rekam_medis' => $id_rekam_medis));
			$data['detil_terapi'] = $this->m_detail_terapi->get(array('detail_terapi.id_rekam_medis' => $id_rekam_medis));
			$data['resep_obat'] = $this->m_resep_obat->get(array('resep_obat.id_rekam_medis' => $id_rekam_medis));
			$data['hasil_lab'] = $this->m_hasil_lab->get(array('hasil_lab.id_rekam_medis' => $id_rekam_medis));
	        
	        $this->load->view('layout', $data);
		} else {
			$this->session->set_flashdata('pesan', '<strong>Gagal!</strong> Proses pembayaran gagal dilakukan.');
			redirect('pembayaran');
		}
	}
	public function ubah_resep()
	{
		$rekam_medis = $this->input->post('rekam_medis');
		$no_resep = $this->input->post('editkode');
		$kuantitas = $this->input->post('editkuantitas');

		$resep_obat = $this->m_resep_obat->get(array('resep_obat.no_resep' => $no_resep, 'resep_obat.id_rekam_medis' => $rekam_medis));
		if (count($resep_obat) > 0) {
			$sub_total = $kuantitas * $resep_obat[0]->HRG_OBAT;
			$this->m_resep_obat->patch(
				array('resep_obat.no_resep' => $no_resep, 'resep_obat.id_rekam_medis' => $rekam_medis),
				array('resep_obat.kuantitas_obat' => $kuantitas, 'resep_obat.sub_total_resep' => $sub_total)
				);
		}

		redirect('pembayaran/edit/'.$rekam_medis);
	}

	public function remove_resep($rekam_medis, $no_resep)
	{
		$resep_obat = $this->m_resep_obat->get(array('resep_obat.no_resep' => $no_resep, 'resep_obat.id_rekam_medis' => $rekam_medis));
		if (count($resep_obat) > 0) {
			$sub_total = $kuantitas * $resep_obat[0]->HRG_OBAT;
			$this->m_resep_obat->remove(array('resep_obat.no_resep' => $no_resep, 'resep_obat.id_rekam_medis' => $rekam_medis));
		}

		redirect('pembayaran/edit/'.$rekam_medis);
	}

	public function simpan()
	{
		$id_bayar = $this->input->post('txt_id_bayar');
		$id_rekam_medis = $this->input->post('txt_rekam_medis');
		$uang_bayar = $this->input->post('txt_bayar');
		$total_bayar = $this->input->post('txt_total');

		$act = $this->m_pembayaran->patch(
			array('pembayaran.id_bayar' => $id_bayar),
			array(
				'pembayaran.tgl_bayar' => date('Y-m-d'),
				'pembayaran.uang_bayar' => $uang_bayar,
				'pembayaran.total_bayar' => $total_bayar
				)
			);

		if ($act > 0) 
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Pembayaran telah disimpan');
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Pembayaran gagal disimpan.');

        redirect('pembayaran/edit/'.$id_rekam_medis);
	}

	public function cetak($id_rekam_medis)
	{
		$pembayaran = $this->m_pembayaran->get(array('pembayaran.id_rekam_medis' => $id_rekam_medis));

        $data['judul'] = 'Biaya Pemeriksaan';
        
        $data['pembayaran'] = $pembayaran;
        $data['rekam_medis'] = $this->m_rekam_medis->get(array('rekam_medis.id_rekam_medis' => $id_rekam_medis));

        #detil
		$data['detil_diagnosis'] = $this->m_detail_diagnosa->get(array('detail_diagnosa.id_rekam_medis' => $id_rekam_medis));
		$data['detil_tindakan'] = $this->m_detail_tindakan->get(array('detail_tindakan.id_rekam_medis' => $id_rekam_medis));
		$data['detil_terapi'] = $this->m_detail_terapi->get(array('detail_terapi.id_rekam_medis' => $id_rekam_medis));
		$data['resep_obat'] = $this->m_resep_obat->get(array('resep_obat.id_rekam_medis' => $id_rekam_medis));
		$data['hasil_lab'] = $this->m_hasil_lab->get(array('hasil_lab.id_rekam_medis' => $id_rekam_medis));
        
        $this->load->view('laporan/pembayaran_pemeriksaan', $data);
        // $this->pdfgenerator->generate('laporan/pembayaran_pemeriksaan', 'pembayaran_'.$id_rekam_medis, 'portrait', 'a5', $data);
	}
}
?>
<?php  
/**
* 
*/
class Rekam_Medis extends CI_Controller
{
	
	public function index()
	{
		date_default_timezone_set("Asia/Jakarta");
		$this->m_security->check();
		$data['aktif'] = "transaksi";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Pencatatan Rekam Medis");
		$data['judul'] = "Pencatatan Rekam Medis";
		$data['konten'] = "transaksi/daftar_antrian_dokter";

		$dokter = $this->m_dokter->get(array('dokter.id_dokter' => $_SESSION['userid']));

		if (count($dokter) > 0) {
			$data['antrian'] = $this->m_antrian->get(array(
				'tgl_antrian' => date('Y-m-d'),
				'antrian.id_poli' => $dokter[0]->ID_POLI
				));
		} else {
			$data['antrian'] = null;
		}
		
		$this->load->view('layout', $data);
	}

	public function get()
	{
		$id_rekam_medis = $this->input->post('id_rekam_medis');
		$is_cetak = $this->input->post('is_cetak');

		$rekam_medis = $this->m_rekam_medis->get(array('rekam_medis.id_rekam_medis' => $id_rekam_medis));
		$diagnosa = $this->m_detail_diagnosa->get(array('rekam_medis.id_rekam_medis' => $id_rekam_medis));
		$tindakan = $this->m_detail_tindakan->get(array('rekam_medis.id_rekam_medis' => $id_rekam_medis));
		$terapi = $this->m_detail_terapi->get(array('rekam_medis.id_rekam_medis' => $id_rekam_medis));
		$resep_obat = $this->m_resep_obat->get(array('rekam_medis.id_rekam_medis' => $id_rekam_medis));
		$hasil_lab = $this->m_hasil_lab->get(array('rekam_medis.id_rekam_medis' => $id_rekam_medis));
		$pasien = $this->m_pasien->get(array('pasien.id_pasien' => $rekam_medis[0]->ID_PASIEN));

		echo "<!DOCTYPE html>
		<html>
		<head>
			<title>Rekam Medis Pasien</title>
		</head>
		<body ";
		if ($is_cetak == 'ya') {
			echo "onload='javascript:window.print();'";
		}
		echo ">";
		
		$hasil = "<div style='text-align: center;'><h3>Hasil Pemeriksaan</h3></div>";

		$hasil .= "<h4>Biodata Pasien:</h4>";
		foreach ($pasien as $pas) {
			$pas_array = get_object_vars($pas);
			foreach ($pas as $key => $value) {
				$hasil .= "<strong>".str_replace('_', " ", $key).":</strong> ".$value."<br>";
			}
		}
		
		$hasil .= "<h4>Pemeriksaan:</h4>";
		foreach ($rekam_medis as $rm) {
			$hasil .= "<strong>Tanggal Pemeriksaan:</strong> ".date('d-m-Y', strtotime($rm->TGL_PERIKSA))."<br>";
			$hasil .= "<strong>Keluhan:</strong> ".$rm->ANAMNESIS."<br><strong>Catatan Fisik:</strong> ".$rm->CTTN_FISIK."<br><br>";
		}

		if (count($diagnosa) > 0) {
			$hasil .= "<h4>Diagnosa:</h4>";
			foreach ($diagnosa as $dg) {
				$hasil .= $dg->NM_ICD_10."; ";
			}
		}

		if (count($tindakan) > 0) {
			$hasil .= "<h4>Tindakan:</h4>";
			foreach ($tindakan as $td) {
				$hasil .= $td->NM_ICD_9.'; ';
			}
		}

		if (count($terapi) > 0) {
			$hasil .= "<h4>Terapi:</h4>";
			foreach ($terapi as $ter) {
				$hasil .= $ter->NM_TERAPI.'; ';
			}
		}

		if (count($resep_obat) > 0) {
			$hasil .= "<h4>Resep Obat:</h4>";
			foreach ($resep_obat as $ro) {
				$hasil .= $ro->NM_OBAT.' ('.$ro->KUANTITAS_OBAT.")<br>";
			}
		}

		if (count($hasil_lab) > 0 && $is_cetak != "ya") {
			$hasil .= "<h4>Hasil Lab:</h4>";
			foreach ($hasil_lab as $hl) {
				$hasil .= "<a href='".base_url()."/assets/images/hasil_lab/".$hl->FILE_HASIL."' target='_blank'>".$hl->FILE_HASIL."</a><br>";
			}
		}

		echo $hasil;

		if($is_cetak != 'ya') {
			echo '<br><form method="post" target="_blank" action="'.base_url().'rekam_medis/get">
        <input type="hidden" name="id_rekam_medis" value="'.$id_rekam_medis.'">
        <input type="hidden" name="is_cetak" value="ya">
        <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Cetak</button>
    </form>';
		}
		echo "</body></html>";
	}

	public function push($id, $pasien, $poli)
	{
		date_default_timezone_set("Asia/Jakarta");
		$this->m_antrian->patch(
			array(
				'antrian.id_antrian' => $id,
				'antrian.id_pasien' => $pasien,
				'antrian.id_poli' => $poli,
				'antrian.tgl_antrian' => date('Y-m-d')
				), 
			array('antrian.status_antrian' => 'Sedang Berlangsung'));
		$_SESSION['antrian_in_proses'] = $id;
        
        redirect('rekam_medis');
	}

	public function pre_proses($id_pasien, $id_poli, $tgl_antri)
	{
		date_default_timezone_set("Asia/Jakarta");
		$tgl_periksa = date('Y-m-d', $tgl_antri);
		$cek_rekam_medis = $this->m_rekam_medis->get(array(
			'rekam_medis.id_pasien' => $id_pasien,
			'rekam_medis.id_dokter' => $_SESSION['userid'],
			'rekam_medis.tgl_periksa' => $tgl_periksa 
			));
		if (count($cek_rekam_medis) > 0) {
			$id_rekam_medis = $cek_rekam_medis[0]->ID_REKAM_MEDIS;
		} else {
			# insert into rekam_medis
			$id_rekam_medis = $this->m_security->gen_ai_id('rekam_medis', 'id_rekam_medis');
			$this->m_rekam_medis->create(array(
				'id_rekam_medis' => $id_rekam_medis,
				'id_pasien' => $id_pasien,
				'id_dokter' => $_SESSION['userid'],
				'tgl_periksa' => $tgl_periksa
				));
		}
		
		redirect('rekam_medis/proses/'.$id_rekam_medis);
	}

	public function proses($id_rekam_medis)
	{
		$this->m_security->check();
		$data['aktif'] = "transaksi";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Pencatatan Rekam Medis");
		$data['judul'] = "Pemeriksaan Pasien";
		$data['konten'] = "transaksi/rekam_medis_pasien";

		$rekam_medis = $this->m_rekam_medis->get(array('id_rekam_medis' => $id_rekam_medis));
		$data['rekam_medis'] = $rekam_medis;
		if (count($rekam_medis) > 0) 
			$data['history_rekam_medis'] = $this->m_rekam_medis->get(array('rekam_medis.id_pasien' => $rekam_medis[0]->ID_PASIEN));

		$id_dokter = $_SESSION['userid'];
		$data['is_odontogram'] = false;
		$dokter = $this->m_dokter->get(array('dokter.id_dokter' => $id_dokter));
		if(count($dokter) > 0) {
			if(strpos(strtolower($dokter[0]->NM_POLI), 'gigi') !== false)
				$data['is_odontogram'] = true;
		}
		$data['dokter'] = $dokter;
		$data['pasien'] = $this->m_pasien->get(array('id_pasien' => $rekam_medis[0]->ID_PASIEN));

		#detil
		$arr_detil_diagnosis = array();
		$detil_diagnosis = $this->m_detail_diagnosa->get(array('detail_diagnosa.id_rekam_medis' => $id_rekam_medis));
		foreach ($detil_diagnosis as $diagnosa) {
			array_push($arr_detil_diagnosis, $diagnosa->KODE_ICD_10);
		}
		$data['detil_diagnosis'] = $arr_detil_diagnosis;

		$arr_detil_tindakan = array();
		$detil_tindakan = $this->m_detail_tindakan->get(array('detail_tindakan.id_rekam_medis' => $id_rekam_medis));
		foreach ($detil_tindakan as $tindakan) {
			array_push($arr_detil_tindakan, $tindakan->KODE_ICD_9);
		}
		$data['detil_tindakan'] = $arr_detil_tindakan;

		$arr_detil_terapi = array();
		$detil_terapi = $this->m_detail_terapi->get(array('detail_terapi.id_rekam_medis' => $id_rekam_medis));
		foreach ($detil_terapi as $terapi) {
			array_push($arr_detil_terapi, $terapi->ID_TERAPI);
		}
		$data['detil_terapi'] = $arr_detil_terapi;

		$arr_hasil_lab = array();
		$hasil_lab = $this->m_hasil_lab->get(array('hasil_lab.id_rekam_medis' => $id_rekam_medis));
		foreach ($hasil_lab as $lab) {
			array_push($arr_hasil_lab, $lab->ID_LAB);
		}
		$data['hasil_lab'] = $arr_hasil_lab;

		$perawat_terapi = $this->m_security->query("select distinct ID_PERAWAT 
			from detail_terapi where id_rekam_medis = '".$id_rekam_medis."'");
		$data['perawat_terapi'] = count($perawat_terapi)>0?$perawat_terapi[0]->ID_PERAWAT:null;

		$data['resep_obat'] = $this->m_resep_obat->get(array('resep_obat.id_rekam_medis' => $id_rekam_medis));
		$odontogram = $this->m_odontogram->get(array('odontogram.id_rekam_medis' => $id_rekam_medis));
		$data_odontogram = array();
		foreach ($odontogram as $odo) 
			$data_odontogram[$odo->NOMOR] = $odo->GAMBAR;
		$data['odontogram'] = $data_odontogram;

		$data['pemeriksaan_lab'] = $this->m_pemeriksaan_lab->get(array('pemeriksaan_lab.id_poli' => $dokter[0]->ID_POLI));
		$data['diagnosis'] = $this->m_diagnosa_icd_10->get(array('diagnosa_icd_10.id_poli' => $dokter[0]->ID_POLI));
		$data['tindakan'] = $this->m_tindakan_icd_9->get(array('tindakan_icd_9.id_poli' => $dokter[0]->ID_POLI));
		$data['terapi'] = $this->m_terapi->get(array('terapi.id_poli' => $dokter[0]->ID_POLI));
		$data['obat'] = $this->m_obat->get(array());
		$data['perawat'] = $this->m_perawat->get(array('perawat.id_poli' => $dokter[0]->ID_POLI));
		$data['status_gigi'] = $this->m_status_gigi->get(array());

		$this->load->view('layout', $data);
	}

	public function cancel_proses($id, $pasien, $poli)
	{		
		$this->m_antrian->patch(
			array(
				'antrian.id_antrian' => $id,
				'antrian.id_pasien' => $pasien,
				'antrian.id_poli' => $poli,
				'antrian.tgl_antrian' => date('Y-m-d')
				), 
			array('antrian.status_antrian' => 'Batal'));
        unset($_SESSION['antrian_in_proses']);

        redirect('rekam_medis');
	}

	public function close_proses($id_pasien)
	{
		date_default_timezone_set("Asia/Jakarta");
		$dokter = $this->m_dokter->get(array('dokter.id_dokter' => $_SESSION['userid']));

		if (count($dokter) > 0) {
			$this->m_antrian->patch(
				array(
					'antrian.id_pasien' => $id_pasien,
					'antrian.id_poli' => $dokter[0]->ID_POLI,
					'antrian.tgl_antrian' => date('Y-m-d')
					), 
				array('antrian.status_antrian' => 'Selesai')
				);
	    	unset($_SESSION['antrian_in_proses']);
		}

        redirect('rekam_medis');
	}

	public function update($rekam_medis)
	{
		$anamnesis = $this->input->post('keluhan');
		$catatan = $this->input->post('catatan_fisik');

		$this->m_rekam_medis->patch(
			array('id_rekam_medis' => $rekam_medis), 
			array('anamnesis' => $anamnesis, 'catatan_fisik' => $catatan)
			);

		$lab = $this->input->post('lab');
		if($lab != null) {
			$this->m_hasil_lab->create(array(
					'id_rekam_medis' => $rekam_medis,
					'id_lab' => $lab
				));
		}

		redirect('rekam_medis/proses/'.$rekam_medis);
	}

	public function record()
	{
		date_default_timezone_set("Asia/Jakarta");

		$diagnosis = $this->input->post('diagnosis');
		$tindakan = $this->input->post('tindakan');
		$terapi = $this->input->post('terapi');
		$perawat = $this->input->post('perawat_terapi');
		$lab = $this->input->post('lab');

		$id_rekam_medis = $this->input->post('id_rekam_medis');
		$id_pasien = $this->input->post('id_pasien');
		$id_dokter = $this->input->post('id_dokter');

		# diagnosis
		$this->m_detail_diagnosa->remove(array('detail_diagnosa.id_rekam_medis' => $id_rekam_medis));
		foreach ($diagnosis as $d) {
			$this->m_detail_diagnosa->create(array(
				'id_rekam_medis' => $id_rekam_medis,
				'id_dokter' => $id_dokter,
				'id_pasien' => $id_pasien,
				'kode_icd_10' => $d
				));
		}

		# tindakan
		$this->m_detail_tindakan->remove(array('detail_tindakan.id_rekam_medis' => $id_rekam_medis));
		foreach ($tindakan as $td) {
			$tind = $this->m_tindakan_icd_9->get(array('tindakan_icd_9.kode_icd_9' => $td));
			if(count($tind) > 0) {
				$this->m_detail_tindakan->create(array(
					'id_rekam_medis' => $id_rekam_medis,
					'id_dokter' => $id_dokter,
					'id_pasien' => $id_pasien,
					'kode_icd_9' => $tind[0]->KODE_ICD_9,
					'bayar_tindakan' => $tind[0]->HARGA_TINDAKAN
					));
			}
		}

		# terapi
		$this->m_detail_terapi->remove(array('detail_terapi.id_rekam_medis' => $id_rekam_medis));
		foreach ($terapi as $tr) {
			$ter = $this->m_terapi->get(array('terapi.id_terapi' => $tr));
			if(count($ter) > 0) {
				$this->m_detail_terapi->create(array(
					'id_rekam_medis' => $id_rekam_medis,
					'id_dokter' => $id_dokter,
					'id_pasien' => $id_pasien,
					'id_terapi' => $ter[0]->ID_TERAPI,
					'id_perawat' => $perawat,
					'bayar_terapi' => $ter[0]->HARGA_TERAPI
					));
			}
		}

		# lab 
		$this->m_hasil_lab->remove(array('hasil_lab.id_rekam_medis' => $id_rekam_medis));
		foreach ($lab as $l) {
			$this->m_hasil_lab->create(array(
				'id_rekam_medis' => $id_rekam_medis,
				'id_dokter' => $id_dokter,
				'id_pasien' => $id_pasien,
				'id_lab' => $l,
				));
		}

		$dokter = $this->m_dokter->get(array('dokter.id_dokter' => $id_dokter));

		if (count($dokter) > 0) {
			$this->m_antrian->patch(
				array(
					'antrian.id_pasien' => $id_pasien,
					'antrian.id_poli' => $dokter[0]->ID_POLI,
					'antrian.tgl_antrian' => date('Y-m-d')
					), 
				array('antrian.status_antrian' => 'Selesai')
				);
	    	unset($_SESSION['antrian_in_proses']);
		}

        redirect('rekam_medis');
	}

	public function set_anamnesis()
	{
		$id_rekam_medis = $this->input->post('id_rekam_medis');
		$anamnesis = $this->input->post('anamnesis');

		$act = $this->m_rekam_medis->patch(
			array('rekam_medis.id_rekam_medis' => $id_rekam_medis),
			array('rekam_medis.anamnesis' => $anamnesis)
			);

		if ($act > 0) 
			echo "sukses";
		else
			echo "gagal";
	}

	public function set_catatan_fisik()
	{
		$id_rekam_medis = $this->input->post('id_rekam_medis');
		$catatan = $this->input->post('catatan');

		$act = $this->m_rekam_medis->patch(
			array('rekam_medis.id_rekam_medis' => $id_rekam_medis),
			array('rekam_medis.cttn_fisik' => $catatan)
			);

		if ($act > 0) 
			echo "sukses";
		else
			echo "gagal";
	}
}
?>
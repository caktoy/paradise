<?php  
/**
* 
*/
class Laporan extends CI_Controller
{
	public function test()
	{
		$data['data'] = "Test";
		$this->pdfgenerator->generate('laporan/test', 'test_'.date('dmY'), 'potrait', 'a4', $data);
	}

	public function kunjungan_pasien($act = null)
	{
		switch ($act) {
			case 'cetak':
				# action untuk cetak jadi pdf
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');

				$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 
					'Agustus', 'September', 'Oktober', 'November', 'Desember');

		        $data['judul'] = 'Laporan Kunjungan Pasien';
		        $data['subjudul'] = 'Periode '.$nama_bulan[$bulan - 1].' '.$tahun;
		        $data['data'] = $this->m_rekam_medis->get(array(
		        	'month(rekam_medis.tgl_periksa)' => $bulan,
		        	'year(rekam_medis.tgl_periksa)' => $tahun
		        	));
		        
		        $this->pdfgenerator->generate('laporan/kunjungan_pasien_lihat', 
		        	'kunjungan_pasien_'.$nama_bulan[$$bulan - 1].' '.$tahun, 'portrait', 'a4', $data);
				break;

			case 'lihat':
				# menampilkan preview laporan
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');

				$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 
					'Agustus', 'September', 'Oktober', 'November', 'Desember');

				$data['aktif'] = 'laporan';
		        $data['judul'] = 'Laporan Kunjungan Pasien';
		        $data['subjudul'] = 'Periode '.$nama_bulan[$bulan - 1].' '.$tahun;
		        $data['konten'] = 'laporan/kunjungan_pasien_lihat';
		        $data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Kunjungan Pasien");
		        $data['bulan'] = $bulan;
		        $data['tahun'] = $tahun;
				$data['data'] = $this->m_rekam_medis->get(array(
		        	'month(rekam_medis.tgl_periksa)' => $bulan,
		        	'year(rekam_medis.tgl_periksa)' => $tahun
		        	));
		        $data['cetak'] = base_url().'laporan/kunjungan_pasien/cetak';

		        $this->load->view('layout', $data);
				break;
			
			default:
				$data['aktif'] = "laporan";
				$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Kunjungan Pasien");
				$data['judul'] = "Laporan Kunjungan Pasien";
				$data['konten'] = "laporan/kunjungan_pasien";
				
				$this->load->view('layout', $data);
				break;
		}
	}

	public function registrasi_pasien($act = null)
	{
		switch ($act) {
			case 'cetak':
				# action untuk cetak jadi pdf
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');

				$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 
					'Agustus', 'September', 'Oktober', 'November', 'Desember');

		        $data['judul'] = 'Laporan Registrasi Pasien Baru';
		        $data['subjudul'] = 'Periode Bulan '.$nama_bulan[$bulan - 1].' '.$tahun;
		        $data['data'] = $this->m_pasien->get(array(
		        	'month(pasien.tgl_daftar)' => $bulan,
		        	'year(pasien.tgl_daftar)' => $tahun
		        	));
		        
		        $this->pdfgenerator->generate('laporan/registrasi_pasien_lihat', 'registrasi_pasien_'.$nama_bulan[$bulan - 1].'_'.$tahun, 'portrait', 'a4', $data);
				break;

			case 'lihat':
				# menampilkan preview laporan
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');

				$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 
					'Agustus', 'September', 'Oktober', 'November', 'Desember');

				$data['aktif'] = 'laporan';
		        $data['judul'] = 'Laporan Registrasi Pasien Baru';
		        $data['subjudul'] = 'Periode Bulan '.$nama_bulan[$bulan - 1].' '.$tahun;
		        $data['konten'] = 'laporan/registrasi_pasien_lihat';
		        $data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Registrasi Pasien Baru");
		        $data['bulan'] = $bulan;
		        $data['tahun'] = $tahun;
				$data['data'] = $this->m_pasien->get(array(
		        	'month(pasien.tgl_daftar)' => $bulan,
		        	'year(pasien.tgl_daftar)' => $tahun
		        	));
		        $data['cetak'] = base_url().'laporan/registrasi_pasien/cetak';

		        $this->load->view('layout', $data);
				break;
			
			default:
				$data['aktif'] = "laporan";
				$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Registrasi Pasien Baru");
				$data['judul'] = "Laporan Registrasi Pasien Baru";
				$data['konten'] = "laporan/registrasi_pasien";
				
				$this->load->view('layout', $data);
				break;
		}
	}

	public function penyakit_terbanyak($act = null)
	{
		switch ($act) {
			case 'cetak':
				# action untuk cetak jadi pdf
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');

				$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 
					'Agustus', 'September', 'Oktober', 'November', 'Desember');

		        $data['judul'] = 'Laporan Penyakit Terbanyak';
		        $data['subjudul'] = 'Periode Bulan '.$nama_bulan[$bulan - 1].' '.$tahun;
		        $data['data'] = $this->m_security->custom("select diagnosa_icd_10.KODE_ICD_10, diagnosa_icd_10.NM_ICD_10, count(*) as JUMLAH 
		        	from rekam_medis
		        	left join detail_diagnosa on rekam_medis.id_rekam_medis = detail_diagnosa.id_rekam_medis
		        	left join diagnosa_icd_10 on detail_diagnosa.kode_icd_10 = diagnosa_icd_10.kode_icd_10
		        	where month(rekam_medis.tgl_periksa) = '".$bulan."' and year(month.tgl_periksa) = '".$tahun."'
		        	group by diagnosa_icd_10.KODE_ICD_10, diagnosa_icd_10.NM_ICD_10");
		        
		        $this->pdfgenerator->generate('laporan/penyakit_terbanyak_lihat', 'penyakit_terbanyak_'.$nama_bulan[$bulan - 1].'_'.$tahun, 'portrait', 'a4', $data);
				break;

			case 'lihat':
				# menampilkan preview laporan
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');

				$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 
					'Agustus', 'September', 'Oktober', 'November', 'Desember');

				$data['aktif'] = 'laporan';
		        $data['judul'] = 'Laporan Registrasi Pasien Baru';
		        $data['subjudul'] = 'Periode Bulan '.$nama_bulan[$bulan - 1].' '.$tahun;
		        $data['konten'] = 'laporan/penyakit_terbanyak_lihat';
		        $data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Registrasi Pasien Baru");
		        $data['bulan'] = $bulan;
		        $data['tahun'] = $tahun;
				$data['data'] = $this->m_security->query("select diagnosa_icd_10.KODE_ICD_10, diagnosa_icd_10.NM_ICD_10, count(*) as JUMLAH 
		        	from rekam_medis
		        	left join detail_diagnosa on rekam_medis.id_rekam_medis = detail_diagnosa.id_rekam_medis
		        	left join diagnosa_icd_10 on detail_diagnosa.kode_icd_10 = diagnosa_icd_10.kode_icd_10
		        	where month(rekam_medis.tgl_periksa) = '".$bulan."' and year(rekam_medis.tgl_periksa) = '".$tahun."'
		        	group by diagnosa_icd_10.KODE_ICD_10, diagnosa_icd_10.NM_ICD_10");
		        $data['cetak'] = base_url().'laporan/penyakit_terbanyak/cetak';

		        $this->load->view('layout', $data);
				break;
			
			default:
				$data['aktif'] = "laporan";
				$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Penyakit Terbanyak");
				$data['judul'] = "Laporan Penyakit Terbanyak";
				$data['konten'] = "laporan/penyakit_terbanyak";
				
				$this->load->view('layout', $data);
				break;
		}
	}

	public function rekam_medis_pasien($act = null, $id = null)
	{
		switch ($act) {
			case 'cetak':
				# action untuk cetak jadi pdf
				$id = $this->input->post('id');

				$data['aktif'] = 'laporan';
		        $data['judul'] = 'Laporan Rekam Medis Pasien';
		        $data['konten'] = 'laporan/penyakit_terbanyak_lihat';
		        $data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Rekam Medis Pasien");
				
				$data['id'] = $id;
				$data['data'] = $this->m_rekam_medis->get(array('rekam_medis.id_rekam_medis' => $id));
				$data['diagnosis'] = $this->m_detail_diagnosa->get(array('detail_diagnosa.id_rekam_medis' => $id));
				$data['terapi'] = $this->m_detail_terapi->get(array('detail_terapi.id_rekam_medis' => $id));
				$data['tindakan'] = $this->m_detail_tindakan->get(array('detail_tindakan.id_rekam_medis' => $id));
				$data['lab'] = $this->m_hasil_lab->get(array('hasil_lab.id_rekam_medis' => $id));
				$data['resep_obat'] = $this->m_resep_obat->get(array('resep_obat.id_rekam_medis' => $id));
		        
		        $this->pdfgenerator->generate('laporan/rekam_medis_pasien_lihat', 'rekam_medis_'.$id, 'portrait', 'a4', $data);
				break;

			case 'lihat':
				# menampilkan preview laporan

				$data['aktif'] = 'laporan';
		        $data['judul'] = 'Laporan Rekam Medis Pasien';
		        $data['konten'] = 'laporan/rekam_medis_pasien_lihat';
		        $data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Rekam Medis Pasien");
		        
		        $data['id'] = $id;
				$data['data'] = $this->m_rekam_medis->get(array('rekam_medis.id_rekam_medis' => $id));
				$data['diagnosis'] = $this->m_detail_diagnosa->get(array('detail_diagnosa.id_rekam_medis' => $id));
				$data['terapi'] = $this->m_detail_terapi->get(array('detail_terapi.id_rekam_medis' => $id));
				$data['tindakan'] = $this->m_detail_tindakan->get(array('detail_tindakan.id_rekam_medis' => $id));
				$data['lab'] = $this->m_hasil_lab->get(array('hasil_lab.id_rekam_medis' => $id));
				$data['resep_obat'] = $this->m_resep_obat->get(array('resep_obat.id_rekam_medis' => $id));

		        $data['cetak'] = base_url().'laporan/rekam_medis_pasien/cetak';

		        $this->load->view('layout', $data);
				break;
			
			default:
				$data['aktif'] = "laporan";
				$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Rekam Medis Pasien");
				$data['judul'] = "Laporan Rekam Medis Pasien";
				$data['konten'] = "laporan/rekam_medis_pasien";
				
				$pasien = $this->m_pasien->get(array());
				$data_rekam_medis = array();
				foreach ($pasien as $pas) {
					$id_pasien = $pas->ID_PASIEN;
					$rekam_medis = $this->m_rekam_medis->get(array('rekam_medis.ID_PASIEN' => $id_pasien));
					$row = array('pasien' => $pas, 'rekam_medis' => $rekam_medis);
					array_push($data_rekam_medis, $row);
				}
				$data['data'] = $data_rekam_medis;
				
				$this->load->view('layout', $data);
				break;
		}
	}
}
?>
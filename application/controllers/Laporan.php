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
		        $data['data'] = $this->m_security->query("select * 
		        	from rekam_medis
		        		left join dokter on rekam_medis.id_dokter = dokter.id_dokter 
		        		left join poli on dokter.id_poli = poli.id_poli  
		        		left join pasien on rekam_medis.id_pasien = pasien.id_pasien
		        	where 
		        		month(rekam_medis.tgl_periksa) = '".$bulan."' and 
		        		year(rekam_medis.tgl_periksa) = '".$tahun."'");
		        
		        // $this->pdfgenerator->generate('laporan/kunjungan_pasien_lihat', 'kunjungan_pasien_'.$nama_bulan[$$bulan - 1].' '.$tahun, 'portrait', 'a4', $data);
		        $this->load->view('laporan/kunjungan_pasien_lihat', $data);
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
				
		        $data['data'] = $this->m_security->query("select * 
		        	from rekam_medis
		        		left join dokter on rekam_medis.id_dokter = dokter.id_dokter 
		        		left join poli on dokter.id_poli = poli.id_poli  
		        		left join pasien on rekam_medis.id_pasien = pasien.id_pasien
		        	where 
		        		month(rekam_medis.tgl_periksa) = '".$bulan."' and 
		        		year(rekam_medis.tgl_periksa) = '".$tahun."'");
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
		        
		        // $this->pdfgenerator->generate('laporan/registrasi_pasien_lihat', 'registrasi_pasien_'.$nama_bulan[$bulan - 1].'_'.$tahun, 'portrait', 'a4', $data);
				$this->load->view('laporan/registrasi_pasien_lihat', $data);
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
		        $data['bulan'] = $bulan;
		        $data['tahun'] = $tahun;
		        $data['data'] = $this->m_security->query("select diagnosa_icd_10.KODE_ICD_10, diagnosa_icd_10.NM_ICD_10, count(*) as JUMLAH 
		        	from rekam_medis
		        	left join detail_diagnosa on rekam_medis.id_rekam_medis = detail_diagnosa.id_rekam_medis
		        	left join diagnosa_icd_10 on detail_diagnosa.kode_icd_10 = diagnosa_icd_10.kode_icd_10
		        	where month(rekam_medis.tgl_periksa) = '".$bulan."' and year(rekam_medis.tgl_periksa) = '".$tahun."'
		        	group by diagnosa_icd_10.KODE_ICD_10, diagnosa_icd_10.NM_ICD_10");
		        
		        // $this->pdfgenerator->generate('laporan/penyakit_terbanyak_lihat', 'penyakit_terbanyak_'.$nama_bulan[$bulan - 1].'_'.$tahun, 'portrait', 'a4', $data);
				$this->load->view('laporan/penyakit_terbanyak_lihat', $data);
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

	public function pengeluaran_obat($act = null)
	{
		switch ($act) {
			case 'cetak':
				# action untuk cetak jadi pdf
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');

				$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 
					'Agustus', 'September', 'Oktober', 'November', 'Desember');

		        $data['judul'] = 'Laporan Pengeluaran Obat';
		        $data['subjudul'] = 'Periode Bulan '.$nama_bulan[$bulan - 1].' '.$tahun;
		        
		        $data['data'] = $this->m_security->query("select 
		        	penjualan.*, detail_penjualan.ID_OBAT, obat.NM_OBAT, obat.SATUAN, detail_penjualan.QTY_JUAL, detail_penjualan.SUB_TOTAL 
		        	from penjualan
					inner join detail_penjualan ON detail_penjualan.ID_JUAL = penjualan.ID_JUAL 
					inner join obat ON detail_penjualan.ID_OBAT = obat.ID_OBAT
		        	where 
		        		month(penjualan.tgl_jual) = '".$bulan."' and 
		        		year(penjualan.tgl_jual) = '".$tahun."'");
		        
		        // $this->pdfgenerator->generate('laporan/pengeluaran_obat_lihat', 'pengeluaran_obat_'.$nama_bulan[$bulan - 1].'_'.$tahun, 'portrait', 'a4', $data);
				$this->load->view('laporan/pengeluaran_obat_lihat', $data);
				break;

			case 'lihat':
				# menampilkan preview laporan
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');

				$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 
					'Agustus', 'September', 'Oktober', 'November', 'Desember');

				$data['aktif'] = 'laporan';
		        $data['judul'] = 'Laporan Pengeluaran';
		        $data['subjudul'] = 'Periode Bulan '.$nama_bulan[$bulan - 1].' '.$tahun;
		        $data['konten'] = 'laporan/pengeluaran_obat_lihat';
		        $data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Pengeluaran Obat");
		        $data['bulan'] = $bulan;
		        $data['tahun'] = $tahun;

		        $data['data'] = $this->m_security->query("select 
		        	penjualan.*, detail_penjualan.ID_OBAT, obat.NM_OBAT, obat.SATUAN, detail_penjualan.QTY_JUAL, detail_penjualan.SUB_TOTAL 
		        	from penjualan
					inner join detail_penjualan ON detail_penjualan.ID_JUAL = penjualan.ID_JUAL 
					inner join obat ON detail_penjualan.ID_OBAT = obat.ID_OBAT
		        	where 
		        		month(penjualan.tgl_jual) = '".$bulan."' and 
		        		year(penjualan.tgl_jual) = '".$tahun."'");
		        $data['cetak'] = base_url().'laporan/pengeluaran_obat/cetak';

		        $this->load->view('layout', $data);
				break;
			
			default:
				$data['aktif'] = "laporan";
				$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Pengeluaran Obat");
				$data['judul'] = "Laporan Pengeluaran Obat";
				$data['konten'] = "laporan/pengeluaran_obat";
				
				$this->load->view('layout', $data);
				break;
		}
	}

	public function pendapatan($act = null)
	{
		switch ($act) {
			case 'cetak':
				# action untuk cetak jadi pdf
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');

				$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 
					'Agustus', 'September', 'Oktober', 'November', 'Desember');

		        $data['judul'] = 'Laporan Pendapatan';
		        $data['subjudul'] = 'Periode Bulan '.$nama_bulan[$bulan - 1].' '.$tahun;
		        
		        $data['data_tindakan'] = $this->m_detail_tindakan->get(array(
		        	'month(rekam_medis.tgl_periksa)' => $bulan,
		        	'year(rekam_medis.tgl_periksa)' => $tahun
		        	));
				$data['data_lab'] = $this->m_hasil_lab->get(array(
		        	'month(rekam_medis.tgl_periksa)' => $bulan,
		        	'year(rekam_medis.tgl_periksa)' => $tahun
		        	));
				$data['data_terapi'] = $this->m_detail_terapi->get(array(
		        	'month(rekam_medis.tgl_periksa)' => $bulan,
		        	'year(rekam_medis.tgl_periksa)' => $tahun
		        	));
				$data['data_obat'] = $this->m_detail_penjualan->get(array(
		        	'month(penjualan.tgl_jual)' => $bulan,
		        	'year(penjualan.tgl_jual)' => $tahun
		        	));
		        
		        // $this->pdfgenerator->generate('laporan/pendapatan_lihat', 'pengeluaran_obat_'.$nama_bulan[$bulan - 1].'_'.$tahun, 'portrait', 'a4', $data);
				$this->load->view('laporan/pendapatan_lihat', $data);
				break;

			case 'lihat':
				# menampilkan preview laporan
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');

				$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 
					'Agustus', 'September', 'Oktober', 'November', 'Desember');

				$data['aktif'] = 'laporan';
		        $data['judul'] = 'Laporan Pendapatan';
		        $data['subjudul'] = 'Periode Bulan '.$nama_bulan[$bulan - 1].' '.$tahun;
		        $data['konten'] = 'laporan/pendapatan_lihat';
		        $data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Pendapatan");
		        $data['bulan'] = $bulan;
		        $data['tahun'] = $tahun;

				$data['data_tindakan'] = $this->m_detail_tindakan->get(array(
		        	'month(rekam_medis.tgl_periksa)' => $bulan,
		        	'year(rekam_medis.tgl_periksa)' => $tahun
		        	));
				$data['data_lab'] = $this->m_hasil_lab->get(array(
		        	'month(rekam_medis.tgl_periksa)' => $bulan,
		        	'year(rekam_medis.tgl_periksa)' => $tahun
		        	));
				$data['data_terapi'] = $this->m_detail_terapi->get(array(
		        	'month(rekam_medis.tgl_periksa)' => $bulan,
		        	'year(rekam_medis.tgl_periksa)' => $tahun
		        	));
				$data['data_obat'] = $this->m_detail_penjualan->get(array(
		        	'month(penjualan.tgl_jual)' => $bulan,
		        	'year(penjualan.tgl_jual)' => $tahun
		        	));

		        $data['cetak'] = base_url().'laporan/pendapatan/cetak';

		        $this->load->view('layout', $data);
				break;
			
			default:
				$data['aktif'] = "laporan";
				$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Pendapatan");
				$data['judul'] = "Laporan Pendapatan";
				$data['konten'] = "laporan/pendapatan";
				
				$this->load->view('layout', $data);
				break;
		}
	}

	public function kunjungan_per_dokter($act = null)
	{
		switch ($act) {
			case 'cetak':
				# action untuk cetak jadi pdf
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');

				$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 
					'Agustus', 'September', 'Oktober', 'November', 'Desember');

		        $data['judul'] = 'Laporan Kunjungan Pasien per Dokter';
		        $data['subjudul'] = 'Dokter: '.$_SESSION['username'].'<br>Periode '.$nama_bulan[$bulan - 1].' '.$tahun;
		        $data['data'] = $this->m_security->query("select * 
		        	from rekam_medis
		        		left join dokter on rekam_medis.id_dokter = dokter.id_dokter 
		        		left join poli on dokter.id_poli = poli.id_poli  
		        		left join pasien on rekam_medis.id_pasien = pasien.id_pasien
		        	where 
		        		month(rekam_medis.tgl_periksa) = '".$bulan."' and 
		        		year(rekam_medis.tgl_periksa) = '".$tahun."' and 
		        		rekam_medis.id_dokter = '".$_SESSION['userid']."'");
		        
		        $this->load->view('laporan/kunjungan_pasien_lihat', $data);
				break;

			case 'lihat':
				# menampilkan preview laporan
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');

				$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 
					'Agustus', 'September', 'Oktober', 'November', 'Desember');

				$data['aktif'] = 'laporan';
		        $data['judul'] = 'Laporan Kunjungan Pasien per Dokter';
		        $data['subjudul'] = 'Dokter: '.$_SESSION['username'].'<br>Periode '.$nama_bulan[$bulan - 1].' '.$tahun;
		        $data['konten'] = 'laporan/kunjungan_pasien_lihat';
		        $data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Kunjungan Pasien");
		        $data['bulan'] = $bulan;
		        $data['tahun'] = $tahun;
				
		        $data['data'] = $this->m_security->query("select * 
		        	from rekam_medis
		        		left join dokter on rekam_medis.id_dokter = dokter.id_dokter 
		        		left join poli on dokter.id_poli = poli.id_poli  
		        		left join pasien on rekam_medis.id_pasien = pasien.id_pasien
		        	where 
		        		month(rekam_medis.tgl_periksa) = '".$bulan."' and 
		        		year(rekam_medis.tgl_periksa) = '".$tahun."' and 
		        		rekam_medis.id_dokter = '".$_SESSION['userid']."'");
		        $data['cetak'] = base_url().'laporan/kunjungan_per_dokter/cetak';

		        $this->load->view('layout', $data);
				break;
			
			default:
				$data['aktif'] = "laporan";
				$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Laporan", "Laporan Kunjungan per Dokter");
				$data['judul'] = "Laporan Kunjungan per Dokter";
				$data['konten'] = "laporan/kunjungan_per_dokter";
				
				$this->load->view('layout', $data);
				break;
		}
	}

	public function history_rekam_medis($id_pasien)
	{
		$pasien = $this->m_pasien->get(array('pasien.id_pasien' => $id_pasien));
        
        $data['judul'] = 'History Rekam Medis Pasien';
        $data['subjudul'] = 'Pasien: '.$pasien[0]->NM_PASIEN;

        $arr_data = array();
        $rekam_medis = $this->m_rekam_medis->get(array('rekam_medis.id_pasien' => $id_pasien));
        foreach ($rekam_medis as $rm) {
        	$arr_data1['tgl_periksa'] = $rm->TGL_PERIKSA;
        	$arr_data1['dokter'] = $rm->NM_DOKTER;
        	$arr_data1['anamnesis'] = $rm->ANAMNESIS;
        	$arr_data1['diagnosa'] = $this->m_detail_diagnosa->get(array('detail_diagnosa.id_rekam_medis' => $rm->ID_REKAM_MEDIS));
        	$arr_data1['tindakan'] = $this->m_detail_tindakan->get(array('detail_tindakan.id_rekam_medis' => $rm->ID_REKAM_MEDIS));
        	$arr_data1['terapi'] = $this->m_detail_terapi->get(array('detail_terapi.id_rekam_medis' => $rm->ID_REKAM_MEDIS));
        	$arr_data1['resep_obat'] = $this->m_detail_resep_obat->get(array('resep_obat.id_rekam_medis' => $rm->ID_REKAM_MEDIS));

        	array_push($arr_data, $arr_data1);
        }
        $data['data'] = $arr_data;
        
        $this->load->view('laporan/history_rm_pasien', $data);
	}
}
?>
<?php  
/**
* 
*/
class Antrian extends CI_Controller
{

	public function display()
	{
		date_default_timezone_set("Asia/Jakarta");
		$data['aktif'] = "transaksi";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Transaksi", "Display Antrian");
		$data['judul'] = "Klinik Paradise";
		$data['poli'] = $this->m_poli->get(array());

		$this->load->view('transaksi/display_antrian', $data);
	}

	public function get_antrian()
	{
		date_default_timezone_set("Asia/Jakarta");
		$data_antrian = array();
		$poli = $this->m_poli->get(array());
		foreach ($poli as $p) {
			$id_poli = $p->ID_POLI;
			$nm_poli = $p->NM_POLI;
			$antrian = $this->m_antrian->get(array(
				'antrian.tgl_antrian' => date('Y-m-d'),
				'antrian.id_poli' => $id_poli,
				'antrian.status_antrian' => 'Sedang Berlangsung'
				), 1);
			if (count($antrian) > 0) {
				array_push($data_antrian, $antrian[0]);
			}
		}
        header("Content-Type: application/json");
        echo json_encode($data_antrian);
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
        
        redirect('registrasi_pemeriksaan');
	}

	public function cancel($id, $pasien, $poli)
	{		
		date_default_timezone_set("Asia/Jakarta");
		$this->m_antrian->patch(
			array(
				'antrian.id_antrian' => $id,
				'antrian.id_pasien' => $pasien,
				'antrian.id_poli' => $poli,
				'antrian.tgl_antrian' => date('Y-m-d')
				), 
			array('antrian.status_antrian' => 'Batal'));
        // $this->call_next_from($id, $poli);
        unset($_SESSION['antrian_in_proses']);

        redirect('registrasi_pemeriksaan');
	}

	public function done($id, $pasien, $poli)
	{
		date_default_timezone_set("Asia/Jakarta");
		$this->m_antrian->patch(
			array(
				'antrian.id_antrian' => $id,
				'antrian.id_pasien' => $pasien,
				'antrian.id_poli' => $poli,
				'antrian.tgl_antrian' => date('Y-m-d')
				), 
			array('antrian.status_antrian' => 'Selesai')
			);
    	$this->call_next_from($id, $poli);
    	unset($_SESSION['antrian_in_proses']);

        redirect('registrasi_pemeriksaan');
	}

	private function call_next_from($id, $poli)
	{
		date_default_timezone_set("Asia/Jakarta");
		$antrian = $this->m_antrian->get(array('antrian.id_antrian' => $id));
			
		$next_antrian = $this->m_security->query("select * 
			from antrian
			where tgl_antrian = '".date('Y-m-d')."'
			and id_poli = '".$poli."' 
			and status_antrian = 'Menunggu'
			order by id_antrian asc
			limit 1");
		if(count($next_antrian) > 0) {
			$next_id = $next_antrian[0]->ID_ANTRIAN;

			$this->m_antrian->patch(array('antrian.id_antrian' => $next_id), array('antrian.status_antrian' => 'Sedang Berlangsung'));

			$_SESSION['antrian_in_proses'] = $id;
		}
	}
}
?>
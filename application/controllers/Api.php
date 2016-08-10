<?php  
/**
* 
*/
class Api extends CI_Controller
{
	
	public function kunjungan()
	{
		$arr_data = array();
		$poli = $this->m_poli->get(array());
		foreach ($poli as $p) {
			$name = $p->NM_POLI;
			$data = array();
			for ($i=1; $i <= 12; $i++) { 
				$rekam_medis = $this->m_rekam_medis->get(array(
					'month(rekam_medis.tgl_periksa)' => $i,
					'year(rekam_medis.tgl_periksa)' => date('Y'),
					'dokter.id_poli' => $p->ID_POLI
					));

				array_push($data, count($rekam_medis));
			}
			$obj_series = (object) [
				'name' => $p->NM_POLI,
				'data' => $data
				];

			array_push($arr_data, $obj_series);
		}

		header("Content-Type: application/json");
        echo json_encode($arr_data);
	}
}
?>
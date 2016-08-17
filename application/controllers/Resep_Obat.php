<?php  
/**
* 
*/
class Resep_Obat extends CI_Controller
{
	
	public function add_obat()
	{
		$id_rekam_medis = $this->input->post('rekam_medis');
		$id_dokter = $this->input->post('dokter');
		$id_pasien = $this->input->post('pasien');
		$id_obat = $this->input->post('obat');
		$jumlah = $this->input->post('jumlah');
		$pemakaian = $this->input->post('dosis');

		# cek resep
		$no_resep = "";
		// $check_resep = $this->m_resep_obat->get(array(
		// 	'resep_obat.id_rekam_medis' => $id_rekam_medis,
		// 	'resep_obat.id_pasien' => $id_pasien,
		// 	'resep_obat.id_dokter' => $id_dokter
		// 	));
		$check_resep = $this->m_security->query("select * 
			from resep_obat 
			where id_rekam_medis = '".$id_rekam_medis."' 
			and id_dokter = '".$id_dokter."' 
			and id_pasien = '".$id_pasien."'");
		if (count($check_resep) > 0) {
			$no_resep = $check_resep[0]->NO_RESEP;
		} else {
			$no_resep = $this->m_security->gen_ai_id('resep_obat', 'no_resep');
			$this->m_resep_obat->create(array(
				'resep_obat.no_resep' => $no_resep,
				'resep_obat.id_rekam_medis' => $id_rekam_medis,
				'resep_obat.id_pasien' => $id_pasien,
				'resep_obat.id_dokter' => $id_dokter
				));
		}

		$obat = $this->m_obat->get(array('id_obat' => $id_obat));
		if (count($obat) > 0) {
			$sub_total = $jumlah * $obat[0]->HRG_OBAT;

			$check = $this->m_detail_resep_obat->get(array(
				'detail_resep_obat.id_obat' => $id_obat,
				'detail_resep_obat.no_resep' => $no_resep
				));
			if (count($check) > 0) {
				$act = $this->m_detail_resep_obat->patch(
					array(
						'id_obat' => $id_obat,
						'no_resep' => $no_resep
					),
					array(
						'qty_obat' => $jumlah,
						'pemakaian' => $pemakaian
					)
				);
			} else {
				$act = $this->m_detail_resep_obat->create(array(
					'no_resep' => $no_resep,
					'id_obat' => $id_obat,
					'qty_obat' => $jumlah,
					'pemakaian' => $pemakaian
					));
			}

			if ($act > 0) 
				echo "sukses";
			else
				echo "gagal";

		} else {
			echo "gagal";
		}
	}

	public function get($id_rekam_medis)
	{
        $data = $this->m_detail_resep_obat->get(array('resep_obat.id_rekam_medis' => $id_rekam_medis));
        header("Content-Type: application/json");
        echo json_encode($data);
	}

	public function delete_resep()
	{
		$no_resep = $this->input->post('noresep');
		$id_obat = $this->input->post('idobat');
		$act = $this->m_detail_resep_obat->remove(array(
			'detail_resep_obat.no_resep' => $no_resep,
			'detail_resep_obat.id_obat' => $id_obat
			));

		if ($act > 0) 
			echo "sukses";
		else
			echo "gagal";
	}
}
?>
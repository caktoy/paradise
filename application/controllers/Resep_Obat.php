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

		$obat = $this->m_obat->get(array('id_obat' => $id_obat));
		if (count($obat) > 0) {
			$sub_total = $jumlah * $obat[0]->HRG_OBAT;

			$check = $this->m_resep_obat->get(array(
				'resep_obat.id_obat' => $id_obat,
				'resep_obat.id_rekam_medis' => $id_rekam_medis
				));
			if (count($check) > 0) {
				$act = $this->m_resep_obat->patch(
					array(
						'id_obat' => $id_obat,
						'id_rekam_medis' => $id_rekam_medis
					),
					array(
						'kuantitas_obat' => $jumlah,
						'pemakaian' => $pemakaian,
						'sub_total_resep' => $sub_total
					)
				);
			} else {
				$no_resep = $this->m_security->gen_ai_id('resep_obat', 'no_resep');
				$act = $this->m_resep_obat->create(array(
					'no_resep' => $no_resep,
					'id_rekam_medis' => $id_rekam_medis,
					'id_dokter' => $id_dokter,
					'id_pasien' => $id_pasien,
					'id_obat' => $id_obat,
					'kuantitas_obat' => $jumlah,
					'pemakaian' => $pemakaian,
					'sub_total_resep' => $sub_total
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
        $data = $this->m_resep_obat->get(array('resep_obat.id_rekam_medis' => $id_rekam_medis));
        header("Content-Type: application/json");
        echo json_encode($data);
	}

	public function delete_resep()
	{
		$no_resep = $this->input->post('noresep');
		$act = $this->m_resep_obat->remove(array('resep_obat.no_resep' => $no_resep));

		if ($act > 0) 
			echo "sukses";
		else
			echo "gagal";
	}
}
?>
<?php  
/**
* 
*/
class Odontogram extends CI_Controller
{
	
	public function set_rekam_medis()
	{
		$id_odontogram = $this->m_security->gen_ai_id("odontogram", "id_odontogram");
		$id_rekam_medis = $this->input->post('rekam_medis');
		$nomor = $this->input->post('nomenklatur');
		$kode_status = $this->input->post('status');
		$tgl = date('Y-m-d');
		$cttn = $this->input->post('catatan');

		$rekam_medis = $this->m_rekam_medis->get(array('rekam_medis.id_rekam_medis' => $id_rekam_medis), 1);

		if ($kode_status != null) {
			$check = $this->m_odontogram->get(array(
				'odontogram.id_rekam_medis' => $id_rekam_medis,
				'odontogram.nomor' => $nomor
				));
			if (count($check) > 0) {
				# update
				$this->m_odontogram->patch(
						array(
							'id_rekam_medis' => $id_rekam_medis,
							'nomor' => $nomor,
							'id_dokter' => $rekam_medis[0]->ID_DOKTER,
							'id_pasien' => $rekam_medis[0]->ID_PASIEN
						),
						array(
							'kode_status' => $kode_status,
							'tgl_od' => $tgl,
							'cttn_od' => $cttn
						)
					);
			} else {
				# insert
				$this->m_odontogram->create(array(
					'id_odontogram' => $id_odontogram,
					'id_dokter' => $rekam_medis[0]->ID_DOKTER,
					'id_pasien' => $rekam_medis[0]->ID_PASIEN,
					'id_rekam_medis' => $id_rekam_medis,
					'nomor' => $nomor,
					'kode_status' => $kode_status,
					'tgl_od' => $tgl,
					'cttn_od' => $cttn
					));
			}
		}

		$this->session->set_flashdata('active_odontogram', 'active');

		redirect('rekam_medis/proses/'.$id_rekam_medis);
	}

	public function simpan_odo()
	{
		$id_odontogram = $this->m_security->gen_ai_id("odontogram", "id_odontogram");
		$id_rekam_medis = $this->input->post('rekam_medis');
		$id_dokter = $this->input->post('dokter');
		$id_pasien = $this->input->post('pasien');
		$nomor = $this->input->post('nomenklatur');
		$kode_status = $this->input->post('kode_status');
		$tgl = date('Y-m-d');
		$cttn = $this->input->post('cttn_od');

		if ($kode_status != null) {
			$kode_status = explode(".", $kode_status)[0];
			$check = $this->m_odontogram->get(array(
				'odontogram.id_rekam_medis' => $id_rekam_medis,
				'odontogram.nomor' => $nomor
				));
			if (count($check) > 0) {
				# update
				$act = $this->m_odontogram->patch(
						array(
							'id_rekam_medis' => $id_rekam_medis,
							'nomor' => $nomor,
							'id_dokter' => $id_dokter,
							'id_pasien' => $id_pasien
						),
						array(
							'kode_status' => $kode_status,
							'tgl_od' => $tgl,
							'cttn_od' => $cttn
						)
					);
			} else {
				# insert
				$act = $this->m_odontogram->create(array(
					'id_odontogram' => $id_odontogram,
					'id_dokter' => $id_dokter,
					'id_pasien' => $id_pasien,
					'id_rekam_medis' => $id_rekam_medis,
					'nomor' => $nomor,
					'kode_status' => $kode_status,
					'tgl_od' => $tgl,
					'cttn_od' => $cttn
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
}
?>
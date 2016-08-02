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

		if ($kode_status != null) {
			$check = $this->m_odontogram->get(array(
				'odontogram.id_rekam_medis' => $id_rekam_medis,
				'odontogram.nomor' => $nomor
				));
			if (count($check) > 0) {
				# update
				$this->m_odontogram->patch(
						array(
							'id_odontogram' => $id_odontogram
						),
						array(
							'kode_status' => $kode_status,
							'tgl' => $tgl
						)
					);
			} else {
				# insert
				$this->m_odontogram->create(array(
					'id_odontogram' => $id_odontogram,
					'id_rekam_medis' => $id_rekam_medis,
					'nomor' => $nomor,
					'kode_status' => $kode_status,
					'tgl' => $tgl
					));
			}
		}

		$this->session->set_flashdata('active_odontogram', 'active');

		redirect('rekam_medis/proses/'.$id_rekam_medis);
	}
}
?>
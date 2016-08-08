<?php  
/**
* 
*/
class M_Rekam_Medis extends CI_Model
{
	public function get(array $cond, $limit = null)
	{
		$this->db->select("*");
		$this->db->from("rekam_medis");
		$this->db->join("dokter", "rekam_medis.id_dokter = dokter.id_dokter", "left");
		$this->db->join("pasien", "rekam_medis.id_pasien = pasien.id_pasien", "left");
		// $this->db->join("poli", "dokter.id_poli = poli.id_poli", "left");
		$this->db->where($cond);
		$this->db->order_by("rekam_medis.tgl_periksa", "desc");
		if ($limit != null) 
			$this->db->limit($limit);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('rekam_medis', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('rekam_medis', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('rekam_medis');
	}
}
?>
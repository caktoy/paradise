<?php  
/**
* 
*/
class M_Rekam_Medis extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("rekam_medis");
		$this->db->join("pemeriksaan_lab", "rekam_medis.id_lab = pemeriksaan_lab.id_lab", "left");
		$this->db->join("dokter", "rekam_medis.id_lab = dokter.id_dokter", "left");
		$this->db->join("pasien", "rekam_medis.id_lab = pasien.id_pasien", "left");
		$this->db->where($cond);
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
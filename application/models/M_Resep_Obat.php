<?php  
/**
* 
*/
class M_Resep_Obat extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("resep_obat");
		$this->db->join("rekam_medis", "resep_obat.id_rekam_medis = rekam_medis.id_rekam_medis", "left");
		$this->db->join("detail_resep_obat", "resep_obat.no_resep = detail_resep_obat.no_resep", "left");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('resep_obat', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('resep_obat', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('resep_obat');
	}
}
?>
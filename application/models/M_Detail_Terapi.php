<?php  
/**
* 
*/
class M_Detail_Terapi extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("detail_terapi");
		$this->db->join("terapi", "detail_terapi.id_terapi = terapi.id_terapi");
		$this->db->join("rekam_medis", "detail_terapi.id_rekam_medis = rekam_medis.id_rekam_medis");
		$this->db->join("perawat", "detail_terapi.id_perawat = perawat.id_perawat");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('detail_terapi', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('detail_terapi', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('detail_terapi');
	}
}
?>
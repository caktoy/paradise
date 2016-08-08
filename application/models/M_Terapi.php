<?php  
/**
* 
*/
class M_Terapi extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("terapi");
		$this->db->join("poli", "terapi.id_poli = poli.id_poli", "left");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('terapi', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('terapi', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('terapi');
	}
}
?>
<?php  
/**
* 
*/
class M_Poli extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("poli");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('poli', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('poli', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('poli');
	}
}
?>
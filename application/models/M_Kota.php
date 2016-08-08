<?php  
/**
* 
*/
class M_Kota extends CI_Model
{
	
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("kota");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('kota', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('kota', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('kota');
	}
}
?>
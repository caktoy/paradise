<?php  
/**
* 
*/
class M_Nomenklatur extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("nomenklatur");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('nomenklatur', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('nomenklatur', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('nomenklatur');
	}
}
?>
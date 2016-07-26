<?php  
/**
* 
*/
class M_Status_Gigi extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("status_gigi");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('status_gigi', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('status_gigi', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('status_gigi');
	}
}
?>
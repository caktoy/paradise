<?php  
/**
* 
*/
class M_Jenis_Lab extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("jenis_lab");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('jenis_lab', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('jenis_lab', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('jenis_lab');
	}
}
?>
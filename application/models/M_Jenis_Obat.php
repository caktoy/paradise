<?php  
/**
* 
*/
class M_Jenis_Obat extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("jenis_obat");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('jenis_obat', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('jenis_obat', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('jenis_obat');
	}
}
?>
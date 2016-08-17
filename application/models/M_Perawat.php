<?php  
/**
* 
*/
class M_Perawat extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("perawat");
		$this->db->join("kota", "perawat.id_kota = kota.id_kota", "left");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('perawat', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('perawat', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('perawat');
	}
}
?>
<?php  
/**
* 
*/
class M_dokter extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("dokter");
		$this->db->join("poli", "dokter.id_poli = poli.id_poli", "left");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('dokter', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('dokter', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('dokter');
	}
}
?>
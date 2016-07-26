<?php  
/**
* 
*/
class M_Obat extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("obat");
		$this->db->join("jenis_obat", "obat.id_jenis_obat = jenis_obat.id_jenis_obat", "left");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('obat', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('obat', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('obat');
	}
}
?>
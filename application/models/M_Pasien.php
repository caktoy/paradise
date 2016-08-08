<?php  
/**
* 
*/
class M_Pasien extends CI_Model
{
	public function get(array $cond, $limit = null)
	{
		$this->db->select("*");
		$this->db->from("pasien");
		$this->db->join("kota", "pasien.id_kota = kota.id_kota", "left");
		$this->db->where($cond);
		if ($limit != null) 
			$this->db->limit($limit);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('pasien', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('pasien', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('pasien');
	}
}
?>
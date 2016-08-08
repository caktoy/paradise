<?php  
/**
* 
*/
class M_Antrian extends CI_Model
{
	public function get(array $cond, $limit = null)
	{
		$this->db->select("*");
		$this->db->from("antrian");
		$this->db->join("poli", "antrian.id_poli = poli.id_poli");
		$this->db->join("pasien", "antrian.id_pasien = pasien.id_pasien");
		$this->db->where($cond);
		$this->db->order_by("id_antrian", "asc");
		if ($limit != null) 
			$this->db->limit($limit);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('antrian', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('antrian', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('antrian');
	}
}
?>
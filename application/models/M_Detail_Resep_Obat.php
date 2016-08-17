<?php  
/**
* 
*/
class M_Detail_Resep_Obat extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("detail_resep_obat");
		$this->db->join("resep_obat", "detail_resep_obat.no_resep = resep_obat.no_resep", "left");
		$this->db->join("obat", "detail_resep_obat.id_obat = obat.id_obat", "left");
		$this->db->join("jenis_obat", "obat.id_jenis_obat = jenis_obat.id_jenis_obat", "left");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('detail_resep_obat', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('detail_resep_obat', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('detail_resep_obat');
	}
}
?>
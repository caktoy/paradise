<?php  
/**
* 
*/
class M_Obat_Diagnosa extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("obat_diagnosa");
		$this->db->join("obat", "obat_diagnosa.id_obat = obat.id_obat", "left");
		$this->db->join("diagnosa_icd_10", "obat_diagnosa.kode_icd_10 = diagnosa_icd_10.kode_icd_10", "left");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('obat_diagnosa', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('obat_diagnosa', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('obat_diagnosa');
	}
}
?>
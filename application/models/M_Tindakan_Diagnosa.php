<?php  
/**
* 
*/
class M_Tindakan_Diagnosa extends CI_Model
{
	
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("tindakan_diagnosa");
		$this->db->join("tindakan_icd_9", "tindakan_diagnosa.kode_icd_9 = tindakan_icd_9.kode_icd_9", "left");
		$this->db->join("diagnosa_icd_10", "tindakan_diagnosa.kode_icd_10 = diagnosa_icd_10.kode_icd_10", "left");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('tindakan_diagnosa', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('tindakan_diagnosa', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('tindakan_diagnosa');
	}
}
?>
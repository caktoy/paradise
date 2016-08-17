<?php  
/**
* 
*/
class M_Lab_Diagnosa extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("lab_diagnosa");
		$this->db->join("pemeriksaan_lab", "lab_diagnosa.id_lab = pemeriksaan_lab.id_lab", "left");
		$this->db->join("diagnosa_icd_10", "lab_diagnosa.kode_icd_10 = diagnosa_icd_10.kode_icd_10", "left");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('lab_diagnosa', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('lab_diagnosa', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('lab_diagnosa');
	}
}
?>
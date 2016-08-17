<?php  
/**
* 
*/
class M_Terapi_Diagnosa extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("terapi_diagnosa");
		$this->db->join("terapi", "terapi_diagnosa.id_terapi = terapi.id_terapi", "left");
		$this->db->join("diagnosa_icd_10", "terapi_diagnosa.kode_icd_10 = diagnosa_icd_10.kode_icd_10", "left");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('terapi_diagnosa', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('terapi_diagnosa', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('terapi_diagnosa');
	}
}
?>
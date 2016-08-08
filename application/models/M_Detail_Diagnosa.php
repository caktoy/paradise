<?php  
/**
* 
*/
class M_Detail_Diagnosa extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("detail_diagnosa");
		$this->db->join("diagnosa_icd_10", "detail_diagnosa.kode_icd_10 = diagnosa_icd_10.kode_icd_10");
		$this->db->join("rekam_medis", "detail_diagnosa.id_rekam_medis = rekam_medis.id_rekam_medis");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('detail_diagnosa', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('detail_diagnosa', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('detail_diagnosa');
	}
}
?>
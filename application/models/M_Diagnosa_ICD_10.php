<?php  
/**
* 
*/
class M_Diagnosa_ICD_10 extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("diagnosa_icd_10");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('diagnosa_icd_10', $value);
	}

	public function patch($id, array $value)
	{
		$this->db->where('kode_icd_10', $id);
		return $this->db->update('diagnosa_icd_10', $value);
	}

	public function remove($id)
	{	
		$this->db->where('kode_icd_10', $id);
		return $this->db->delete('diagnosa_icd_10');
	}
}
?>
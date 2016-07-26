<?php  
/**
* 
*/
class M_Tindakan_ICD_9 extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("tindakan_icd_9");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('tindakan_icd_9', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('tindakan_icd_9', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('tindakan_icd_9');
	}
}
?>
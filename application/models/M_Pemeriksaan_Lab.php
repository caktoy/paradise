<?php  
/**
* 
*/
class M_Pemeriksaan_Lab extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("pemeriksaan_lab");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('pemeriksaan_lab', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('pemeriksaan_lab', $value);
	}

	public function remove($id)
	{	
		$this->db->where('id_lab', $id);
		return $this->db->delete('pemeriksaan_lab');
	}
}
?>
<?php  
/**
* 
*/
class M_Jadwal_Dokter extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("jadwal_dokter");
		$this->db->join("dokter", "jadwal_dokter.id_dokter = dokter.id_dokter");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('jadwal_dokter', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('jadwal_dokter', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('jadwal_dokter');
	}
}
?>
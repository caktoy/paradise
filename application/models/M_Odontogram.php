<?php  
/**
* 
*/
class M_Odontogram extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("odontogram");
		$this->db->join("rekam_medis", "odontogram.id_rekam_medis = rekam_medis.id_rekam_medis", "left");
		$this->db->join("nomenklatur", "odontogram.nomor = nomenklatur.nomor", "left");
		$this->db->join("status_gigi", "odontogram.kode_status = status_gigi.kode_status", "left");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('odontogram', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('odontogram', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('odontogram');
	}
}
?>
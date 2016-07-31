<?php  
/**
* 
*/
class M_Hasil_Lab extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("hasil_lab");
		$this->db->join("pemeriksaan_lab", "hasil_lab.id_lab = pemeriksaan_lab.id_lab");
		$this->db->join("rekam_medis", "hasil_lab.id_rekam_medis = rekam_medis.id_rekam_medis");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('hasil_lab', $value);
	}

	public function patch($id, array $value)
	{
		$this->db->where('id_hasil', $id);
		return $this->db->update('hasil_lab', $value);
	}

	public function remove($id)
	{	
		$this->db->where('id_hasil', $id);
		return $this->db->delete('hasil_lab');
	}
}
?>
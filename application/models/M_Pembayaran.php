<?php  
/**
* 
*/
class M_Pembayaran extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("pembayaran");
		$this->db->join("rekam_medis", "pembayaran.id_rekam_medis = rekam_medis.id_rekam_medis");
		$this->db->join("perawat", "pembayaran.id_perawat = perawat.id_perawat");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('pembayaran', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('pembayaran', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('pembayaran');
	}
}
?>
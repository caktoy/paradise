<?php  
/**
* 
*/
class M_Penjualan extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("penjualan");
		$this->db->join("detail_penjualan", "penjualan.id_jual = detail_penjualan.id_jual", "left");
		$this->db->join("detail_resep_obat", "detail_penjualan.no_resep = detail_resep_obat.no_resep", "left");
		$this->db->join("obat", "detail_resep_obat.id_obat = obat.id_obat", "left");
		$this->db->join("jenis_obat", "obat.id_jenis_obat = jenis_obat.id_jenis_obat", "left");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('penjualan', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('penjualan', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('penjualan');
	}
}
?>
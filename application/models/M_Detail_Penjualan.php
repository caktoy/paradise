<?php  
/**
* 
*/
class M_Detail_Penjualan extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("*");
		$this->db->from("detail_penjualan");
		// $this->db->join("detail_resep_obat", "detail_penjualan.no_resep = detail_resep_obat.no_resep", "left");
		$this->db->join("obat", "detail_penjualan.id_obat = obat.id_obat", "left");
		$this->db->join("jenis_obat", "obat.id_jenis_obat = jenis_obat.id_jenis_obat", "left");
		$this->db->join("penjualan", "detail_penjualan.id_jual = penjualan.id_jual", "left");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('detail_penjualan', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('detail_penjualan', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('detail_penjualan');
	}
}
?>
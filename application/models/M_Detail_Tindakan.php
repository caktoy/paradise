<?php  
/**
* 
*/
class M_Detail_Tindakan extends CI_Model
{
	public function get(array $cond)
	{
		$this->db->select("rekam_medis.*, tindakan_icd_9.*, detail_tindakan.bayar_tindakan, detail_tindakan.detail_tindakan");
		$this->db->from("detail_tindakan");
		$this->db->join("tindakan_icd_9", "detail_tindakan.kode_icd_9 = tindakan_icd_9.kode_icd_9");
		$this->db->join("rekam_medis", "detail_tindakan.id_rekam_medis = rekam_medis.id_rekam_medis");
		$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function create(array $value)
	{
		return $this->db->insert('detail_tindakan', $value);
	}

	public function patch(array $cond, array $value)
	{
		$this->db->where($cond);
		return $this->db->update('detail_tindakan', $value);
	}

	public function remove(array $cond)
	{	
		$this->db->where($cond);
		return $this->db->delete('detail_tindakan');
	}
}
?>
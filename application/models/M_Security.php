<?php  
/**
* 
*/
class M_Security extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function check()
	{
		$user = $this->session->userdata('username');
		if(empty($user))
		{
			$this->session->sess_destroy();
			redirect('page');
		}
	}

	public function query($query)
	{
		return $this->db->query($query)->result();
	}

	public function gen_ai_id($tabel, $kolom)
	{
		$this->db->select_max($kolom, 'id');
		$data = $this->db->get($tabel)->result();
		return ($data[0]->id + 1);
	}

	public function gen_non_ai_id($prefix, $table, $kolom, $num_count)
    {
        $this->db->select("max(right(".$kolom.", ".$num_count.")) as id");
        $this->db->from($table);
        $id = $this->db->get()->result()[0]->id;
        $id = $id==null?1:($id+1);
        $counter = '00000000000'.$id;
        return $prefix.substr($counter, strlen($counter) - $num_count, $num_count);
    }
}
?>
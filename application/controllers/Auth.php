<?php  
/**
* 
*/
class Auth extends CI_Controller
{
	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		$userid = $this->input->post('userid');
		$password = $this->input->post('password');

		$cek_id = substr($userid, 0, 1);
		if($cek_id == '1') {
			# is dokter
			$dokter = $this->m_dokter->get(array(
				'dokter.id_dokter' => $userid,
				'dokter.pass_dokter' => md5($password)
				));
			if(count($dokter) > 0) {
				$session_data = array(
					'userid' => $dokter[0]->ID_DOKTER,
					'username' => $dokter[0]->NM_DOKTER,
					'userrole' => 'Dokter',
					'foto' => $dokter[0]->FOTO_DOKTER,
					'idpoli' => $dokter[0]->ID_POLI,
					'nmpoli' => $dokter[0]->NM_POLI
					);

				$this->session->set_userdata($session_data);
			}
		} elseif($cek_id == '2') {
			# is perawat
			$perawat = $this->m_perawat->get(array(
				'perawat.id_perawat' => $userid,
				'perawat.pass_perawat' => md5($password)
				));
			print_r($perawat);
			if(count($perawat) > 0) {
				$session_data = array(
					'userid' => $perawat[0]->ID_PERAWAT,
					'username' => $perawat[0]->NM_PERAWAT,
					'userrole' => $perawat[0]->BAG_PERAWAT,
					'foto' => $perawat[0]->FOTO_PERAWAT,
					'idpoli' => $perawat[0]->ID_POLI,
					'nmpoli' => $perawat[0]->NM_POLI
					);

				$this->session->set_userdata($session_data);
			}
		} else {
			if ($userid == 'admin' && $password == 'admin') {
				$session_data = array(
					'userid' => 'admin',
					'username' => 'System Administrator',
					'userrole' => 'Administrasi',
					'foto' => 'avatar.png',
					'idpoli' => 'SYSADMIN',
					'nmpoli' => 'SYSADMIN'
					);

				$this->session->set_userdata($session_data);
			}
		}

		redirect('page');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('page');
	}
}
?>
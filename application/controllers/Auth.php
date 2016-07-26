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
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if($username == 'admin' && $password == 'admin') {
			$session_data = array(
				'username' => 'admin'
			);
			$this->session->set_userdata($session_data);
			redirect('page');
		} else {
			redirect('session');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('page');
	}
}
?>
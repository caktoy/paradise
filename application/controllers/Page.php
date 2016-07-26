<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller 
{
	public function index()
	{
		if(isset($_SESSION['username']))
			redirect('page/beranda');
		else
			redirect('auth');
	}

	public function beranda()
	{
		$this->m_security->check();

		$data['aktif'] = "beranda";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home");
		$data['judul'] = "Beranda";
		$data['konten'] = "beranda";
		
		$this->load->view('layout', $data);
	}
}

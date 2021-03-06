<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Terapi extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Terapi");
		$data['judul'] = "Maintenance Master Terapi";
		$data['konten'] = "master/terapi";
		$data['kodeterapi'] = $this->m_security->gen_non_ai_id("TR", "terapi", "id_terapi", 3);
		$data['diagnosa'] = $this->m_diagnosa_icd_10->get(array());

        $arr_terapi = array();
        $terapi = $this->m_terapi->get(array());
        foreach ($terapi as $t) {
            $diagnosis = $this->m_terapi_diagnosa->get(array('terapi_diagnosa.id_terapi' => $t->ID_TERAPI));

            $obj = (object) [
                'terapi' => $t,
                'diagnosa' => $diagnosis
            ];

            array_push($arr_terapi, $obj);
        }
		$data['terapi'] = $arr_terapi;
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$id_terapi = $this->input->post('id_terapi');
		$diagnosa = $this->input->post('diagnosa');
        $nm_terapi = $this->input->post('nm_terapi');
        $ket_terapi = $this->input->post('ket_terapi');
        $harga_terapi = $this->input->post('harga_terapi');
        
        $check_terapi = $this->m_terapi->get(array('lower(nm_terapi)' => strtolower($nm_terapi)));
        if(count($check_terapi) > 0) {
            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data terapi dengan nama \''.$nama_terapi.'\' sudah ada.');
        } else {
            $act = $this->m_terapi->create(array(
            	'id_terapi' => $id_terapi,
            	'nm_terapi' => $nm_terapi,
            	'ket_terapi' => $ket_terapi,
            	'harga_terapi' => $harga_terapi
            	));
	        
	        if ($act > 0) {
	        	foreach ($diagnosa as $d) {
                    $this->m_terapi_diagnosa->create(array(
                        'id_terapi' => $id_terapi,
                        'kode_icd_10' => $d
                        ));
                }

	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data terapi telah disimpan.');
	        }
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data terapi gagal disimpan.');
        }
        
        redirect('terapi');
	}

	public function edit()
	{
		$id_terapi = $this->input->post('e-id_terapi');
		$diagnosa = $this->input->post('e-diagnosa');
        $nm_terapi = $this->input->post('e-nm_terapi');
        $ket_terapi = $this->input->post('e-ket_terapi');
        $harga_terapi = $this->input->post('e-harga_terapi');

		$act = $this->m_terapi->patch(
			array('id_terapi' => $id_terapi),
			array(
				'nm_terapi' => $nm_terapi,
            	'ket_terapi' => $ket_terapi,
            	'harga_terapi' => $harga_terapi
				)
			);

		if ($act > 0) {
			$this->m_terapi_diagnosa->remove(array('id_terapi' => $id_terapi));
			foreach ($diagnosa as $d) {
                $this->m_terapi_diagnosa->create(array(
                    'id_terapi' => $id_terapi,
                    'kode_icd_10' => $d
                    ));
            }

            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data terapi telah diubah.');
		}
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data terapi gagal diubah.');

        redirect('terapi');
	}

	public function get()
	{
		$id = $this->input->post('id');
		$data = $this->m_terapi->get(array('id_terapi' => $id));
		header("Content-Type: application/json");
        echo json_encode($data);
	}
}
?>
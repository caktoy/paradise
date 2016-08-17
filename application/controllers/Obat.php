<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Obat extends CI_Controller
{
	public function index()
	{
		$data['aktif'] = "maintenance";
		$data['breadcrumb'] = array("<i class='fa fa-home'></i> Home", "Maintenance", "Master Obat");
		$data['judul'] = "Maintenance Master Obat";
		$data['konten'] = "master/obat";
		$data['kodeobat'] = $this->m_security->gen_non_ai_id("OB", "obat", "id_obat", 4);
		$data['jenis_obat'] = $this->m_jenis_obat->get(array());
        $data['diagnosa'] = $this->m_diagnosa_icd_10->get(array());

        $arr_obat = array();
        $obat = $this->m_obat->get(array());
        foreach ($obat as $o) {
            $diagnosis = $this->m_obat_diagnosa->get(array('obat_diagnosa.id_obat' => $o->ID_OBAT));

            $obj = (object) [
                'obat' => $o,
                'diagnosa' => $diagnosis
            ];

            array_push($arr_obat, $obj);
        }
		$data['obat'] = $arr_obat;
		
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$id_obat = $this->input->post('id_obat');
        $id_jenis_obat = $this->input->post('id_jenis_obat');
        $nm_obat = $this->input->post('nm_obat');
        $jml_obat = $this->input->post('jml_obat');
        $diagnosa = $this->input->post('diagnosa');
        $hrg_obat = $this->input->post('hrg_obat');
        $satuan = $this->input->post('satuan');
        
        $check_obat = $this->m_obat->get(array(
        	'lower(obat.id_jenis_obat)' => strtolower($id_jenis_obat),
        	'lower(nm_obat)' => strtolower($nm_obat)
        	));
        if(count($check_obat) > 0) {
            $this->session->set_flashdata('pesan', '<b>Data Sudah Ada!</b> Data obat dengan nama \''.$nm_obat.'\' sudah ada.');
        } else {
            $act = $this->m_obat->create(array(
            	'id_obat' => $id_obat,
            	'id_jenis_obat' => $id_jenis_obat,
            	'nm_obat' => $nm_obat,
            	'jml_obat' => $jml_obat,
            	'hrg_obat' => $hrg_obat,
            	'satuan' => $satuan
            	));
	        
	        if ($act > 0) {
                foreach ($diagnosa as $d) {
                    $this->m_obat_diagnosa->create(array(
                        'id_obat' => $id_obat,
                        'kode_icd_10' => $d
                        ));
                }

	            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data obat telah disimpan.');
            }
	        else
	            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data obat gagal disimpan.');
        }
        
        redirect('obat');
	}

	public function edit()
	{
		$id_obat = $this->input->post('e-id_obat');
        $id_jenis_obat = $this->input->post('e-id_jenis_obat');
        $nm_obat = $this->input->post('e-nm_obat');
        $jml_obat = $this->input->post('e-jml_obat');
        $hrg_obat = $this->input->post('e-hrg_obat');
        $satuan = $this->input->post('e-satuan');
        $diagnosa = $this->input->post('e-diagnosa');

		$act = $this->m_obat->patch(
			array('id_obat' => $id_obat),
			array(
				'id_jenis_obat' => $id_jenis_obat,
            	'nm_obat' => $nm_obat,
            	'jml_obat' => $jml_obat,
            	'hrg_obat' => $hrg_obat,
            	'satuan' => $satuan
				)
			);

		if ($act > 0) {
            $this->m_obat_diagnosa->remove(array('id_obat' => $id_obat));
            foreach ($diagnosa as $d) {
                $this->m_obat_diagnosa->create(array(
                    'id_obat' => $id_obat,
                    'kode_icd_10' => $d
                    ));
            }

            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data obat telah diubah.');
        }
        else
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data obat gagal diubah.');

        redirect('obat');
	}

    public function get()
    {
        $id = $this->input->post('id');
        $data = $this->m_obat->get(array('id_obat' => $id));
        header("Content-Type: application/json");
        echo json_encode($data);
    }
}
?>
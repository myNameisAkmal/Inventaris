<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTemplate extends Mine_Controller {

	private $agama = array('Islam','Kristen','Budha','Hindu','Katolik') ;

	public function index() {
		// $this->load->view('template/index') ;
		$data['head'] = "Halaman Dashboard <i class='fa fa-home'></i>" ;
		$this->load_page('Admin/index', $data) ;
	}

	public function data() {
		// $data['mhs'] = $this->cihuy->passData('mahasiswa','', '') ;
		$data['head'] = "Data Mahasiswa <i class='fa fa-list'></i>" ;
		$this->load_page('Admin/data', $data) ;
	}

	public function getData() {
		$data['mhs'] = $this->cihuy->passData('v_mhs','','nim asc') ;
		echo json_encode($data) ;
	}

	public function test() {
		$this->load->view('template/tes') ;
	}

	public function getJurusan() {
        $jur = $this->cihuy->passData('jurusan', '', '') ;

        echo json_encode($jur) ;
    }

    public function getKelas($parm) {
    	$kel = $this->cihuy->passData('kelas', ['kd_jurusan' => $parm], '') ;

        echo json_encode($kel) ;
    }

}
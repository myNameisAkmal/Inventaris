<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends Mine_Controller {

	public function __construct(){
		parent ::__construct();
		
		// $this->load->model("M_Inv", TRUE);
    }
    
	public function index() {
		// $this->load->view('template/index') ;
		$dataKat['head'] = NULL ;
		// $data['head'] = "List Barang <i class='fa fa-list'></i>" ;
		$this->load_page('Inventaris/listLokasi', $dataKat) ;
	}
	
	public function getData() {
		if($_POST){
			$w = array(
				'id_lokasi' => $_POST['id']
			);
		}
		else {
			$w = '';
		}
		$data['lok'] = $this->M_Inv->passData('inv_lokasi',$w,'') ;
		echo json_encode($data) ;
	}
	
	public function save(){
		// var_dump($_POST);
		$cb = array(
			'err' => false,
			'msg' => ''
		);

		$post = $_POST['data'];

		$data = array(
			'id_lokasi' => $post['id_lokasi'],
			'nama_lokasi' => $post['nama_lokasi']
		);

		$save = $this->M_Inv->commit("inv_lokasi", $data);
		// var_dump($save);
		if($save == 'v'){
			$cb['msg'] = "Data Berhasil Disimpan";
		}
		else {
			$cb['err'] = true;
			$cb['msg'] = "Data Gagal Disimpan";
		}

		echo json_encode($cb);
	}

	public function update(){
		// var_dump($_POST);
		$cb = array(
			'err' => false,
			'msg' => ''
		);

		$post = $_POST['data'];

		$data = array(
			'nama_lokasi' => $post['nama_lokasi']
		);

		$where = array(
			'id_lokasi' => $post['id_lokasi']
		);

		$save = $this->M_Inv->commitUpdate("inv_lokasi", $data, $where);
		// var_dump($save);
		if($save == 'v'){
			$cb['msg'] = "Data Berhasil Update";
		}
		else {
			$cb['err'] = true;
			$cb['msg'] = "Data Gagal Update";
		}

		echo json_encode($cb);
	}
	
	public function delete(){
		// var_dump($_POST);
		$cb = array(
			'err' => false,
			'msg' => ''
		);
		$id = $_POST['id'];

		$where = array(
			'id_lokasi' => $id
		);

		$save = $this->M_Inv->dropData("inv_lokasi", $where);
		// var_dump($save);
		if($save == 'v'){
			$cb['msg'] = "Data Berhasil Dihapus";
		}
		else {
			$cb['err'] = true;
			$cb['msg'] = "Data Gagal Dihapus";
		}

		echo json_encode($cb);
	}

}
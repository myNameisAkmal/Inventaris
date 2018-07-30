<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends Mine_Controller {

	public function __construct(){
		parent ::__construct();
		
		// $this->load->model("M_Inv", TRUE);
    }
    
	public function index() {
		// $this->load->view('template/index') ;
		$dataKat['head'] = NULL ;
		// $data['head'] = "List Barang <i class='fa fa-list'></i>" ;
		$this->load_page('Inventaris/listKategori', $dataKat) ;
	}
	
	public function getData() {
		if($_POST){
			$w = array(
				'id_kategori' => $_POST['id']
			);
		}
		else {
			$w = '';
		}
		$data['kat'] = $this->M_Inv->passData('inv_kategori',$w,'') ;
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
			'id_kategori' => $post['id_kategori'],
			'nama_kategori' => $post['nama_kategori']
		);

		$save = $this->M_Inv->commit("inv_kategori", $data);
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
			'nama_kategori' => $post['nama_kategori']
		);

		$where = array(
			'id_kategori' => $post['id_kategori']
		);

		$save = $this->M_Inv->commitUpdate("inv_kategori", $data, $where);
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
			'id_kategori' => $id
		);

		$save = $this->M_Inv->dropData("inv_kategori", $where);
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
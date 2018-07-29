<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invent extends Mine_Controller {

	public function __construct(){
		parent ::__construct();
		
		// $this->load->model("M_Inv", TRUE);
	}

	public function index() {
		// $this->load->view('template/index') ;
		$data['head'] = NULL ;
		// $data['head'] = "List Barang <i class='fa fa-list'></i>" ;
		$this->load_page('Inventaris/listBarang', $data) ;
	}
	public function index_kategori() {
		// $this->load->view('template/index') ;
		$dataKat['head'] = NULL ;
		// $data['head'] = "List Barang <i class='fa fa-list'></i>" ;
		$this->load_page('Inventaris/listKategori', $dataKat) ;
	}
	public function index_lokasi() {
		// $this->load->view('template/index') ;
		$dataLok['head'] = NULL ;
		// $data['head'] = "List Barang <i class='fa fa-list'></i>" ;
		$this->load_page('Inventaris/listLokasi', $dataLok) ;
	}

	public function getDataBarang() {
		if($_POST){
			$w = array(
				'id_barang' => $_POST['id']
			);
		}
		else {
			$w = '';
		}
		$data['inv'] = $this->M_Inv->passData('v_listbarang',$w,'insert_at desc') ;
		echo json_encode($data) ;
	}
	public function getDataKategori() {
		if($_POST){
			$w = array(
				'id_kategori' => $_POST['id']
			);
		}
		else {
			$w = '';
		}
		$data['inv'] = $this->M_Inv->passData('inv_kategori',$w,'') ;
		echo json_encode($data) ;
	}

	public function getDataLokasi() {
		if($_POST){
			$w = array(
				'id_lokasi' => $_POST['id']
			);
		}
		else {
			$w = '';
		}
		$data['inv'] = $this->M_Inv->passData('inv_lokasi',$w,'') ;
		echo json_encode($data) ;
	}

	public function getKategori() {
        $kat = $this->M_Inv->passData('inv_kategori', '', '') ;

        echo json_encode($kat) ;
	}
	
	public function saveBarang(){
		// var_dump($_POST);
		$cb = array(
			'err' => false,
			'msg' => ''
		);

		$post = $_POST['data'];

		$data = array(
			'id_barang' => $post['id_barang'],
			'id_kategori' => $post['kategori'],
			'nama_barang' => ucfirst($post['nama']),
			'satuan_barang' => strtolower($post['satuan']),
			'batas_usia' => $post['batas'],
			'stock' => $post['stock']
		);

		$save = $this->M_Inv->commit("inv_barang", $data);
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
	public function saveKategori(){
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
			// 'id_barang' => $post['id_barang'],
			'id_kategori' => $post['kategori'],
			'nama_barang' => $post['nama'],
			'satuan_barang' => $post['satuan'],
			'batas_usia' => $post['batas'],
			'stock' => $post['stock']
		);

		$where = array(
			'id_barang' => $post['id_barang']			
		);

		$save = $this->M_Inv->commitUpdate("inv_barang", $data, $where);
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

	public function deleteBarang(){
		// var_dump($_POST);
		$cb = array(
			'err' => false,
			'msg' => ''
		);

		$id = $_POST['id'];

		$where = array(
			'id_barang' => $id
		);

		$save = $this->M_Inv->dropData("inv_barang", $where);
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
	public function deleteLokasi(){
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
	public function deleteKategori(){
		// var_dump($_POST);
		$cb = array(
			'err' => false,
			'msg' => ''
		);
		$id = $_POST['id'];

		$where = array(
			'id_lokasi' => $id
		);

		$save = $this->M_Inv->dropData("inv_barang", $where);
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
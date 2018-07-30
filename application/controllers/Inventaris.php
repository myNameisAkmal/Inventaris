<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris extends Mine_Controller {

	public function __construct(){
		parent ::__construct();
		
		// $this->load->model("M_Inv", TRUE);
	}

	public function index() {
		// $this->load->view('template/index') ;
		$data['head'] = NULL ;
		// $data['head'] = "List Barang <i class='fa fa-list'></i>" ;
		$this->load_page('Penempatan/listBarang', $data) ;
	}

	public function getData() {
		if($_POST){
			$w = array(
				'id_barang' => $_POST['id']
				// 'id_lokasi' => $this->session->userdata('lokasi')
			);

			if(!$this->session->userdata('lokasi') == '000'){
				$w['id_lokasi'] = $this->session->userdata('lokasi');
			}
		}
		else {
			// $w = array(
			// 	'id_lokasi' => $this->session->userdata('lokasi')
			// );
			if(!$this->session->userdata('lokasi') == '000'){
				$w['id_lokasi'] = $this->session->userdata('lokasi');
			}
			else {
				$w = '';
			}
		}

		$col = ['nama_lokasi', 'lantai', 'id_lokasi', 'id_kategori', 'id_ruang', 'nama_barang', 'nama_kategori', 'qty', 'satuan_barang', 'expired'];
		$data['inv'] = $this->M_Inv->passField('v_penempatan',$col,$w,'nama_lokasi ASC, id_ruang ASC, lantai ASC, nama_barang ASC, ditempatkan desc') ;
		echo json_encode($data) ;
	}

	public function getLokasi() {
        $jur = $this->M_Inv->passData('inv_lokasi', '', '') ;

        echo json_encode($jur) ;
    }

    public function getLantai($lok) {
        $jur = $this->M_Inv->passField('inv_ruang',['lantai'], ['id_lokasi' => $lok], '', TRUE) ;

        echo json_encode($jur) ;
    }
    
    public function getKategori() {
        $jur = $this->M_Inv->passData('inv_kategori', '', '') ;

        echo json_encode($jur) ;
	}
	
	public function save(){
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

	public function delete(){
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

}
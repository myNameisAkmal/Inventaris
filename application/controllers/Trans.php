<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans extends Mine_Controller {

	public function formTrans() {
		$data['transNo'] = $this->cihuy->passField('product_transaction','max(noTrans) as transNo','','') ; //null
		$data['category'] = $this->cihuy->passData('category', '', '') ;
		$data['product'] = $this->cihuy->passData('product', '', '') ;
		$data['head'] = "New Transaction <i class='fa fa-pencil-square-o'></i>" ;
		$this->load_page('Trans/form', $data) ;
	}

	public function getList() {
		$data['trans'] = $this->cihuy->passData('v_trans', '', '');
		// foreach ($data['trans'] as $trans) {
		// 	$products = $this->cihuy->passData('product', ['product_id' => $trans->product_id], '');
		// 	$data['trans']['prod'][$trans->product_id] = $products[0]->product_name;
		// 	$data['trans']['price'][$trans->product_id] = $products[0]->price;

		// 	$cats = $products[0]->category_id;
		// 	$categorys = $this->cihuy->passData('category', ['category_id' => $cats], '');
		// 	$data['trans']['cat'][$trans->product_id] = $categorys[0]->category_name;
		// }

		echo json_encode($data);
	}
	public function getListWithWhere() {
		$noTrans = $_POST['id'];

		$data['trans'] = $this->cihuy->passData('v_trans', ['noTrans' => $noTrans], '');
		$date = $data['trans'][0]->date;
		$date = date('l, d F Y', strtotime($date));
		$data['trans'][0]->date = $date;
		echo json_encode($data);
	}

	public function listTrans() {
		$data['transNo'] = $this->cihuy->passField('product_transaction','max(noTrans) as transNo','','') ; //null
		$data['category'] = $this->cihuy->passData('category', '', '') ;
		$data['product'] = $this->cihuy->passData('product', '', '') ;
		// $x = $this->cihuy->passDataSQL('taKasie','','');
		// var_dump($x);exit;
		$data['head'] = "Transaction List <i class='fa fa-list'></i>" ;
		$this->load_page('Trans/list', $data) ;
	}

	public function saveTrans() {
		$data = $_POST['data'];
		if ($data['_doWhat'] == 'insert') {
			$x['noTrans'] = $data['transNo'];
			$x['date'] = date('Y-m-d H:i:s');
			$x['product_id'] = $data['prod'];
			$x['qty'] = $data['qty'];
			$total = explode(' ',$data['total'])[1];
			// var_dump($total);exit;
			$total = str_replace(',', '', $total);
			$x['total'] = $total;

			$this->cihuy->commit('product_transaction', $x);
		}
		else {
			$noTrans = $data['transNo'];
			$x['product_id'] = $data['prod'];
			$x['qty'] = $data['qty'];
			$total = explode(' ',$data['total'])[1];
			// var_dump($total);exit;
			$total = str_replace(',', '', $total);
			$x['total'] = $total;

			$this->cihuy->commitUpdate('product_transaction', $x, ['noTrans' => $noTrans]);
		}
		
	}

	public function deleteTrans() {
		$id = $_POST['id'];

		$this->cihuy->dropData('product_transaction', ['noTrans' => $id]);
	}

	public function sendMail() {
		$send = $this->send_mail();
		var_dump($send);
	}

}

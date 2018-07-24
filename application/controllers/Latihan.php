<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Latihan extends CI_Controller {

    public function index() {
        $this->load->view('latihan/latihan2') ;
    }

    public function getCategory() {
        $data = $this->cihuy->passData('category', '') ;

        echo json_encode($data) ;
    }

    public function getProduct($id) {
        $data = $this->cihuy->passData('product', array('category_id' => $id)) ;

        echo json_encode($data);
    }

    //-------------------------------------------------------------------------------------
    public function getData() {
        $data = $this->cihuy->passData('v_data', '', 'nProvinsi') ;

        echo json_encode($data) ;
    }


    public function getDataSearch($parm) {
        $data = $this->cihuy->passData1($parm) ;

        echo json_encode($data) ;
    }
}
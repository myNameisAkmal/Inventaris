<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Inv extends CI_Model {
  
  public $DB2 ;

  public function __construct(){
		parent ::__construct();
		
		$this->DB2 = $this->load->database("inv", TRUE);
  }

    public function passData($table, $where, $sort) {
      //$data = $this->DB2->query("SELECT * FROM $table $where") ;
      //$this->DB2->select() ; -> Field Tertentu
      if ($sort != "") {
        $this->DB2->order_by($sort) ;
      }
      if ($where != "") {
        $this->DB2->where($where) ; //Dengan Kondisi Where
      }
      $data = $this->DB2->get($table) ; //Select Table
      return $data->result() ; //result_array() ; Untuk Fetch_Array
	}

	public function passDataSQL($table, $where, $sort) {
		//$data = $this->DB2->query("SELECT * FROM $table $where") ;
		//$this->DB2->select() ; -> Field Tertentu
		$this->DB2 = $this->load->database('xx', TRUE);
		if ($sort != "") {
			$this->DB2->order_by($sort) ;
		}
		if ($where != "") {
			$this->DB2->where($where) ; //Dengan Kondisi Where
		}
		$data = $this->DB2->get($table) ; //Select Table
		return $data->result() ; //result_array() ; Untuk Fetch_Array
}
	
	public function passData2($table, $field, $where, $sort) {
			//$data = $this->DB2->query("SELECT * FROM $table $where") ;
			//$this->DB2->select() ; -> Field Tertentu
			if ($sort != "") {
				$this->DB2->order_by($sort) ;
			}
			if ($where != "") {
				$this->DB2->where($where) ; //Dengan Kondisi Where
			}
			$data = $this->DB2->get($table) ; //Select Table
			return $data->result() ; //result_array() ; Untuk Fetch_Array
	}

  public function passField($table, $field, $where, $sort, $distinct) {
      //$data = $this->DB2->query("SELECT * FROM $table $where") ;
      //$this->DB2->select() ; -> Field Tertentu
      if ($field != "") {
        $this->DB2->select($field);
      }
      if ($sort != "") {
        $this->DB2->order_by($sort) ;
      }
      if ($where != "") {
        $this->DB2->where($where) ; //Dengan Kondisi Where
      }
      if($distinct){
        $this->DB2->distinct();
      }
      $data = $this->DB2->get($table) ; //Select Table
      return $data->result() ; //result_array() ; Untuk Fetch_Array
  }

  public function commit($table, $data) {
			$qSave = $this->DB2->insert($table, $data) ;

      if ($qSave) {
        return 'v';
      }
      else {
        return 'x';
      }
  }

  public function dropData($table, $data) {
//      $this->DB2->where($data) ;
      $dSave = $this->DB2->delete($table, $data) ;

//       if ($dSave) {
//       echo "<script>alert('Data Berhasil Dihapus') ; window.location.href='".base_url()."Data/getData' ;</script>" ;
//           echo "Data Berhasil Dihapus" ;
//       }
      if ($dSave) {
        return 'v';
      }
      else {
        return 'x';
      }
  }

  public function commitUpdate($table, $set, $unique) {
      $qUpd = $this->DB2->update($table, $set, $unique) ;

      // if ($qUpd) {
      //   echo json_encode(["msg" => "Data Berhasil DiUpdate", "sts" => "v"]) ;
      // }
      if ($qUpd) {
        return 'v';
      }
      else {
        return 'x';
      }
  }

}

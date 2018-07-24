<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cihuy extends CI_Model {

  public function passData($table, $where, $sort) {
      //$data = $this->db->query("SELECT * FROM $table $where") ;
      //$this->db->select() ; -> Field Tertentu
      if ($sort != "") {
        $this->db->order_by($sort) ;
      }
      if ($where != "") {
        $this->db->where($where) ; //Dengan Kondisi Where
      }
      $data = $this->db->get($table) ; //Select Table
      return $data->result() ; //result_array() ; Untuk Fetch_Array
	}

	public function passDataSQL($table, $where, $sort) {
		//$data = $this->db->query("SELECT * FROM $table $where") ;
		//$this->db->select() ; -> Field Tertentu
		$db2 = $this->load->database('xx', TRUE);
		if ($sort != "") {
			$db2->order_by($sort) ;
		}
		if ($where != "") {
			$db2->where($where) ; //Dengan Kondisi Where
		}
		$data = $db2->get($table) ; //Select Table
		return $data->result() ; //result_array() ; Untuk Fetch_Array
}
	
	public function passData2($table, $field, $where, $sort) {
			//$data = $this->db->query("SELECT * FROM $table $where") ;
			//$this->db->select() ; -> Field Tertentu
			if ($sort != "") {
				$this->db->order_by($sort) ;
			}
			if ($where != "") {
				$this->db->where($where) ; //Dengan Kondisi Where
			}
			$data = $this->db->get($table) ; //Select Table
			return $data->result() ; //result_array() ; Untuk Fetch_Array
	}

  public function passField($table, $field, $where, $sort) {
      //$data = $this->db->query("SELECT * FROM $table $where") ;
      //$this->db->select() ; -> Field Tertentu
      if ($field != "") {
        $this->db->select($field);
      }
      if ($sort != "") {
        $this->db->order_by($sort) ;
      }
      if ($where != "") {
        $this->db->where($where) ; //Dengan Kondisi Where
      }
      $data = $this->db->get($table) ; //Select Table
      return $data->result() ; //result_array() ; Untuk Fetch_Array
  }

  public function commit($table, $data) {
			$qSave = $this->db->insert($table, $data) ;

      if ($qSave) {
          echo json_encode(["msg" => "Data Berhasil Disimpan", "sts" => "v"]) ;
      }
  }

  public function dropData($table, $data) {
//      $this->db->where($data) ;
      $dSave = $this->db->delete($table, $data) ;

      if ($dSave) {
//          echo "<script>alert('Data Berhasil Dihapus') ; window.location.href='".base_url()."Data/getData' ;</script>" ;
          echo "Data Berhasil Dihapus" ;
      }
  }

  public function commitUpdate($table, $set, $unique) {
      $qUpd = $this->db->update($table, $set, $unique) ;

      if ($qUpd) {
        echo json_encode(["msg" => "Data Berhasil DiUpdate", "sts" => "v"]) ;
      }
  }

}

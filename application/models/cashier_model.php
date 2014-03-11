<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cashier_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	//query if idNumber is in the database , return id number
	public function isInDatabase($idNumber){
	
		$query = $this->db->query("	SELECT studphone
									FROM student
									WHERE studid = '$idNumber'
									");
		return $query;
	}
	
	public function subscribeStudent($idNumber){
		$this->db->query("UPDATE waitinglist
						  SET subscribed = TRUE
						  WHERE studid ='$idNumber'
						  ");
	}
		
	public function isSubscribed($idNumber){
		$query = $this->db->query("	SELECT subscribed
									FROM waitinglist
									WHERE studid = '$idNumber'
									");
		return $query;
	}

	public function getCashier($cashierId) {
		$query = $this->db->query("SELECT * FROM cashier WHERE cashierid = '$cashierId'");
		return $query;
	}
}
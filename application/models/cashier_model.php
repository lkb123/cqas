<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cashier_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
	
	}
	

	//query if idNumber is in the database , return boolean
	public function isInDatabase($idNumber)
	{
	
		$query = $this->db->query("	SELECT studphone
									FROM student
									WHERE studid = '$idNumber'
									");
		return $query;
	}
	
}


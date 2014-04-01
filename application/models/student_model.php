<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class student_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function isInDatabase($idNumber)
	{
	
		$query = $this->db->query("SELECT studid
									FROM student
									WHERE studid = '$idNumber'
									");
		return $query;
	}

	public function getStudent($idNumber) {

		$query = $this->db->query(" SELECT * FROM student WHERE studid = '$idNumber'");
		return $query;
	}


}


<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class student_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function isInDatabase($idNumber)
	{
	
		$query = $this->db->query("	SELECT studid
									FROM student
									WHERE studid = '$idNumber'
									");
		return $query;
	}
	
	public function getStudPhone($idNumber){
		
		$query = $this->db->query(" SELECT studphone 
									FROM student 
									WHERE studid = '$idNumber'
									");
		return $query;
	}
	
	public function getStudCourse($idNumber){
		
		$query = $this->db->query(" SELECT course
									FROM student 
									WHERE studid = '$idNumber'
									");
		return $query;
	}

	public function getStudCollege($idNumber){
		
		$query = $this->db->query(" SELECT college 
									FROM student 
									WHERE studid = '$idNumber'
									");
		return $query;
	}
	
	public function getStudLName($idNumber){
		
		$query = $this->db->query(" SELECT lastname
									FROM student 
									WHERE studid = '$idNumber'
									");
		return $query;
	}
	
	public function getStudGName($idNumber){
		
		$query = $this->db->query(" SELECT givenname 
									FROM student 
									WHERE studid = '$idNumber'
									");
		return $query;
	}
	
	public function getStudMName($idNumber){
		
		$query = $this->db->query(" SELECT middlename 
									FROM student 
									WHERE studid = '$idNumber'
									");
		return $query;
	}

	public function getValidity($idNumber) {
		return $this->db->query("SELECT valid FROM student WHERE studid = '$idNumber'");
	}

	public function updateStudCell($idNumber, $newCell) {
		$this->db->query("UPDATE student SET studphone = '$newCell' WHERE studid = '$idNumber'");
	}

	public function updateValidity($idNumber, $value) {
		if($value)
			$this->db->query("UPDATE student SET valid = TRUE WHERE studid = '$idNumber'");
		else
			$this->db->query("UPDATE student SET valid = FALSE WHERE studid = '$idNumber'");
	}

}


<?php
	
	include_once(APPPATH . 'controllers/classes/Person.php');
	
	class Student extends Person {
	
		private $CI;
		
		public function __construct() {
			//parent::__construct();
			$this->CI =& get_instance();
			$this->CI->load->model('student_model','SM');
			$this->CI->load->model('cashier_model', 'CM');
			$this->CI->load->model('waitinglist_model', 'WM');
		}

		public function getIdNumber($idNumber) {
			return $this->retrieveStudent($idNumber)['studid'];
		}

		public function getLastName($idNumber) {
			return $this->retrieveStudent($idNumber)['lastname'];
		}

		public function getGivenName($idNumber) {
			return $this->retrieveStudent($idNumber)['givenname'];
		}

		public function getMiddleName($idNumber) {
			return $this->retrieveStudent($idNumber)['middlename'];
		}

		public function getCourse($idNumber) {
			return $this->retrieveStudent($idNumber)['course'];
		}

		public function getCollege($idNumber) {
			return $this->retrieveStudent($idNumber)['college'];
		}

		public function retrieveStudent($idNumber) {
			return $this->CI->SM->getStudent($idNumber)->row_array();
		}
		
		public function studentIsValid($idNumber) {
			$query = $this->CI->WM->getValidity($idNumber);
			
			if($query->num_rows() == 0)
				return true;
			else
				return false;
		}

	}

?>
<?php
	
	//require 'Person.php';
	
	class Student {
	
		private $CI;
		private $student;
		
		public function __construct() {
			//parent::__construct();
			$this->CI =& get_instance();
			$this->CI->load->model('student_model','SM');
			$this->CI->load->model('cashier_model', 'CM');
			$this->CI->load->model('waitinglist_model', 'WM');
		}

		public function getLastName() {
			return $this->retrieveStudent()['lastname'];
		}

		public function getGivenName() {
			return $this->retrieveStudent()['givenname'];
		}

		public function getMiddleName() {
			return $this->retrieveStudent()['middlename'];
		}

		public function getCourse() {
			return $this->retrieveStudent()['course'];
		}

		public function getCollege() {
			return $this->retrieveStudent()['college'];
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
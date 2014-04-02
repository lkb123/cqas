<?php
	
	include_once(APPPATH . 'controllers/classes/Person.php');
	
	class Cashier {
		
		private $CI;
		
		 public function __construct() {
			$this->CI =& get_instance();
			$this->CI->load->model('student_model','SM');
			$this->CI->load->model('cashier_model', 'CM');
			$this->CI->load->model('waitinglist_model', 'WM');
		 }

		 public function getIdNumber($idNumber) {
			return $this->retrieveCashier($idNumber)['cashierid'];
		}

		public function getLastName($idNumber) {
			return $this->retrieveCashier($idNumber)['lastname'];
		}

		public function getGivenName($idNumber) {
			return $this->retrieveCashier($idNumber)['givenname'];
		}

		public function getMiddleName($idNumber) {
			return $this->retrieveCashier($idNumber)['middlename'];
		}
		
		//if flag is 1 serving is true, served is false
		//if flag is 0 serving is false, served is true
		public function serve($flag, $idNumber) {
			if($flag >= 0 && $flag <= 1) {
				if($flag == 1) {
					$this->updateServingEntry($idNumber, true);
				}
				else if($flag == 0) {
					$this->updateServingEntry($idNumber, false);
					$this->updateServedEntry($idNumber);
				}
			}
		}

		private function updateServingEntry($idNumber, $value) {
			$this->CI->WM->updateServing($idNumber, $value);
		}

		private function updateServedEntry($idNumber) {
			$this->CI->WM->updateServed($idNumber);
			$this->CI->WM->updateDateServed($idNumber);
			$this->CI->WM->updateTimeServed($idNumber);
		}

		public function retrieveCashier($cashierId) {
			 return $this->CI->CM->getCashier($cashierId)->row_array();	
		}	

		 public function login($cashierId, $password) {
		 	$result = $this->retrieveCashier($cashierId);
		 	if(count($result) == 0)
		 		return FALSE;

		 	if($result['cashierpass'] == $password) {
		 		return TRUE;
		 	}
		 	else {
		 		return FALSE;
		 	}
		 }
		
	 }
 
 ?>
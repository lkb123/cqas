<?php

	class Cashier {
		
		private $CI;
		private $cashier;
		
		 public function __construct() {
			$this->CI =& get_instance();
			$this->CI->load->model('student_model','SM');
			$this->CI->load->model('cashier_model', 'CM');
			$this->CI->load->model('waitinglist_model', 'WM');
		 }

		public function getIdNumber() {
			return $this->cashier['cashierid'];
		}

		public function getLastName() {
			return $this->cashier['lastname'];
		}

		public function getGivenName() {
			return $this->cashier['givenname'];
		}

		public function getMiddleName() {
			return $this->cashier['middlename'];
		}

		public function getPassword() {
			return $this->cashier['cashierpass'];
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
					$this->updateServedEntry();
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
			 $this->cashier = $this->CI->CM->getCashier($cashierId)->row_array();	
		}	
		
	 }
 
 ?>
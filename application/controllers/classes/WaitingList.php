<?php

	class WaitingList {

		//private $list;
		private $CI;

		public function __construct() {
			//$this->list = array();
			$this->CI = &get_instance();
			$this->CI->load->model('waitinglist_model', 'WM');
			$this->CI->load->helper('cookie');
			//date_default_timezone_set("Asia/Manila"); dili man tingale ta need mag timezone		
		}


		public function append($id_number,$phoneNum) {
			$pNumber = $this->generatePriorityNumber(); //generate priority number
			//$timeAdded = date('Y-m-d H:i:s');	giwala na nako ni kay pwede ra man sa query deretso
			$this->CI->WM->addStudent($id_number, $pNumber, $phoneNum);
		}

		//deprecated
		public function countEntries() {
			$count = $this->CI->WM->countAllEntries();
			return $count['studentcount'];
		}

		public function clearList() {
			$this->CI->WM->clearWaitingList();
		}

		//deprecated
		public function retrieveAStudent($idNumber) {
			$entry = $this->CI->WM->getStudent($idNumber);
			return $entry->row();
		}
		
		//deprecated
		public function retrieveNthStudent($n) {
			
			if($n > $this->countEntries() && $n <= 999)
				throw new Exception('Error: the number of entries in the waiting list is less than ' .  $n);
			$result = $this->CI->WM->retrieveNthEntry($n)->row();
			return $result;
		}

		public function studentIsValid($idNumber) {
			$query = $this->CI->WM->getValidity($idNumber);
			
			if($query->num_rows() == 0)
				return true;
			else
				return false;
		}

		public function retrieveFifteenStudents() {
			$data = $this->CI->WM->getFifteenStudents();
			//echo var_dump($data->result_array());
			return $data->result_array();
		}

		public function getFirstStudentAvailable() {
			$data = $this->CI->WM->getFirstAvalableStudent();
			return $data->row_array();
		}

		public function updateServingEntry($idNumber) {
			$this->CI->WM->updateServing($idNumber);
		}

		/*
		 * Private methods
		 */

		private function generatePriorityNumber() {
			//var_dump($this->CI->input->cookie('pnumber', TRUE));
			$pnumber = $this->CI->input->cookie('pnumber', TRUE);
			if($pnumber > 999)
				$pnumber = 0;
			$result = $pnumber + 1;
			$cookie_settings = array(
				'name'   => 'pnumber',
                'value'  => "$result",
                'expire' =>  100000,
                'secure' => false
				);
			$this->CI->input->set_cookie($cookie_settings);
			return $result;
		}
		
	}

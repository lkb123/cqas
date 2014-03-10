<?php

	class WaitingList {

		//private $list;
		private $CI;

		public function __construct() {
			//$this->list = array();
			$this->CI = &get_instance();
			$this->CI->load->model('waitinglist_model', 'WM');
			$this->CI->load->helper('cookie');
			date_default_timezone_set("Asia/Manila");		
		}


		public function append($id_number) {
			$pNumber = $this->generatePriorityNumber(); //generate priority number
			$timeAdded = date('Y-m-d H:i:s');	//get the current time
			$this->CI->WM->addStudent($id_number, $pNumber, $timeAdded);
		}

		public function countEntries() {
			$count = $this->CI->WM->countAllEntries();
			return $count['studentcount'];
		}

		public function clearList() {
			$this->CI->WM->clearWaitingList();
		}

		public function retrieveAStudent($idNumber) {
			$entry = $this->CI->WM->getStudent($idNumber);
			return $entry->row();
		}
		

		public function retrieveNthStudent($n) {
			
			if($n > $this->countEntries() && $n <= 999)
				throw new Exception('Error: the number of entries in the waiting list is less than ' .  $n);
			$result = $this->CI->WM->retrieveNthEntry($n)->row();
			return $result;
		}
		/*
			Created by Sherwin, for test cases 5
		*/
		
		public function getCurrentlyServedStudent(){
			//return $this->list[1];
		}
		
		public function getNextWaitingStudent(){
			//return $this->list[2];
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

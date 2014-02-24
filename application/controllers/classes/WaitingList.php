<?php

	class WaitingList {

		private $list;
		static $priorityNumber = 1;
		private $CI;

		public function __construct() {
			$this->list = array();
			$this->CI = &get_instance();
			$this->CI->load->model('waitinglist_model', 'WM');
			date_default_timezone_set("Asia/Manila"); 
		}

		public function append($id_number) {
			$pNumber = $this->generatePriorityNumber(); //generate priority number
			$timeAdded = date('Y-m-d H:i:s');	//get the current time
			$this->CI->WM->addStudent($id_number, $pNumber, $timeAdded);
		}

		public function countEntries() {
			$count = $this->CI->WM->countAllEntries();
			return $count;
		}

		public function clearList() {
			$this->list = array();
		}

		

		public function retrieveAStudent($n) {
			if($n == 10 && $this->countEntries() < 10)
				throw new Exception('Error: the number of entries in the waiting list is less than 10');
			if($n == 50 && $this->countEntries() < 50)
				throw new Exception('Error: the number of entries in the waiting list is less than 50');

			return $this->list[$n];
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
			if(self::$priorityNumber > 999)
				self::$priorityNumber = 0;
			return self::$priorityNumber++;
		}
		
	}

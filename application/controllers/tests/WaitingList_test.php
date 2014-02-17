<?php
	include('/../classes/WaitingList.php');
	
	class WaitingList_test extends CI_Controller {

		private $waitingList;

		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');
			$this->waitingList = new WaitingList();
			
			for($i = 1000; $i < 1999; $i++) {
				$rightNumber = $i;
				$id_number = "2010-" . strval($rightNumber);
				$this->waitingList->append($id_number);
			}

		}

		/**
		 * Test Case 4.1 test
		 * waitinglist has 4 entries, thus the countEntries function should
		 * return 4
		 */
		public function waitingListHasNEntries() {
			$result = $this->waitingList->countEntries();
			$expected = 999;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}

		/**
		 * Test Case 4.2 test
		 * waitinglist has no entries, thus the countEntries function should
		 * return 0
		 */
		public function waitingListHas0Entries() {
			$this->waitingList->clearList();	//ensure that waiting list is empty
			$result = $this->waitingList->countEntries();
			$expected = 0;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}

		/**
		 * Test Case 2.1 test
		 * check the priority number printed
		 * the waiting list has 999 entries
		 */
		public function generatePriorityNumberWith999Entries() {
			$result = $this->waitingList->generatePriorityNumber();
			$expected = 999;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}

		/**
		 * Test Case 2.1 test
		 * check the priority number printed
		 * the waiting list has more than999 entries
		 */
		public function generatePriorityNumberWithMoreThan999Entries() {
			$this->waitingList->append('2011-0061');
			$result = $this->waitingList->generatePriorityNumber();
			$expected = 1;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}
	}
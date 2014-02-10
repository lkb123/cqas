<?php
	include('/../classes/WaitingList.php');
	
	class WaitingList_test extends CI_Controller {

		private $waitingList;

		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');
			$this->waitingList = new WaitingList();
		}

		/**
		 * Test Case 4.1 test
		 * waitinglist has 4 entries, thus the countEntries function should
		 * return 4
		 */
		public function waitingListHas4Entries() {
			$this->waitingList->append('2010-1730');
			$this->waitingList->append('2006-1555');
			$this->waitingList->append('2010-6855');
			$this->waitingList->append('2010-1532');
			
			$result = $this->waitingList->countEntries();
			$expected = 4;
			$this->unit->run($result, $expected);
			$this->waitingList->clearList();
			$this->load->view('test');
		}

		/**
		 * Test Case 4.2 test
		 * waitinglist has no entries, thus the countEntries function should
		 * return 0
		 */
		public function waitingListHas0Entries() {
			$result = $this->waitingList->countEntries();
			$expected = 0;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}
	}
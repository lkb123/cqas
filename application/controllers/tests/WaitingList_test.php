<?php
	include '/../classes/WaitingList.php';

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
		 * Test Case 2 test
		 * check the priority number printed
		 * the waiting list at first has 999 entries
		 * the waiting list then has 1000 entries, thus the priority number loops back
		 * to 1
		 */
		public function generatePriorityNumberWithMoreThanOrEqualTo999Entries() {
			$result = $this->waitingList->generatePriorityNumber();
			$expected = 999;
			$this->unit->run($result, $expected);

			$this->waitingList->append('2011-0061');
			$result = $this->waitingList->generatePriorityNumber();
			$expected = 1;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}

		/**
		 * Test Case 2 test
		 * check the priority number printed
		 * the waiting list has 1 entry
		*/
		public function generatePriorityNumberWithLessThan999Entries() {
			$this->waitingList->clearList();
			$this->waitingList->append('2010-1730');
			$result = $this->waitingList->generatePriorityNumber();
			$expected = 1;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}

		/**
		 * Test on retrieving the 10th and 50th student respectively in the waiting list
		 */
		public function retrieveNthStudentInTheWaitingList() {
			try {
				$student10 = $this->waitingList->retrieveAStudent(10);
				$student50 = $this->waitingList->retrieveAStudent(50);

				$student10Expected = "2010-1010";
				$student50Expected = "2010-1050";
				$this->unit->run($student10, $student10Expected);
				$this->unit->run($student50, $student50Expected);
				$this->load->view('test');
			} catch(Exception $e) {
				$this->unit->run(0, 1); //fail
			}
		}

		/**
		 * Test on retrieving the 10th and 50th student respectively in the waiting list
		 */
		
		public function retrieveNthStudentInTheWaitingListWithException() {
			$this->waitingList->clearList();

			try {
				$student10 = $this->waitingList->retrieveAStudent(10);
				echo $this->unit->run(0,1); //fail
			} catch(Exception $e) {
				$student10Expected = 'Error: the number of entries in the waiting list is less than 10';
				$this->unit->run($e->getMessage(), $student10Expected); 
			}

			try {
				$student50 = $this->waitingList->retrieveAStudent(50);
				echo $this->unit->run(0,1); //fail
			} catch(Exception $e) {
				$student50Expected = 'Error: the number of entries in the waiting list is less than 50';
				$this->unit->run($e->getMessage(), $student50Expected); 
			}
			$this->load->view('test');
		}
		
	}
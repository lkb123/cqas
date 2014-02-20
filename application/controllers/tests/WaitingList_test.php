<?php
	include '../classes/WaitingList.php';

	class WaitingList_test extends CI_Controller {

		private $waitingList;

		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');
			$this->waitingList = new WaitingList();
			

			for($i = 1000; $i < 1999; $i++) {
				$rightNumber = $i;
				$id_number = "2010-" . strval($rightNumber);
				$this->waitingList->append(array($id_number, '09058943510'));
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
		 * thus the priority number loops back
		 * to 1 and so on
		 */
		public function generatePriorityNumberWithMoreThan999Entries() {
			$result = $this->waitingList->generatePriorityNumber();
			$expected = 1;
			$this->unit->run($result, $expected);

			$this->waitingList->append(array('2011-0061', '09058943510'));
			$result = $this->waitingList->generatePriorityNumber();
			$expected = 2;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}

		/**
		 * Test Case 2 test
		 * check the priority number printed
		 * the priority number generated is 1 and so on
		*/
		public function generatePriorityNumberWithLessThan999Entries() {
			$this->waitingList->clearList();
			$this->waitingList->append(array('2010-1730', '09058943510'));
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
				$this->unit->run($student10[0], $student10Expected);
				$this->unit->run($student50[0], $student50Expected);
				$this->load->view('test');
			} catch(Exception $e) {
				$this->unit->run(0, 1); //fail
			}
		}

		/**
		 * Test on retrieving the 10th and 50th student respectively in the waiting list
		 */
		
		public function retrieveNthStudentInTheWaitingListWithException($n) {
			$this->waitingList->clearList();

			try {
				$student = $this->waitingList->retrieveAStudent($n);
				echo $this->unit->run(0,1); //fail
			} catch(Exception $e) {
				$studentExpected = 'Error: the number of entries in the waiting list is less than ' . $n;
				$this->unit->run($e->getMessage(), $studentExpected); 
			}

			$this->load->view('test');
		}
		
	}
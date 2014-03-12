<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	include(basename(dirname('classes/WaitingList.php')) . '/WaitingList.php');

	class WaitingList_test extends CI_Controller {

		private $waitingList;

		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');
			$this->load->helper('cookie');
			$this->waitingList = new WaitingList();
		}

		public function init() {
			$cookie_settings = array(
				'name'   => 'pnumber',
                'value'  => '0',
                'expire' =>  100000,
                'secure' => false
				);			
			echo 'done';
			$this->input->set_cookie($cookie_settings);	
		}

		public function addID($idNumber) {
			$this->waitingList->append($idNumber);
		}
		

		/*
		 *	refactored:
		 *	waitingListHasNEntries()
		 *  waitingListHas0Entries()
		 */
		public function countEntriesInWaitingList($expected) {
			$result = $this->waitingList->countEntries();
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}

		//deprecated
		/**
		 * Test Case 4.1 test
		 * counts the number of entries in the waiting list
		 * return N where N is the number of entries
		 */
		public function waitingListHasNEntries() {
			$result = $this->waitingList->countEntries();
			$expected = 2;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}

		//deprecated
		/**
		 * Test Case 4.2 test
		 * when the waiting list has no entries
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
		 * for a given student, a priority number relative to 
		 * 	his place in the waiting list is generated
		 */
		public function priorityNumberGenerated($idNumber, $pNumber) {
			$entry = $this->waitingList->retrieveAStudent($idNumber);
			$result = $entry->prioritynumber;
			$this->unit->run($result, $pNumber);
			$this->load->view('test');
		}

		/**
		 * Test on retrieving the 10th and 50th student respectively in the waiting list
		 */
		public function retrieveNthStudentInTheWaitingList($pnumber, $expected) {
			try {
				$result = $this->waitingList->retrieveNthStudent($pnumber)->studid;
				$this->unit->run($result, $expected);
			} catch(Exception $e) {
				$this->unit->run(0, 1); //fail
			}
			$this->load->view('test');
		}

		/**
		 * Test on retrieving the 10th and 50th student respectively in the waiting list
		 */
		
		public function retrieveNthStudentInTheWaitingListWithException($n) {
			$this->waitingList->clearList();
			try {
				$student = $this->waitingList->retrieveNthStudent($n);
				$this->unit->run(0,1); //fail
			} catch(Exception $e) {
				$studentExpected = 'Error: the number of entries in the waiting list is less than ' . $n;
				$this->unit->run($e->getMessage(), $studentExpected); 
			}
			$this->load->view('test');
		}
		/**
		* Test Case 5 test
		* check the waiting list if empty
		* retrieve student information
		*/
		public function waitingListIsEmpty() {
			$this->waitingList->clearList();
			$result = $this->waitingList->countEntries();
			$expected = 0;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}
		
		public function checkNextWaitingStudent(){
			//$result = $this->waitingList->getNextWaitingStudent();
			//$idNum = '2010-1001'
			//$this->unit->run($result, $expected);
			//$this->load->view('test');
		}

		//check if student is Valid to be added in waitingList
		public function isStudentValidToQueue(){
			$result = $this->waitingList->studentIsValid('2010-1111');
			$expected = false;
			$this->unit->run($result, $expected);
			$this->load->view('test');	
		}
		
	}
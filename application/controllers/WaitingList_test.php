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
                'value'  => '1',
                'expire' =>  100000,
                'secure' => false
				);			
			echo 'done';
			$this->input->set_cookie($cookie_settings);	
		}

		public function generatePriorityNumber($currentNumber, $nextNumber) {
			$cookie_settings = array(
				'name' => 'pnumber',
				'value' => "$currentNumber",
				'expire' =>  100000,
                'secure' => false
				);
				$this->input->set_cookie($cookie_settings);	
				$pnumber = $this->waitingList->generatePriorityNumber();
				$this->unit->run($pnumber, $nextNumber);
				$this->input->set_cookie($cookie_settings);	
				$this->load->view('test');
		}

		public function addID($idNumber) {
			$this->waitingList->append($idNumber);
		}
		

		/*
		 * 	count unserved students in the waiting list
		 *	refactored:
		 *	waitingListHasNEntries()
		 *  waitingListHas0Entries()
		 */
		public function countEntriesInWaitingList($expected) {
			$result = $this->waitingList->countUnservedEntries();
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}

		/*
		 *	Get the next student to be served by the cashier
		 *  Use Case 5
		 */
		public function getNextStudentTest($expected = '') {
			$result = $this->waitingList->getFirstStudentAvailable();
			if(count($result) == 0)
				$this->unit->run(true, true);
			else 
				$this->unit->run($expected, $result['studid']);
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

		//check if student is Valid to be added in waitingList
		public function isStudentValidToQueue($idNumber, $expected){
			$result = $this->waitingList->studentIsValid($idNumber);
			$bool = $expected == "true" ? true : false;
			$this->unit->run($result, $bool);
			$this->load->view('test');	
		}
		
		//retrieve 10th student in the waiting list
		public function get10thStudent() {
			$result = $this->waitingList->get10thStudent();
			$expected = "2011-1234";
			$this->unit->run($result['studid'], $expected);
			$this->load->view('test');
		}

		public function get10thStudentFail() {
			$result = $this->waitingList->get10thStudent();
			$expected = false;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}

		//retrieve 50th student, but currently using 11th student due to lack of entries in database
		public function get50thStudent() {
			$result = $this->waitingList->get50thStudent();
			$expected = "2010-3456";
			$this->unit->run($result['studid'], $expected);
			$this->load->view('test');
		}

		public function get50thStudentFail() {
			$result = $this->waitingList->get50thStudent();
			$expected = false;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}

	}
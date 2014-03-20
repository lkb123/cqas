<?php

	include(basename(dirname('classes/Student.php')) . '/Student.php');
	include(basename(dirname('classes/Cashier.php')) . '/Cashier.php');
	
	class data_controller extends CI_Controller {

		private $student;
		private $cashier;
		private $waitinglist;

		public function __construct() {
			parent::__construct();
			$this->cashier = new Cashier();
			$this->student = new Student();
			$this->waitinglist = new Waitinglist();
		}

		
		public function getStudentDetails($idNumber) {
			$result = $this->student->retrieveStudent($idNumber);
		}

		public function getCashierDetails($cashierId) {
			$result = $this->cashier->retrieveCashier($cashierId);
		}

		public function getFifteenStudents(){
			$result = $this->waitingList->retrieveFifteenStudents();
			echo var_dump($result);
		}


		
	}
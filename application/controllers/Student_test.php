<?php

	include(basename(dirname('classes/Student.php')) . '/Student.php');	
	include(basename(dirname('classes/Cashier.php')) . '/Cashier.php');
	
	class Student_test extends CI_Controller {

		private $student;
		private $cashier;

		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');
			$this->student = new Student();
			$this->cashier = new Cashier();		
		}
		
		//update the stud cell# test
		public function isStudCellNumUpdated(){
			$this->student->updateStudPhone('2010-1111','09059366722');
			$result = $this->cashier->idNumberExist('2010-1111');
			$expected = '09059366722';
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}

		//check if student is Valid to be added in waitingList
		public function isStudentValidToQueue(){
			$this->student->updateStudentValidity('2010-1111', true);
			$result = $this->student->studentIsValid('2010-1111');
			$expected = "f";
			$this->unit->run($result, $expected);
			$this->load->view('test');	
		}
		
		//check if student Validty updated
		public function isStudValidityUpdated(){
			$this->student->updateStudentValidity('2010-1111', false);
			$result = $this->student->studentIsValid('2010-1111');
			$expected = "t";
			$this->unit->run($result, $expected);
			$this->load->view('test');	
		}
		
		
	}
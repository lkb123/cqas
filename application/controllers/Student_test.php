<?php

	include(basename(dirname('classes/Student.php')) . '/Student.php');
	include(basename(dirname('classes/Cashier.php')) . '/Cashier.php');
	
	class Student_test extends CI_Controller {

		private $student;
		private $cashier;
		//private $stud;

		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');
			//$this->cashier = new Cashier();
			$this->student = new Student();
		}

		public function getStudentCredentials($idNumber) {
			$expectedLastName = "Basay";
			$expectedGivenName = "Louie Kert";
			$expectedMiddleName = "Suan";
			$expectedCourse = "Bachelor in Science in Computer Science";
			$expectedCollege = "School of Computer Studies";
			$this->unit->run($this->student->getLastName($idNumber), $expectedLastName);
			$this->unit->run($this->student->getGivenName($idNumber), $expectedGivenName);
			$this->unit->run($this->student->getMiddleName($idNumber), $expectedMiddleName);
			$this->unit->run($this->student->getCourse($idNumber), $expectedCourse);
			$this->unit->run($this->student->getCollege($idNumber), $expectedCollege);
			$this->load->view('test');
		}

		public function studentValidityTest($idNumber, $expected) {
			$validity = ($expected == "t" ? true : false);
			$result = $this->student->studentIsValid($idNumber);
			$this->unit->run($result, $validity);
			$this->load->view('test');
		}
		
	}
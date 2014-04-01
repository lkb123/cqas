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
			$this->student->retrieveStudent('2010-1730');
		}

		public function getStudentCredentials() {
			$expectedLastName = "Basay";
			$expectedGivenName = "Louie Kert";
			$expectedMiddleName = "Suan";
			$expectedCourse = "Bachelor in Science in Computer Science";
			$expectedCollege = "School of Computer Studies";
			$this->unit->run($this->student->getLastName(), $expectedLastName);
			$this->unit->run($this->student->getGivenName(), $expectedGivenName);
			$this->unit->run($this->student->getMiddleName(), $expectedMiddleName);
			$this->unit->run($this->student->getCourse(), $expectedCourse);
			$this->unit->run($this->student->getCollege(), $expectedCollege);
			$this->load->view('test');
		}
		
	}
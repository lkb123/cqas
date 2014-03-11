<?php
	include(basename(dirname('classes/Student.php')) . '/Student.php');
	
	class Student_test extends CI_Controller {

		private $student;

		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');
			$this->student = new Student();
		}

		

	}
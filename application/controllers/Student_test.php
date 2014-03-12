<?php

	include(basename(dirname('classes/Student.php')) . '/Student.php');
	include(basename(dirname('classes/Cashier.php')) . '/Cashier.php');
	
	class Student_test extends CI_Controller {

		private $student;
		private $cashier;

		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');
		}

		
	}
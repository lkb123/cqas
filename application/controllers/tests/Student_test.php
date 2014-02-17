<?php
	include("/../classes/Student.php");
	
	class Student_test extends CI_Controller {

		private $cashier;

		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');
			$this->cashier = new Cashier();
		}

	}
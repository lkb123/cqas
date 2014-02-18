<?php
	
	include '/../classes/Cashier.php';
	
	class Cashier_test extends CI_Controller {
		
		private $cashier;

		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');	
			$this->cashier = new Cashier();

		}
			
		
		//Test 1.1 if idNumber format is valid
		public function validID(){
			$result = $this->cashier->validID('1231-1111');
			$expected = 1;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}
	
				
		//Test 1.2 if idNumber format is valid
		public function validID1(){
			$result = $this->cashier->validID('1111-aaaa');
			$expected = 0;
			$this->unit->run($result, $expected);
			$this->load->view('test'); 	
		}
		
		//Test 1.3 if idNumber is id the database return false
		public function idIsInDatabase(){
		
			$result = $this->cashier->getPhoneNumber('2010-431');
			$expected = false;
			$this->unit->run($result, $expected);
			$this->load->view('test'); 
			
		}
		
		//Test 1.4 if idNumber is in database return phoneNumber
		public function idIsInDatabase1(){
		
			$result = $this->cashier->getPhoneNumber('2010-1234');
			$expected = "09059366722";
			$this->unit->run($result, $expected);
			$this->load->view('test'); 
			
		}

		
	
	}
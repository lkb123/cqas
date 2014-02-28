<?php
	
	include(basename(dirname('classes/Cashier.php')) . '/Cashier.php');

	
	class Cashier_test extends CI_Controller {
		
		private $cashier;

		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');	
			$this->cashier = new Cashier();

		}

		public function index() {
			echo 'hello';
		}
			
		
		//Test 1.1 if idNumber format is valid return 1
		public function validID(){
			$result = $this->cashier->validID('1231-1111');
			$expected = 1;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}
	
				
		//Test 1.2 if idNumber format is invalid return 0
		public function validID1(){
			$result = $this->cashier->validID('1111-aaaa');
			$expected = 0;
			$this->unit->run($result, $expected);
			$this->load->view('test'); 	
		}
		
		//Test 1.3 if idNumber is not in the database return false
		public function idNumberExist(){
		
			$result = $this->cashier->idNumberExist('2010-1111');
			$expected = false;
			$this->unit->run($result, $expected);
			$this->load->view('test');
			
		}
		
		//Test 1.4 if idNumber is in database return phoneNumber
		//test 3.1 if student phoneNumber exist, return phoneNumber
		public function idNumberExist1(){
		
			$result = $this->cashier->idNumberExist('2010-1234');
			$expected = "09059366722";
			$this->unit->run($result, $expected);
			$this->load->view('test'); 
			
		}
		
		//test 3.1 if student phoneNumber doest not exist, return NULL
		public function getPhoneNumber(){
		
			$result = $this->cashier->idNumberExist('2005-1555');
			$expected = NULL ;
			$this->unit->run($result, $expected);
			$this->load->view('test'); 
			
		}
		
		//Test 3.5 if phoneNumber format is valid return 1
		public function phoneIsValid(){
			$result = $this->cashier->validPhoneNumber('09234552996');
			$expected = TRUE;
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}
		
		//test 3.3 if student select to subscribed, mark student as subscribed
		
		public function studentIsSubscribed(){
			$this->cashier->subscribeStudent('2005-1555');
			$result = $this->cashier->isSubscribed('2005-1555');
			$expected = 't';
			$this->unit->run($result, $expected);
			$this->load->view('test');	
		}
		//test 3.4 if student select not to subscribed, student is not marked as subscribed
		public function studentIsSubscribed1(){
			$result = $this->cashier->isSubscribed('2005-1555');
			$expected = 'f';
			$this->unit->run($result, $expected);
			$this->load->view('test');	
		}
	
	}
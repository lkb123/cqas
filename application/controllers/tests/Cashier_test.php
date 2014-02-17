<?php
	
	include '/../classes/Cashier.php';
	
	class Cashier_test extends CI_Controller {
		
		private $cashier;

		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');	
			$this->cashier = new Cashier();

		}
		
		public function index(){
			echo "hello";
		}
		
		//Test 1.1 if form is empty return 0
		public function isEmpty(){

			$result = $this->cashier->encode('');
			$expected = 0;
			$this->unit->run($result, $expected);
			$this->load->view('test'); 
			echo "result = ".$result;
		}
		
		//Test 1.2 if form is notEmpty return 1
		public function isEmpty1(){

			$result = $this->cashier->encode('1111');
			$expected = 1;
			$this->unit->run($result, $expected);
			$this->load->view('test');
			
			echo "result = ".$result;
		}
		
		//Test 1.3 if idNumber != 4 characters return 0
	    public function hasFourChar(){

			$result = $this->cashier->encode('111');
			$expected = 0;
			$this->unit->run($result, $expected);
			$this->load->view('test');
			
			echo "result = ".$result;
		}
	    
		//Test 1.3 if idNumber has 4 characters return 1
		public function hasFourChar1(){

			$result = $this->cashier->encode('1111');
			$expected = 1;
			$this->unit->run($result, $expected);
			$this->load->view('test');
			
			echo "result = ".$result;
		}
		
		
		//Test 1.4 if idNumber include letters return 0
		public function digitOnly(){
			$result = $this->cashier->encode('as12');
			$expected = 0;
			$this->unit->run($result, $expected);
			$this->load->view('test');

			echo "result".$result;
		}
	
				
		//Test 1.4 if idNumber does not have letters return 1
		public function digitOnly1(){
			$result = $this->cashier->encode('1111');
			$expected = 1;
			$this->unit->run($result, $expected);
			$this->load->view('test'); 	
		}
		
		//Test 1.5 if idNumber is id the database return 1
		public function idIsInDatabase(){
		
			$result = $this->cashier->idNumberExist('20101234');
			$expected = 1;
			$this->unit->run($result, $expected);
			$this->load->view('test'); 
			
		}
	
	}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	include(basename(dirname('classes/Cahier.php')) . '/Cashier.php');
	include(basename(dirname('classes/WaitingList.php')) . '/WaitingList.php');
	include(basename(dirname('classes/Student.php')) . '/Student.php');
	
	class mainframe extends CI_Controller {
		private $cashier;
		private $waitingList;
		private $student;

		public function __construct() {
			parent::__construct();
			$this->load->helper(array('url', 'form', 'html', 'cookie'));
			$this->cashier = new Cashier();
			$this->waitingList = new WaitingList();
			$this->student = new Student();
		}
		
		public function index(){
			$cookie_settings = array(
				'name'   => 'pnumber',
                'value'  => '0',
                'expire' =>  100000,
                'secure' => false
				);			


			$this->input->set_cookie($cookie_settings);	

			$cashier_cookie = array (
					'name'   => 'cashierId',
		            'value'  => 'false',
		            'expire' =>  100000,
		            'secure' => false
					);
			$this->input->set_cookie($cashier_cookie);

			$this->load->view('templates/header_view');
			$this->load->view('home');
			$this->load->view('templates/footer_view');	
		}

		public function studentIndex($page, $message = '', $messageType = '') {
			$data['message'] = $message;
			$this->load->view('templates/header_view', $data);
			$this->load->view('student/' . $page, $data);
			$this->load->view('templates/footer_view');		
		}

		public function cashierIndex($page, $message = '', $messageType = '') {
			$data['message'] = $message;
			$this->load->view('templates/header_view', $data);
			$this->load->view('cashier/' . $page, $data);
			$this->load->view('templates/footer_view');		
		}
		
		public function encode(){
			$idNumber = $this->input->post('idNumber', TRUE);
			if(! $this->cashier->validId($idNumber)) {
				$this->studentIndex('encode_view', 'Error: Please input ID Number again', 'Error');
			}else{
				$query = $this->cashier->idNumberExist($idNumber);
				//var_dump($query);
				if($query === FALSE){
					//if id number is not in the database
					$this->studentIndex('encode_view', 'Error: ID Number not in the database', 'Error');
				}
				else {
					if($this->student->studentIsValid($idNumber) === "t") { //check if student is valid to be added to the waiting list
						$subscribe = ($this->input->post('subscribe') == "true") ? true : false;
						$this->waitingList->append($idNumber);	//append student to waiting list
						$this->student->updateStudentValidity($idNumber, false);
						if($subscribe)
							$this->cashier->subscribeStudent($idNumber);	//subscribe the student if subscribe is true
						$pnumber = $this->input->cookie('pnumber') + 1;	//get priority number
						
						if($query === "") {
							//if id number in database but no cellphone number
							if($subscribe) {
								$stud_cookie = array(
								'name'   => 'idnumber',
		                		'value'  => $idNumber,
		                		'expire' =>  100000,
		                		'secure' => false
								);	

								$this->input->set_cookie($stud_cookie);	
								$this->studentIndex('add_cell_number');
								return;
							}
							else {
								$this->studentIndex('encode_view', "Student Added!!<br>Priority Number: $pnumber");
								return;
							}
						}

						$this->studentIndex('encode_view', "Student Added!!<br>Priority Number: $pnumber");
					}
					else 
						$this->studentIndex('encode_view', "Error: Pending transactions to the cashier available", 'Error');
				}
			}	
		}


		public function encodeWithCellNumber() {
			$cellNumber = $this->input->post('cellNumber');
			$idNumber = $this->input->cookie('idnumber');

			if($this->cashier->validPhoneNumber($cellNumber)) {
				$this->student->updateStudPhone($idNumber, $cellNumber);
				$pnumber = $this->input->cookie('pnumber');	//get priority number
				delete_cookie('idnumber');
				$this->studentIndex('encode_view', "Student Added!!<br>Priority Number: $pnumber");
			}
			else {
				$this->studentIndex('add_cell_number', 'Invalid Cellphone Number. Please enter again');
			}
		}

		public function login() {
			$cashierId = $this->input->post('cashierid');
			$password = $this->input->post('cashierpass');

			$status = $this->cashier->login($cashierId, $password);
			if($this->input->cookie('cashierId') != false) {
				if($status) {
					$cashier_cookie = array (
						'name'   => 'cashierId',
			            'value'  => $cashierId,
			            'expire' =>  100000,
			            'secure' => false
						);

						$this->input->set_cookie($cashier_cookie);
						$this->cashierIndex('cashier_home');
				}
				else {
					$this->cashierIndex('cashier_login', 'Error: Invalid ID number or password', 'Error');
				}
			}
			else {
				$this->cashierIndex('cashier_login');
			}
		}

		public function logout() {
			$cashierId = $this->input->cookie('cashierId');
			$status = $this->cashier->logout($cashierId);
			if($this->input->cookie('cashierId') != false) {
				if($status) {
					$cashier_cookie = array (
						'name'   => 'cashierId',
			            'value'  => 'false',
			            'expire' =>  100000,
			            'secure' => false
						);

						$this->input->set_cookie($cashier_cookie);
						$this->cashierIndex('cashier_login');
				}
				else {
					$this->cashierIndex('cashier_login');
				}
			}
			else {
				$this->cashierIndex('cashier_login');
			}
		}

	}

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

		public function cashierIndex($page, $message = '') {
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
				/*else if($query === "") {
					//if idnumber is in database but no cell number
					$subscribe = ($this->input->post('subscribe') == "true") ? true : false;
					$stud_cookie = array(
						'name'   => 'idnumber',
                		'value'  => $idNumber,
                		'expire' =>  100000,
                		'secure' => false
					);	

					$this->input->set_cookie($stud_cookie);	
					$this->studentIndex('add_cell_number');
					}
				}*/
				else {
					$subscribe = ($this->input->post('subscribe') == "true") ? true : false;
					$this->waitingList->append($idNumber);	//append student to waiting list
					if($subscribe)
						$this->cashier->subscribeStudent($idNumber);	//subscribe the student if subscribe is true
					$pnumber = $this->input->cookie('pnumber') + 1;	//get priority number
					
					if($query === "") {
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

					$this->studentIndex('encode_view', "Student Added!!<br>Priority Number: $pnumber");
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

	}

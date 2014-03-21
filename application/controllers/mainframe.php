<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	include(basename(dirname('classes/Cahier.php')) . '/Cashier.php');
	include(basename(dirname('classes/WaitingList.php')) . '/WaitingList.php');
	include(basename(dirname('classes/AlertSMS.php')) . '/AlertSMS.php');
	include(basename(dirname('classes/Message.php')) . '/Message.php');
	include(basename(dirname('classes/Student.php')) . '/Student.php');
	
	class mainframe extends CI_Controller {
		private $cashier;
		private $waitingList;
		private $alertSms;
		private $messageClass;
		private $message;
		private $student;

		public function __construct() {
			parent::__construct();
			$this->load->helper(array('url', 'form', 'html', 'cookie'));
			$this->load->library('session');
			$this->cashier = new Cashier();
			$this->waitingList = new WaitingList();
			$this->alertSms = new AlertSms();
			$this->student = new Student();
			$this->messageClass = new Message();
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


		
		public function cashierIndex($page, $message = '', $messageType = '') {
			$data = $this->cashier->retrieveCashier($this->session->userdata('cashierSessionId'));
			$data['message'] = $message;
			$this->load->view('templates/header_view', $data);
			if(! $this->session->userdata('cashierSessionId'))
				//if no session exist, redirect cashier to login page
				$this->load->view('home', $data);
			else {
				//if session exist, adto bisag asa gusto sa cashier
				if($page === 'cashier_login')
					$this->load->view('cashier/cashier_home', $data);
				else
					$this->load->view('cashier/' . $page, $data);
			}
			$this->load->view('templates/footer_view');		
		}

		/*
		 *	Called when a SUBSCRIBING student is appended to the end of the waiting list BUT no cellphone number in database
		 */
		public function encodeWithCellNumber() {
			$cellNumber = $this->input->post('cellNumber');
			$idNumber = $this->input->cookie('idnumber');

			if($this->cashier->validPhoneNumber($cellNumber)) {
				//if valid ang phone number
				$this->student->updateStudPhone($idNumber, $cellNumber);
				$pnumber = $this->input->cookie('pnumber');	//get priority number
				delete_cookie('idnumber');
				$this->studentIndex('encode_view', "Student Added!!<br>Priority Number: $pnumber");
			}
			else {
				//if invalid ang phone number
				$this->studentIndex('add_cell_number', 'Invalid Cellphone Number. Please enter again');
			}
		}

		public function login() {
			$cashierId = $this->input->post('cashierid');
			$password = $this->input->post('cashierpass');

			$status = $this->cashier->login($cashierId, $password);
			
			if(! $this->session->userdata('cashierSessionId')) {
				//if no session exist
				if($status) {
					$cashier_session = array(
						'cashierSessionId' => $cashierId
						);
					$this->session->set_userdata($cashier_session);
					$this->cashierIndex('cashier_home');
				}
				else {
					//mali either ang cashier id or password
					$this->cashierIndex('cashier_login', 'Error: Invalid ID number or password', 'Error');
				}
			}
			else {
				//if cookie exist
				$this->cashierIndex('cashier_home');
			}
		}

		public function subscribe(){
			$idNumber = $this->input->post('idNumber');
			$result['idExist'] = $this->cashier->idNumberExist($idNumber);
			$result['idValidToQueue'] = $this->waitingList->studentIsValid($idNumber);
			$result['idValidFormat'] = $this->cashier->validId($idNumber);

			$idNumberCookie = array (
			'name'   => 'studentID',
            'value'  => $idNumber,
            'expire' =>  100000,
            'secure' => false
			);

			$this->input->set_cookie($idNumberCookie);
			echo json_encode($result);
		}

		public function studentIndex($page) {
			$this->load->view('templates/header_view');
			$this->load->view('student/' . $page);
			$this->load->view('templates/footer_view');	
				
		}

		public function encode(){
			$idNumber = $this->input->post('idNumber', TRUE);

			if($idNumber==''){
				$result['flag'] = false;
				$result['errormessage'] = 'ID number must be filled!';
				echo json_encode($result);
			}
			else if(!$this->cashier->validId($idNumber)) {
				$result['flag'] = false;
				$result['errormessage'] = 'ID number is invalid!';
				echo json_encode($result);
			}
			else{
				$query = $this->cashier->idNumberExist($idNumber); 
				//var_dump($query);
				if($query === FALSE){
					//if id number is not in the database
					$result['flag'] = false;
					$result['errormessage'] = 'ID number not in database!';
					echo json_encode($result);
				}
				else {
					$flag = $this->waitingList->studentIsValid($idNumber);
					if( $flag == true) { //check if student is valid to be added to the waiting list
						
						$this->waitingList->append($idNumber, $query);	//append student to waiting list
						$result['pnumber']= $this->input->cookie('pnumber') + 1;	//get priority number
						$result['pmessage'] = 'Your priority number is';
						$result['flag'] = true;
						echo json_encode($result);
					}
					//if ang student wala pa na serve sa last nya na pila sa waiting list
					else{
						$result['flag'] = false;
						$result['errormessage'] = 'ID number has a pending transaction!';
						echo json_encode($result);
					}
				}
			}	
		}

		public function encodeWithNumber(){

			$studID = $this->input->cookie('studentID');
			$phoneNumber = $this->input->post('cellNum');
			$isValidPhone = $this->cashier->validPhoneNumber($phoneNumber);
			$flag = $this->waitingList->studentIsValid($studID);
			
			if($phoneNumber==""){
				$result['error'] = "Phone number must be filled!";
				echo json_encode($result);	

			}else if($isValidPhone==true && $flag==true){

				$this->waitingList->append($studID, $phoneNumber);	
				$this->cashier->subscribeStudent($studID);
				$result['pnumber'] = $this->input->cookie('pnumber') + 1;
				$result['pmessage'] = 'Your priority number is';
				$result['flag'] = true;
				echo json_encode($result);

			}else if($isValidPhone==false){
				$result['error'] = "Invalid cell number!";
				echo json_encode($result);
			}else{
				$result['error'] = "Pending";
				echo json_encode($result);				
			}

			
		}



		public function logout() {
			$this->session->sess_destroy();
			$this->cashierIndex('cashier_login');
		}
		
		
		public function validateLogin(){
			$cashierId = $this->input->post('cashierid');
			$password = $this->input->post('cashierpass');

			if(empty($cashierId) || empty($password)){
				$status = array('data' => 'empty');
				echo json_encode($status);
			}
			else{

			$status['data'] = $this->cashier->login($cashierId, $password);
			echo json_encode($status);
			}
		}

		public function hasSession(){
			$hasSession = $this->session->userdata('cashierSessionId');

			echo json_encode($hasSession);
		}


		public function getToBeServedStudents() {
			$data = $this->waitingList->retrieveFifteenStudents();
			//$waitingStudents = $this->waitingList->countEntries();
			$pending = array();
			foreach($data as $row) {
				$student = $this->student->retrieveStudent($row['studid']);
				$tmp = array(
					'studid' => $row['studid'],
					'pnumber' => $row['prioritynumber'],
					'studname' => $student['lastname'] . ', ' . $student['givenname'] . ' ' . $student['middlename'],
					'phone' => $student['studphone'],
					//'count' => $waitingStudents;
					);
				$pending[] = $tmp;
			}

			echo json_encode($pending);
			//var_dump($pending);
		}


		public function serveStudent() {
			$student = $this->waitingList->getFirstStudentAvailable();
			if(count($student) != 0) {
				$studId = $student['studid'];
				$this->waitingList->updateServingEntry($studId, true);
				$toServe = $this->student->retrieveStudent($studId);
				echo json_encode($toServe);
			}
			else {
				echo json_encode(array());
			}
		}

		public function doneServeStudent() {
			$idNumber =  $this->input->get('idnumber');
			$this->waitingList->updateServedEntry($idNumber);
			$this->waitingList->updateServingEntry($idNumber, false);
			$this->cashierIndex('cashier_serve_dash');
		}

		private function checkCookie() {
			if($this->session->usedata('cashierSessionId'))
				;	//do nothing
			else
				$this->load->view('cashier/cashier_home', $data);

		}

		public function sendMessages(){
			$students = $this->waitingList->get10thAnd50thStudents();
			$message1 = $this->messageClass->messageAlertFor10thStudent();
			$message2 = $this->messageClass->messageAlertFor50thStudent();
			$count = $this->waitingList->countUnservedEntries()['studentcount'];
			//echo var_dump($count);
			if(intval($count) >= 50){
				//$this->alertSms->sendSmsAlertTo($students[0]['phonenumber'], $message1);
				//$this->alertSms->sendSmsAlertTo($students[1]['phonenumber'], $message2);
				echo "send 2 messages";
			}
			else if(intval($count) < 50 && intval($count) >= 10){
				//$this->alertSms->sendSmsAlertTo($students[0]['phonenumber'], $message1);
				echo "send 1 message";
			}
			else{
				echo "send no message";
				//do nothing
			}
			echo json_encode($count);
		}

	}

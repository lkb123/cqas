<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	include(basename(dirname('classes/Cahier.php')) . '/Cashier.php');
	include(basename(dirname('classes/WaitingList.php')) . '/WaitingList.php');
	include(basename(dirname('classes/Message.php')) . '/Message.php');
	include(basename(dirname('classes/Student.php')) . '/Student.php');
	
	class mainframe extends CI_Controller {
		private $cashier;
		private $waitingList;
		private $message;
		private $student;

		public function __construct() {
			parent::__construct();
			$this->load->helper(array('url', 'form', 'html', 'cookie'));
			$this->load->model('cashier_model', 'CM');
			$this->load->model('student_model', 'SM');
			$this->load->library('session');
			$this->cashier = new Cashier();
			$this->waitingList = new WaitingList();
			$this->student = new Student();
			$this->messageClass = new Message();
		}
		
		public function index(){
			
			$cookie_settings = array(
				'name'   => 'pnumber',
                'value'  => '1',
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

			if($this->student->validPhoneNumber($cellNumber)) {
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
			$result['idExist'] = $this->idNumberExist($idNumber);
			$result['idValidToQueue'] = $this->student->studentIsValid($idNumber);
			$result['idValidFormat'] = $this->validId($idNumber);

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
			else if(!$this->validId($idNumber)) {
				$result['flag'] = false;
				$result['errormessage'] = 'ID number is invalid!';
				echo json_encode($result);
			}
			else{
				$query = $this->idNumberExist($idNumber); 
				//var_dump($query);
				if($query === FALSE){
					//if id number is not in the database
					$result['flag'] = false;
					$result['errormessage'] = 'ID number not in database!';
					echo json_encode($result);
				}
				else {
					$flag = $this->student->studentIsValid($idNumber);
					if( $flag == true) { //check if student is valid to be added to the waiting list
						
						$this->waitingList->append($idNumber, $query);	//append student to waiting list
						$result['pnumber']= $this->input->cookie('pnumber');	//get priority number
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
			$isValidPhone = $this->validPhoneNumber($phoneNumber);
			$flag = $this->student->studentIsValid($studID);
			
			if($phoneNumber==""){
				$result['error'] = "Phone number must be filled!";
				echo json_encode($result);	

			}else if($isValidPhone==true && $flag==true){

				$this->waitingList->append($studID, $phoneNumber);	
				$this->waitingList->subscribeStudent($studID);
				$result['pnumber'] = $this->input->cookie('pnumber');
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
			$waitingStudents = $this->waitingList->countUnservedEntries();
			$pending = array();
			foreach($data as $row) {
				$student = $this->student->retrieveStudent($row['studid']);
				$tmp = array(
					'studid' => $row['studid'],
					'pnumber' => $row['prioritynumber'],
					'studname' => $student['lastname'] . ', ' . $student['givenname'] . ' ' . $student['middlename'],
					'phone' => $row['phonenumber'],
					'subscribed' => $row['subscribed'],
					'count' => $waitingStudents
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
				$this->cashier->serve(1, $studId);
				$toServe['kertStud'] = $this->student->retrieveStudent($studId);
				//$studinfo = $this->sendMessages();

				echo json_encode($toServe);
			}
			else {
				echo json_encode(array());
			}
		}

		public function doneServeStudent() {
			$idNumber =  $this->input->get('idnumber');
			$this->cashier->updateServedEntry($idNumber);
			$this->cashier->updateServingEntry($idNumber, false);
			$this->cashierIndex('cashier_serve_dash');
		}

		public function sendMessages(){
			$students['stud1'] = $this->waitingList->get5thStudent();
			$students['stud2'] = $this->waitingList->get10thStudent();
			$message1 = $this->messageClass->getMessageFor10thStudent();
			$message2 = $this->messageClass->getMessageFor50thStudent();
			//echo var_dump($students);
			
			if($students['stud1'] != false){
				//echo "flag1";
				if($students['stud1']['subscribed'] === 't'){
					//echo "flag2";
					$this->messageClass->sendSmsAlertTo5thStudent($students['stud1']['phonenumber'], $message1);
					
				}
			}

			if($students['stud2'] != false){
				//echo "flag3";
				if($students['stud2']['subscribed'] === 't'){
					//echo "flag4";
					$this->messageClass->sendSmsAlertTo10thStudent($students['stud2']['phonenumber'], $message2);
				
				}
			}

			
		}


		public function validID($idNumber){
			if(preg_match("/^([0-9]{4})-([0-9]{4})$/", $idNumber))
				return True;
			else
				return False;
	 	}

		 /* check if idnumber in database
		 *	return false if idnumber not in database
		 *	return NULL if idnumber is in database but no cell number
		 *  return student phone number if idnumber is in database and has cell number
		 */
		 public function idNumberExist($idNumber){
		 
			$result = $this->CM->isInDatabase($idNumber);
			$resultdata = $result->row();
			
			if($result->num_rows() == 0)
				return FALSE;
			elseif(empty($resultdata))
				return NULL;
			else
				return $resultdata->studphone;			
		 }
		 
		 //checks if phoneNumber is valid
		 public function validPhoneNumber($phoneNumber){
				if(preg_match("/^(09|\+639)(26|15|27|05|16|32)([0-9]{7})$/", $phoneNumber))
					return True;
				else
					return False;
		 }

		 public function test($value) {
		 	return $value;
		 }

		 public function testDriver() {
		 	if($this->test(true))
		 		echo 'true';
		 	else
		 		echo 'false';
		 }

	}

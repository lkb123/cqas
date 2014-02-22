<?php
		
	include("/classes/Cashier.php");
	include("/classes/WaitingList.php");
	
	class MainFrame extends CI_Controller {
		private $cashier;
		private $waitingList;

		public function __construct() {
			parent::__construct();
			$this->load->helper('url');
			$this->load->helper(array('url', 'form', 'html'));
			//$this->load->library('form_validation');
			$this->cashier = new Cashier();
			$this->waitingList = new WaitingList();		
		}
		
		public function index(){ 				
			$this->load->view('templates/header_view');
			$this->load->view('home');
			$this->load->view('templates/footer_view');	
		}

		public function studentIndex($page, $message = '') {
			$data['message'] = $message;
			$this->load->view('templates/header_view', $data);
			$this->load->view('student/' . $page, $data);
			$this->load->view('templates/footer_view');		
		}

		
		public function encode(){
			//$this->form_validation->set_rules('idNumber','ID NUMBER','trim|required|min_length[9]|max_length[9]');

			if(! $this->cashier->validId($this->input->post('idNumber'))) {
				$this->studentIndex('encode_view', 'Please input ID Number again');
				//issue: I want to display the message as second argument, pero di mugawas sa html page
			}else{
				$query = $this->cashier->idNumberExist($this->input->post('idNumber'));
				$result = $query->row_array();	//expected only 1 result
				if(empty($result)) {
					echo "ID number Not in database";
				}else {
					$idNum = $this->input->post('idNumber');
					$phoneNum = $result['studphone'];
					$studentData = array($idNum, $phoneNum);
					$this->waitingList->append($studentData);
					echo "Priority Number: ".$this->waitingList->generatePriorityNumber();
					echo "Number of students in waiting list: ".$this->waitingList->countEntries();
				}
			}	
		}

	}

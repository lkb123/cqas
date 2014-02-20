	<?php
		
	include("/classes/Cashier.php");
	include("/classes/WaitingList.php");
	
	class MainFrame extends CI_Controller {
		private $cashier;
		private $waitingList;

		public function __construct() {
			parent::__construct();
			$this->load->helper(array('url', 'form', 'html'));
			$this->load->library('form_validation');
			$this->cashier = new Cashier();
			$this->waitingList = new WaitingList();		
		}
		
		public function index(){ 				
		$this->load->view('header_view');
		$this->load->view('encode_view');
		$this->load->view('footer_view');	
		}
		
		public function encode(){
			$this->form_validation->set_rules('idNumber','ID NUMBER','trim|required|min_length[9]|max_length[9]');

			if($this->form_validation->run() == false){
				 $this->index();
			}else{
				$phoneNum = $this->cashier->idNumberExist($this->input->post('idNumber'));
				if($phoneNum==FALSE){
					echo "ID number Not in database";
				}else{
					$idNum = $this->input->post('idNumber');
					$studentData = array($phoneNum,$idNum);
					$this->waitingList->append($studentData);
					echo "Priority Number: ".$this->waitingList->generatePriorityNumber();
					echo br();
					echo "Number of students in waiting list: ".$this->waitingList->countEntries();
				}
			}	
		}

	}

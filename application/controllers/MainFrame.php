<?php
	include "/classes/WaitingList.php";

	class MainFrame extends CI_Controller {
		private $waitingList;

		public function __construct() {
			parent::__construct();
			$this->load->helper('url');
			if()
			$this->waitingList = new WaitingList();
		}

		public function index() {
			$data['title'] = 'Home';
			$this->load->view('templates/header', $data);
			$this->load->view('home');
			$this->load->view('templates/footer', $data);
		}

		public function studentIndex($page) {
			$data['title'] = $page;
			$this->load->view('templates/header', $data);
			$this->load->view('student/' . $page);
			$this->load->view('templates/footer', $data);
		}

		public function enterIdNumberSuccessor() {
			$data['title'] = 'priority_number_display';
			$idNumber = $this->input->post('id_number');
			$this->waitingList->append($idNumber);
			$data['pnumber'] = $this->waitingList->generatePriorityNumber();

			$this->load->view('templates/header', $data);
			$this->load->view('student/priority_number_display');
			$this->load->view('templates/footer', $data);
		}
		
	}
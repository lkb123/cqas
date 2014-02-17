<?php
	
	include("/classes/Student.php");
	class MainFrame extends CI_Controller {
		private $student;

		public function __construct() {
			parent::__construct();
			$this->load->helper(array('url', 'form', 'html'));
			$this->load->library('form_validation');
		}
		
		public function index(){
			$this->load->view('header_view');
			$this->load->view('encode_view');
			$this->load->view('footer_view');
		}
		
	}
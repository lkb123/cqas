<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	include(basename(dirname('classes/Cahier.php')) . '/Cashier.php');
	include(basename(dirname('classes/WaitingList.php')) . '/WaitingList.php');
	
	class MainFrame extends CI_Controller {
		private $cashier;
		private $waitingList;

		public function __construct() {
			parent::__construct();
			$this->load->helper(array('url', 'form', 'html', 'cookie'));
			$this->cashier = new Cashier();
			$this->waitingList = new WaitingList();
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

		public function studentIndex($page, $message = '') {
			$data['message'] = $message;
			$this->load->view('templates/header_view', $data);
			$this->load->view('student/' . $page, $data);
			$this->load->view('templates/footer_view');		
		}

		
		public function encode(){
			$idNumber = $this->input->post('idNumber', TRUE);
			if(! $this->cashier->validId($idNumber)) {
				$this->studentIndex('encode_view', 'Please input ID Number again');
			}else{
				$query = $this->cashier->idNumberExist($idNumber);
				$result = $query->row_array();	//expected only 1 result
				if(empty($result)) {
					echo "ID number Not in database";
				}else {
					$this->waitingList->append($idNumber);
					$pNumber = $this->waitingList->retrieveAStudent($idNumber);
					$this->studentIndex('add_student_success', $this->input->cookie('pnumber') + 1);
				}
			}	
		}

		public function test() {
			date_default_timezone_set("Asia/Manila"); 
			echo date('Y-m-d H:i:s');
		}

		public function printCookie($name) {
			var_dump($this->input->cookie($name));
			
			$cookie_settings = array(
				'name'   => 'pnumber',
                'value'  => '2',
                'expire' =>  '100000',
                'secure' => false
				);			
			$this->input->set_cookie($cookie_settings);
		}

	}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	include(basename(dirname('classes/Cahier.php')) . '/Cashier.php');
	include(basename(dirname('classes/WaitingList.php')) . '/WaitingList.php');
	
	class mainframe extends CI_Controller {
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

		public function studentIndex($page, $message = '', $messageType = '') {
			$data['message'] = $message;
			$this->load->view('templates/header_view', $data);
			$this->load->view('student/' . $page, $data);
			$this->load->view('templates/footer_view');		
		}

		
		public function encode(){
			$idNumber = $this->input->post('idNumber', TRUE);
			if(! $this->cashier->validId($idNumber)) {
				$this->studentIndex('encode_view', 'Error: Please input ID Number again', 'Error');
			}else{
				$query = $this->cashier->idNumberExist($idNumber);
				if($query === false) {
					echo "ID number Not in database";
				}
				elseif(empty($query)){
					echo "ID number not in database, please provide ID number";
				}
				else {
					$subscribe = ($this->input->post('subscribe') == "true") ? true : false;
					$this->waitingList->append($idNumber);
					if($subscribe)
						$this->cashier->subscribeStudent($idNumber);
					$this->studentIndex('encode_view', $this->input->cookie('pnumber') + 1);
				}
			}	
		}

	}

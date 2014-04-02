<?php
	include(basename(dirname('classes/Message.php')) . '/Message.php');

	class message_test extends CI_Controller {

		private $message;
		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');
			$this->message = new Message();
		}
		
		public function messageAlert1Test() {
			$expected = "4 more students and it will be your turn to be served please proceed to the cashier";
			$result = $this->message->getMessageFor5thStudent();
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}

		public function messageAlert2Test() {
			$expected = "9 more students and it will be your turn to be served please proceed to the cashier";
			$result = $this->message->getMessageFor10thStudent();
			$this->unit->run($result, $expected);
			$this->load->view('test');
		}
?>
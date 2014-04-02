<?php

include(APPPATH . 'controllers/classes/Message.php');
class test_controller extends CI_Controller {

	private $message;
	public function index() {
		$this->message = new Message();
		echo $this->message->getMessageFor5thStudent();
		echo 'hello world';
	}
}
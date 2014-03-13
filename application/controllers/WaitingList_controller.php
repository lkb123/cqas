<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	include(basename(dirname('classes/WaitingList.php')) . '/WaitingList.php');

	class WaitingList_controller extends CI_Controller {

		private $waitingList;

		public function __construct() {
			parent::__construct();
			//$this->load->library('unit_test');
			//$this->load->helper('cookie');
			$this->waitingList = new WaitingList();
		}

		public function getFifteenStudents(){
			$result = $this->waitingList->retrieveFifteenStudents();
			echo var_dump($result);
		}

	}

<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//nclude('home/louie/lappstack-5.4.23-0/apache2/htdocs/cqas/application/controllers/classes/WaitingList.php');
class Cashier {
	
	private $CI;
	
	 public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->model('student_model','SM');
		$this->CI->load->model('cashier_model', 'CM');
		$this->CI->load->model('waitinglist_model', 'WM');
	 }


	 public function login($cashierId, $password) {
	 	$result = $this->CI->CM->getCashier($cashierId)->row_array();
	 	if(count($result) == 0)
	 		return FALSE;

	 	if($result['cashierpass'] == $password) {
	 		return TRUE;
	 	}
	 	else {
	 		return FALSE;
	 	}
	 }

	 public function updateServingEntry($idNumber, $value) {
			$this->CI->WM->updateServing($idNumber, $value);
	 }

	 public function updateServedEntry($idNumber) {
		$this->CI->WM->updateServed($idNumber);
		$this->CI->WM->updateDateServed($idNumber);
		$this->CI->WM->updateTimeServed($idNumber);
	 }

	 public function retrieveCashier($cashierId) {
		 	$result = $this->CI->CM->getCashier($cashierId);
		 	return $result->row_array();
	}	
	
 }
 
 ?>
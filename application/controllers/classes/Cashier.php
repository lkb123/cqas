<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//nclude('home/louie/lappstack-5.4.23-0/apache2/htdocs/cqas/application/controllers/classes/WaitingList.php');
class Cashier {
	
	private $CI;
	
	 public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->model('cashier_model','CM');

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


	 
 }
 
 ?>
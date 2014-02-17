<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Cashier {
	

	 public function __construct() {
		$CI =& get_instance();
		$CI->load->model('cashier_model','cm');

	 }

	 public function encode($idNumber){
		echo strlen($idNumber)."---";
		if( strlen($idNumber) != 4  || preg_match("/[^0-9]/", $idNumber))
			return 0;
		else
			return 1;
	 }
	 
	 public function idNumberExist($idNumber){
		$result = $CI->cm->isInDatabase($idNumber);
		return $result;
	 }
	
 }
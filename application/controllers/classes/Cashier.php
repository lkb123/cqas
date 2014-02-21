<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Cashier {
	
	private $CI;
	
	 public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->model('cashier_model','CM');

	 }

	 public function validID($idNumber){
			if(preg_match("/^([0-9]{4})-([0-9]{4})$/", $idNumber))
				return True;
			else
				return False;
	 }
	 
	 public function getPhoneNumber($idNumber){
	 
		$result = $this->CI->CM->isInDatabase($idNumber);
		$resultdata = $result->row();
		
		if($result->num_rows() == 0)
			return FALSE;
		else
			return $resultdata->studphone;
	 }
	 
	 public function idNumberExist($idNumber) {
	 	$result = $this->CI->CM->isInDatabase($idNumber);
	 	return $result;
	 }

 }
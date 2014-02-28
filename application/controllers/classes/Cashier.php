<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//nclude('home/louie/lappstack-5.4.23-0/apache2/htdocs/cqas/application/controllers/classes/WaitingList.php');
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
	 
	 public function idNumberExist($idNumber){
	 
		$result = $this->CI->CM->isInDatabase($idNumber);
		$resultdata = $result->row();
		
		if($result->num_rows() == 0)//idnumber not in database
			return FALSE;
		elseif(empty($resultdata))//idnumber in database but no cell number
			return NULL;
		else
			return $resultdata->studphone;			
	 }
	 
	 public function validPhoneNumber($phoneNumber){
			if(preg_match("/^((0926|0915|0917))([0-9]{7})$/", $phoneNumber))
				return True;
			else
				return False;
	 }
	//change student subscribed to TRUE
	 public function subscribeStudent($idNumber){
		$this->CI->CM->subscribeStudent($idNumber);
	 }
	 //Return boolean 
	 public function isSubscribed($idNumber){
		$result = $this->CI->CM->isSubscribed($idNumber);
		$resultdata = $result->row();
		return $resultdata->subscribed;
	 }
	 
 }
 
 ?>
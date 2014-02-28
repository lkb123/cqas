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
	 
	 /* check if idnumber in database
	 *	return false if idnumber not in database
	 *	return NULL if idnumber is in database but no cell number
	 *  return student phone number if idnumber is in database and has cell number
	 */
	 public function idNumberExist($idNumber){
	 
		$result = $this->CI->CM->isInDatabase($idNumber);
		$resultdata = $result->row();
		
		if($result->num_rows() == 0)
			return FALSE;
		elseif(empty($resultdata))
			return NULL;
		else
			return $resultdata->studphone;			
	 }
	 
	 //checks if phoneNumber is valid
	 public function validPhoneNumber($phoneNumber){
			if(preg_match("/^(09|\+639)(26|15|27)([0-9]{7})$/", $phoneNumber))
				return True;
			else
				return False;
	 }
	 
	//change student subscribed to TRUE
	 public function subscribeStudent($idNumber){
		$this->CI->CM->subscribeStudent($idNumber);
	 }
	 
	 //Return true is student is subscribed
	 public function isSubscribed($idNumber){
		$result = $this->CI->CM->isSubscribed($idNumber);
		$resultdata = $result->row();
		return $resultdata->subscribed;
	 }
	 
 }
 
 ?>
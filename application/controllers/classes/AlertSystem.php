<?php

	class AlertSystem {

		private $CI;

		public function __construct() {
			$this->CI =& get_instance();
			$this->CI->load->model('student_model','SM');
			$this->CI->load->model('cashier_model', 'CM');
			$this->CI->load->model('waitinglist_model', 'WM');
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
				if(preg_match("/^(09|\+639)(26|15|27|05|16|32)([0-9]{7})$/", $phoneNumber))
					return True;
				else
					return False;
		 }

		 public function loginCashier($cashierId, $password) {
		 	$result = $this->cashier->retrieveCashier($idNumber);
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
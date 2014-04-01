<?php

	class Message{

		private $messageFor5thStudent = "4 more students and it will be your turn to be served please proceed to the cashier";
		private $messageFor10thStudent = "9 more students and it will be your turn to be served please proceed to the cashier";

		public function __construct(){
			
		}
		
		public function getMessageFor10thStudent(){
			return $this->messageFor10thStudent;
		}

		public function getMessageFor50thStudent(){
			return $this->messageFor50thStudent;
		}

		public function sendSmsAlertTo5thStudent($sms_to, $sms_msg){

                        $query_string = "api.aspx?apiusername=".'APIOFDL9XOW1T'."&apipassword=".'APIOFDL9XOW1T14K1H';

                        $query_string .= "&senderid=".rawurlencode('CQAS')."&mobileno=".rawurlencode($sms_to);
                        $query_string .= "&message=".rawurlencode(stripslashes($sms_msg)) . "&languagetype=1";        
                        $url = "http://gateway.onewaysms.com.au:10001/".$query_string;       
                        $fd = @implode ('', file ($url));          
		}

		public function sendSmsAlertTo10thStudent($sms_to, $sms_msg){

                        $query_string = "api.aspx?apiusername=".'APIOFDL9XOW1T'."&apipassword=".'APIOFDL9XOW1T14K1H';

                        $query_string .= "&senderid=".rawurlencode('CQAS')."&mobileno=".rawurlencode($sms_to);
                        $query_string .= "&message=".rawurlencode(stripslashes($sms_msg)) . "&languagetype=1";        
                        $url = "http://gateway.onewaysms.com.au:10001/".$query_string;       
                        $fd = @implode ('', file ($url));          
		}
	}


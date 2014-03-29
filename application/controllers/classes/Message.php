<?php

	class Message{

		private $message1;
		private $message2;

		public function __construct(){
			
		}
		
		
		
		
				
		

		public function getMessage1(){
			$message1 = "4 more students and it will be your turn to be served please proceed to the cashier";
			return $message1;
		}

		public function getMessage2(){
			$message2 = "9 more students and it will be your turn to be served please proceed to the cashier";
			return $message2;
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


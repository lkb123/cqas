<?php

	class Message{
	
		public function __construct(){
		}
		
		
		
		private $messageAlertFor5thStudent = "4 more students and it will be your turn to be served please proceed to the cashier";

		private $messageAlertFor10thStudent = "9 more students and it will be your turn to be served please proceed to the cashier";
		

		public function sendSmsAlertTo5thStudent($sms_to){

                        $query_string = "api.aspx?apiusername=".'APIOFDL9XOW1T'."&apipassword=".'APIOFDL9XOW1T14K1H';

                        $query_string .= "&senderid=".rawurlencode('CQAS')."&mobileno=".rawurlencode($sms_to);
                        $query_string .= "&message=".rawurlencode(stripslashes($messageAlertFor5thStudent)) . "&languagetype=1";        
                        $url = "http://gateway.onewaysms.com.au:10001/".$query_string;       
                        $fd = @implode ('', file ($url));          
		}

		public function sendSmsAlertTo10thStudent($sms_to){

                        $query_string = "api.aspx?apiusername=".'APIOFDL9XOW1T'."&apipassword=".'APIOFDL9XOW1T14K1H';

                        $query_string .= "&senderid=".rawurlencode('CQAS')."&mobileno=".rawurlencode($sms_to);
                        $query_string .= "&message=".rawurlencode(stripslashes($messageAlertFor10thStudent)) . "&languagetype=1";        
                        $url = "http://gateway.onewaysms.com.au:10001/".$query_string;       
                        $fd = @implode ('', file ($url));          
		}
	}


?>
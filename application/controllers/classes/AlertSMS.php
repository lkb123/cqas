<?php

	class AlertSms{
		
		
		public function __construct(){
		}
		
		
		/* Sending sms through http POST
		*	GATEWAY semaphore.co
		*  Return output { 
						  'status' :           'success', 
						  'message' :      'Message Sent', 
						  'code' :             '200', 
						  'message_id' : 'unique_string_here', 
						  'from' :             'GLOBE', 
						  'to' :                 '639270000000', 
						  'body' :            'Semaphore rocks!' 
						}
						
				Status/Error Codes
				Code	Description
				200	Successfully Sent
				201	Message Queued
				100	Not Authorized
				101	Not Enough Balance
				102	Feature Not Allowed
				103	Invalid Options
				104	Gateway Down
		*/
		/*
		public function sendSmsAlertTo($number, $message){
		
			$fields = array();
			$fields["api"] = "pLPaajYNqmmYAkFzBpsU"; //depende sa account
			$fields["number"] = $number; //safe use 63, string ni dapat
			$fields["message"] = $message;
			$fields["from"] = "CASHIER";
			$fields_string = http_build_query($fields);
			$outbound_endpoint = "http://api.semaphore.co/api/sms";
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $outbound_endpoint);
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);
			curl_close($ch);
			
			return $output;
		}*/

		function sendSmsAlertTo($sms_to,$sms_msg)  
            {           

                        $query_string = "api.aspx?apiusername=".'API4XNEUJ3XH5'."&apipassword=".'API4XNEUJ3XH5HNTT3';

                        $query_string .= "&senderid=".rawurlencode('CQAS')."&mobileno=".rawurlencode($sms_to);
                        $query_string .= "&message=".rawurlencode(stripslashes($sms_msg)) . "&languagetype=1";        
                        $url = "http://gateway.onewaysms.com.au:10001/".$query_string;       
                        $fd = @implode ('', file ($url));      
                        
                        /*
                        if ($fd)  
                        {                       
					    if ($fd > 0) {
						Print("MT ID : " . $fd);
						$ok = "success";
					    }        
					    else {
						print("Please refer to API on Error : " . $fd);
						$ok = "fail";
					    }
		                    }           
		                    else      
		                    {                       
		                                // no contact with gateway                      
		                                $ok = "fail";       
		                    }           
		                    return $ok;  */
		       }  	
}
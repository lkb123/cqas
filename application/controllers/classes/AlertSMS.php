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
		public function sendSmsAlertTo($number, $message, $from){
		
			$fields = array();
			$fields["api"] = "pLPaajYNqmmYAkFzBpsU"; //depende sa account
			$fields["number"] = $number; //safe use 63
			$fields["message"] = $message;
			$fields["from"] = $from;
			$fields_string = http_build_query($fields);
			$outbound_endpoint = "http://api.semaphore.co/api/sms"
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $outbound_endpoint);
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);
			curl_close($ch);
			
			return $output
		}
	}

?>
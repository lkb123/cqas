<?php

	class Message{
	
		public function __construct(){
		}
		
		
		/*
		*	String Messages according to Alert type
		*/
		
		public function messageAlertFor10thStudent(){
			return "4 more students and it will be your turn to be served please proceed to the cashier";
		}
		
		public function messageAlertFor50thStudent(){
			return "9 more students and it will be your turn to be served please proceed to the cashier";
		}
	}


?>
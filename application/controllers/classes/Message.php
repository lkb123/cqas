<?php

	class Message{
	
		public function __construct(){
		}
		
		
		/*
		*	String Messages according to Alert type
		*/
		
		public function messageAlertFor10thStudent(){

			return "9 more students and it will be your turn to be serve
					please proceed to the cashier";
			
		}
		
		public function messageAlertFor50thStudent(){
			return "49 more students and it will be your turn to be serve
					please proceed to the cashier";
		}
	}


?>
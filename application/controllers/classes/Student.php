<?php

	class Student {
	
		private $CI;
		
		public function __construct() {
			$this->CI =& get_instance();
			$this->CI->load->model('student_model','SM');
		}

		public function getGName($idNumber){
		
		$this->CI->SM->getStudGName($idNumber);
		
		}

		public function getMName($idNumber){
		
		$this->CI->SM->getStudMName($idNumber);
		
		}

		public function getLName($idNumber){
		
		$this->CI->SM->getStudLName($idNumber);
		
		}
		
		public function getCourse($idNumber){
		
		$this->CI->SM->getStudCourse($idNumber);
		
		}

		public function getPhone($idNumber){
		
		$this->CI->SM->getStudPhone($idNumber);
		
		}

	}
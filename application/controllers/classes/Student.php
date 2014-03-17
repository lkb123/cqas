<?php

	class Student {
	
		private $CI;
		
		public function __construct() {
			$this->CI =& get_instance();
			$this->CI->load->model('student_model','SM');
		}

		public function getGName($idNumber){
		
		return $this->CI->SM->getStudGName($idNumber)->row_array();
		
		}

		public function getMName($idNumber){
		
		return $this->CI->SM->getStudMName($idNumber)->row_array();
		
		}

		public function getLName($idNumber){
		
		return $this->CI->SM->getStudLName($idNumber)->row_array();
		
		}
		
		public function getCourse($idNumber){
		
		return $this->CI->SM->getStudCourse($idNumber)->row_array();
		
		}

		public function getPhone($idNumber){
		
		return $this->CI->SM->getStudPhone($idNumber)->row_array();
		
		}

		public function retrieveStudent($idNumber) {

		return $this->CI->SM->getStudent($idNumber)->row_array();
		
		}

	}
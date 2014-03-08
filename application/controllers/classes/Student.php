<?php

	class Student {
	
		private $CI;
		
		public function __construct() {
			$this->CI =& get_instance();
			$this->CI->load->model('student_model','SM');
		}
		
		public function updateStudPhone($idNumber, $newCell) {
			$this->CI->SM->updateStudCell($idNumber, $newCell);
		}

		public function studentIsValid($idNumber) {
			$query = $this->CI->SM->getValidity($idNumber)->row();
			return $query->valid;
		}

		public function updateStudentValidity($idNumber, $value) {
			$this->CI->SM->updateValidity($idNumber, $value);
		}
	}
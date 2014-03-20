<?php

	class Student {
	
		private $CI;
		
		public function __construct() {
			$this->CI =& get_instance();
			$this->CI->load->model('student_model','SM');
		}

		public function retrieveStudent($idNumber) {

			return $this->CI->SM->getStudent($idNumber)->row_array();
		
		}

	}
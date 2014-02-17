<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cashier_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
	
	}
	

	//query if idNumber is in the database , return boolean
	public function isInDatabase($idNumber)
	{
	
		$query = $this->db->query("	SELECT *
									FROM student
									WHERE stud_id = '$idNumber'
									");
									
		if($query->num_rows() == 0)
			return FALSE;
		else
			return TRUE;
	}
	
}


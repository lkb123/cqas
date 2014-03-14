<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class query_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function setServeTrue($idNumber)
	{
	
		$query = $this->db->query("	UPDATE waitinglist
									SET serving = TRUE
									WHERE studid = '$idNumber' 
									AND served = FALSE
									");
	}
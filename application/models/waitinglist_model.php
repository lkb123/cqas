<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Waitinglist_model extends CI_Model {

		public function __construct() {
			parent::__construct();
			$this->load->database();
		}
		
		public function addStudent($idNumber, $priorityNumber, $timeAdded) {
			$query = "insert into waitinglist(studid, prioritynumber, timestampadded) values ('$idNumber', $priorityNumber, '$timeAdded')";
			return $this->db->query($query);
		}

		public function countUnServedEntries() {
			$query = "Select COUNT(*) As NumberOfStudentsNotServed From waitinglist Where served = false";
			return $this->db->query($query);
		}

		public function countServedEntries() {
			$query = "Select COUNT(*) As NumberOfStudentsServed From waitinglist Where served = true";
			return $this->db->query($query);
		}

		public function countAllEntries() {
			$query = "Select COUNT(*) As NumberOfStudentsInWaitingList From waitinglist";
			return $this->db->query($query);
		}
	}
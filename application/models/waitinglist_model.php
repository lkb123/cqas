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
			$query = "Select COUNT(*) As studentcount From waitinglist Where served = false";
			return $this->db->query($query)->row_array();
		}

		public function countServedEntries() {
			$query = "Select COUNT(*) As studentcount From waitinglist Where served = true";
			return $this->db->query($query)->row_array();
		}

		public function countAllEntries() {
			$query = "Select COUNT(studid) As studentcount From waitinglist";
			return $this->db->query($query)->row_array();
		}

		public function clearWaitingList() {
			$query = "Delete From waitinglist";
			return $this->db->query($query);
		}

		public function getStudent($idNumber) {
			$query = "Select * From waitinglist Where studid = '$idNumber'";
			return $this->db->query($query);
		}

		public function retrieveNthEntry($n) {
			$query = "Select studid From waitinglist Where prioritynumber = $n Order By timestampadded";
			return $this->db->query($query);
		}
	}
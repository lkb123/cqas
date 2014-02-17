<?php
	//include '/../exceptions/WaitingListException.php';
	
	class WaitingList {

		private $list;

		public function __construct() {
			$this->list = array();
		}

		public function append($id_number) {
			$this->list[] = $id_number;
		}

		public function countEntries() {
			return count($this->list);
		}

		public function clearList() {
			$this->list = array();
		}

		public function generatePriorityNumber() {
			$priorityNumber = $this->countEntries();
			if($priorityNumber <= 999)
				return $priorityNumber;
			return $priorityNumber % 999;
		}

		public function retrieveAStudent($n) {
			if($n == 10 && $this->countEntries() < 10)
				throw new Exception('Error: the number of entries in the waiting list is less than 10');
			if($n == 50 && $this->countEntries() < 50)
				throw new Exception('Error: the number of entries in the waiting list is less than 50');

			return $this->list[$n];
		
		}
	}

?>
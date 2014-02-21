<?php

	class WaitingList {

		private $list;
		private $priorityNumber;

		public function __construct() {
			$this->list = array();
			$this->priorityNumber = 1;
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
			if($this->priorityNumber > 999)
				$this->priorityNumber = 0;
			return $this->priorityNumber++;
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
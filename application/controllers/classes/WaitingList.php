<?php

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
			$priorityNumber = count($this->list);
			if($priorityNumber <= 999)
				return $priorityNumber;
			return $priorityNumber % 999;
		}
	}
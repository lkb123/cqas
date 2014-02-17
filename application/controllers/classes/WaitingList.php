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
<<<<<<< HEAD
			if($this->priorityNumber > 999)
				$this->priorityNumber = 0;
			return $this->priorityNumber++;
=======
			$priorityNumber = count($this->list);
			if($priorityNumber <= 999)
				return $priorityNumber;
			return $priorityNumber % 999;
>>>>>>> 16dbd71fb39fd61063f6dd47346091d0566bc25f
		}
	}

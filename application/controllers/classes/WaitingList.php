<?php

	class WaitingList {

		private $queue;

		public function __construct() {
			$this->queue = new SplQueue();
		}

		public function append($id_number) {
			$this->queue->enqueue($id_number);
		}

		public function countEntries() {
			return $this->queue->count();
		}

		public function clearList() {
			$this->queue = new SplQueue();
		}
	}
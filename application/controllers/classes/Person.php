<?php

	abstract class Person {
		private $idNumber;
		private $lastName;
		private $givenName;
		private $middleName;
	
		abstract public function getIdNumber($idNumber);

		abstract public function getLastName($idNumber);

		abstract public function getGivenName($idNumber);

		abstract public function getMiddleName($idNumber);

	}

?>
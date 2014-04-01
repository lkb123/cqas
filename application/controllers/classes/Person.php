<?php

	abstract class Person {
		private $idNumber;
		private $lastName;
		private $givenName;
		private $middleName;
		private $CI;
		abstract public function getIdNumber();

		abstract public function getLastName();

		abstract public function getGivenName();

		abstract public function getMiddleName();

		abstract public function setIdNumber($idNumber);

		abstract public function setLastName($lastName);

		abstract public function setGivenName($givenName);

		abstract public function setMiddleName($middleName);
	}
<?php
/**
 * Profile; the class for identifying users
 *
 * @author Michael Prinz mprinz1@cnm.edu
 **/

class Profile {
	/**
	 * id for this Profile; this is the primary key
	 * @var int $profileId
	 **/
	private $profileId;
	/**
	 * first name of user
	 * @var string $firstName
	 **/
	private $firstName;
	/**
	 * last name of user
	 * @var string $lastName
	 **/
	private $lastName;
	/**
	 * email of user
	 * @var string $email
	 **/
	private $email;
	/**
	 * zip code of user
	 * @var int $zipCode
	 **/
	private $zipCode;

	/*
	 * phone number of user
	 * @var int $phone
	 */
	private $phone;

	/**
	 * mutator method for profile id
	 *
	 * @param int $newProfileId new value of profile id
	 * @throws TypeError if $newProfileId is not an integer
	 * @throws RangeException if $newProfileId is negative
	 **/
	public function setProfileId($newProfileId) {
		//first apply the filter to the input
		$newProfileId = filter_var($newProfileId, FILTER_VALIDATE_INT);

		//if filter_var() rejects the new id, throw an Exception
		if($newProfileId === false) {
			throw(new TypeError("profile id is not an integer"));

			$this->profileId = $newProfileId;
		}
	}

	/**
	 * accessor method for profile id
	 *
	 * @return int value of profile id
	 **/
	public function getProfileId() {
		return ($this->profileId);
	}

	/**
	 * mutator method for first name
	 *
	 * @param string $newFirstName new value of first name
	 * @throws TypeError if $newFirstName is not a string or insecure
	 * @throw RangeException if $newFirstName is > 75 characters
	 *
	 **/
	public function setFirstName($newFirstName) {
		// verify the first name is secure
		$newFirstName = trim($newFirstName);
		$newFirstName = filter_var($newFirstName, FILTER_SANITIZE_STRING);

		// verify the first name content will fit in the database
	if(strlen($newFirstName)>75) {
		throw(new RangeException("first name content too large"));
	}

		//store the first name content
		$this->firstName = $newFirstName;
	}
	public function setLastName($newLastName){
		//verify the last name is secure
		$newLastName = trim($newLastName);
		$newLastName = filter_var($newLastName, FILTER_SANITIZE_STRING);

		//store the last name content
		$this->lastName = $newLastName;
	}
	public function setEmail($newEmail) {
		//verify the email is secure
		$newEmail = filter_var($newEmail, FILTER_VALIDATE_EMAIL);

		//store the email content
		$this->email = $newEmail;

		public function setPhone($newPhone) {
		//verify the phone data is secure
		$newPhone = filter_var($newPhone, FILTER_VALIDATE_INT);

			//store the phone content
			$this->phone = $newPhone:
		}
		public function setZipCode ($newZipCode){
			// verify the zip code is secure
			$newZipCode = filter_var($newZipCode, FILTER_VALIDATE_INT);

			//store the zip code content
			$this->zipCode =  $newZipCode;
		}
	public function __construct($firstName, $lastName, $email, $zipCode, $phone = null)
	}

}
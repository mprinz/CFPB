<?php
/**
 * Profile; the class for identifying users
 *
 * @author Michael Prinz mprinz1@cnm.edu
 **/
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
// require_once("profile.php");
$pdo = connecttoEncryptedMySQL("/etc/apache2/data-design/mprinz1.ini");

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
		//base case: if the profile id is null, this is a new profile without a mySQL assigned id (yet)
		if($newProfileId === null) {
			$this->profileId = null;
			return;
		}

		//first apply the filter to the input
		$newProfileId = filter_var($newProfileId, FILTER_VALIDATE_INT);

				//if filter_var() rejects the new id, throw an Exception
			if($newProfileId === false) {
				throw(new TypeError("profile id is not an integer"));

				//save the object
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
	 * @param string $newFirstName new value of first name
	 * @throws TypeError if $newFirstName is not a string or insecure
	 * @throw RangeException if $newFirstName is > 75 characters
	 **/
	public function setFirstName($newFirstName) {
		// verify the first name is secure
		$newFirstName = trim($newFirstName);
		$newFirstName = filter_var($newFirstName, FILTER_SANITIZE_STRING);

		// verify the first name content will fit in the database
		if(strlen($newFirstName) > 75) {
			throw(new RangeException("first name content too large"));
		}

		//store the first name content
		$this->firstName = $newFirstName;
	}

	public function setLastName($newLastName) {
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
	}

	public function setPhone($newPhone) {
		//verify the phone data is secure
		$newPhone = filter_var($newPhone, FILTER_VALIDATE_INT);

		//store the phone content
		$this->phone = $newPhone;
	}

	public function setZipCode($newZipCode) {
		// verify the zip code is secure
		$newZipCode = filter_var($newZipCode, FILTER_VALIDATE_INT);

		//store the zip code content
		$this->zipCode = $newZipCode;
	}

	public function __construct($newFirstName, $newLastName, $newEmail, $newZipCode, $newPhone = null) {
		try {
				$this->setFirstName($newFirstName);
				$this->setLastName($newLastName);
				$this->setEmail($newEmail);
				$this->setPhone($newPhone);
				$this->setZipCode($newZipCode);
				} catch(InvalidArgumentException $invalidArgument) {
				//rethrow the exception to the caller
				throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, ($invalidArgument));
				} catch(RangeException $range) {
			//rethrow the exception to the caller
				throw(new RangeException($range->getMessage(), 0, $range));
				} catch(Exception $exception) {
			//rethrow generic exception
				throw(new Exception($exception->getMessage(), 0, $exception));
			}
	}
/** inserts this Profile into mySQL
 *
 * @param PDO $pdo PDO connection object
 * @throws PDOException when mySQL related errors occur
 **/
	public function insert(PDO $pdo){
		//enforce the profileId is null (i.e. don't insert a profile that already exists)
		if($this->profileId !==null) {
			throw(new PDOException("not a new profile"));
		}
		//create query template
		$query = "INSERT INTO Profile (firstName, lastName, email, zipCode, phone) VALUES (:profileId, :firstName, :lastName, :email, :zipCode, :phone)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in this template
		$parameters = array("firstName" => $this->firstName, "lastname" => $this->lastName, "email" => $this->email, "zipCode" => $this->zipCode, "phone" => $this->phone,);
		$statement->execute($parameters);

		//update the null profileId with what mySQL just gave us
		$this->profileId = intval($pdo->lastInsertId());
		}
	/**
	 * deletes this Profile from mySQL
	 *
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException when mySQL related errors occur
	 **/
		public function delete(PDO $pdo) {
			//enforce the profileId is not null (i.e. don't delete a profile that hasn't been inserted)
			if($this->profileId === null) {
				throw(new PDOException("unable to delete profile that does not exist"));
			}
		}
		//create query template
		$query = "DELETE FROM profile WHERE profileID = :profileId");
		$statement = $pdo->prepare($query);

	// bind the member variables to the place holder in the template
		$parameters = array(profileId => $this->profileId);
		$statement->execute($parameters);

/**
 * updates the Profile in MySQL
 *
 *@param PDO $pdo PDO connection  object
 *@throws PDOException when mySQL related errors occur
**/
		public function update (PDO $pdo) {
		//enforce the profileId is not null (i.e. don't update a profile that hasn't been inserted)
		if ($this->profileId === null) {
				throw(new PDOException("unable to update a profile that hasn't been entered"));
		}
}
	//create query template
$query = "UPDATE profile SET profileId = :profileId, firstName, lastName, email, zipCode, phone = :p "
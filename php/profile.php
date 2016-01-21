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

	/**
	 * mutator method for profileId
	 *
	 * @param mixed $newProfileId new value of profileId
	 * @throws InvalidArgumentException if $newProfileId is not an integer
	 * @throws RangeException if $newProfileId is not positive
	 **/

}
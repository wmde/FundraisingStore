<?php

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @since 2.0
 *
 * @ORM\Table( name="address" )
 * @ORM\Entity
 */
class Address {

	/**
	 * @var string
	 *
	 * @ORM\Column(name="salutation", type="string", length=16, nullable=true)
	 */
	private $salutation;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="company", type="string", length=100, nullable=true)
	 */
	private $company;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="title", type="string", length=16, nullable=true)
	 */
	private $title;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="first_name", type="string", length=50, options={"default":""}, nullable=false)
	 */
	private $firstName = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="last_name", type="string", length=50, options={"default":""}, nullable=false)
	 */
	private $lastName = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="street", type="string", length=100, nullable=true)
	 */
	private $address;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="postcode", type="string", length=8, nullable=true)
	 */
	private $postcode;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="city", type="string", length=100, nullable=true)
	 */
	private $city;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="country", type="string", length=8, options={"default":""}, nullable=true)
	 */
	private $country = '';

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;

	/**
	 * Set salutation
	 *
	 * @param string $salutation
	 * @return self
	 */
	public function setSalutation( $salutation ) {
		$this->salutation = $salutation;

		return $this;
	}

	/**
	 * Get salutation
	 *
	 * @return string
	 */
	public function getSalutation() {
		return $this->salutation;
	}

	/**
	 * Set company name
	 *
	 * @param string $company
	 * @return self
	 */
	public function setCompany( $company ) {
		$this->company = $company;

		return $this;
	}

	/**
	 * Get company name
	 *
	 * @return string
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * Set title
	 *
	 * @param string $title
	 * @return self
	 */
	public function setTitle( $title ) {
		$this->title = $title;

		return $this;
	}

	/**
	 * Get title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Set first name
	 *
	 * @param string $firstName
	 * @return self
	 */
	public function setFirstName( $firstName ) {
		$this->firstName = $firstName;

		return $this;
	}

	/**
	 * Get first name
	 *
	 * @return string
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Set last name
	 *
	 * @param string $lastName
	 * @return self
	 */
	public function setLastName( $lastName ) {
		$this->lastName = $lastName;

		return $this;
	}

	/**
	 * Get last name
	 *
	 * @return string
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * Set address (street, etc)
	 *
	 * @param string $address
	 * @return self
	 */
	public function setAddress( $address ) {
		$this->address = $address;

		return $this;
	}

	/**
	 * Get address (street, etc)
	 *
	 * @return string
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Set postcode
	 *
	 * @param string $postcode
	 * @return self
	 */
	public function setPostcode( $postcode ) {
		$this->postcode = $postcode;

		return $this;
	}

	/**
	 * Get postcode
	 *
	 * @return string
	 */
	public function getPostcode() {
		return $this->postcode;
	}

	/**
	 * Set city
	 *
	 * @param string $city
	 * @return self
	 */
	public function setCity( $city ) {
		$this->city = $city;

		return $this;
	}

	/**
	 * Get city
	 *
	 * @return string
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Set country
	 *
	 * @param string $country
	 * @return self
	 */
	public function setCountry( $country ) {
		$this->country = $country;

		return $this;
	}

	/**
	 * Get country
	 *
	 * @return string
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}
}
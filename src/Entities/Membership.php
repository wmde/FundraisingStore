<?php

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @since 2.0
 *
 * @ORM\Table(name="request", indexes={@ORM\Index(name="idx_donation_id", columns={"donation_id"})})
 * @ORM\Entity
 */
class Membership {

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="donation_id", type="integer", nullable=true)
	 */
	private $donationId;

	/**
	 * @var \DateTime
	 *
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(name="timestamp", type="datetime")
	 */
	private $timestamp;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="anrede", type="string", length=16, nullable=true)
	 */
	private $salutation;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="firma", type="string", length=100, nullable=true)
	 */
	private $company;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="titel", type="string", length=16, nullable=true)
	 */
	private $title;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=250, options={"default":""}, nullable=false)
	 */
	private $name = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="vorname", type="string", length=50, options={"default":""}, nullable=false)
	 */
	private $firstName = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="nachname", type="string", length=50, options={"default":""}, nullable=false)
	 */
	private $lastName = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="strasse", type="string", length=100, nullable=true)
	 */
	private $address;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="plz", type="string", length=8, nullable=true)
	 */
	private $postcode;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="ort", type="string", length=100, nullable=true)
	 */
	private $city;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=250, options={"default":""}, nullable=false)
	 */
	private $email = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="phone", type="string", length=30, options={"default":""}, nullable=false)
	 */
	private $phone = '';

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="dob", type="date", nullable=true)
	 */
	private $dob;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="wikimedium_shipping", type="string", options={"default":""}, nullable=false)
	 */
	private $wikimediumShipping = 'none';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="membership_type", type="string", options={"default":"sustaining"}, nullable=false)
	 */
	private $membershipType = 'sustaining';

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="membership_fee", type="integer", options={"default":0}, nullable=false)
	 */
	private $membershipFee = 0;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="membership_fee_interval", type="smallint", options={"default":12}, nullable=true)
	 */

	private $membershipFeeInterval = 12;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="account_number", type="string", length=16, options={"default":""}, nullable=false)
	 */
	private $accountNumber = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="bank_name", type="string", length=50, options={"default":""}, nullable=false)
	 */
	private $bankName = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="bank_code", type="string", length=16, options={"default":""}, nullable=false)
	 */
	private $bankCode = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="iban", type="string", length=32, options={"default":""}, nullable=true)
	 */
	private $iban = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="bic", type="string", length=32, options={"default":""}, nullable=true)
	 */
	private $bic = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="account_holder", type="string", length=50, options={"default":""}, nullable=false)
	 */
	private $accountHolder = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="comment", type="text", options={"default":""}, nullable=false)
	 */
	private $comment = '';

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="export", type="datetime", nullable=true)
	 */
	private $export;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="backup", type="datetime", nullable=true)
	 */
	private $backup;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="wikilogin", type="boolean", options={"default":0}, nullable=false)
	 */
	private $wikilogin = 0;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="tracking", type="string", length=50, nullable=true)
	 */
	private $tracking;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="status", type="smallint", options={"default":0}, nullable=true)
	 */
	private $status = 0;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="country", type="string", length=8, options={"default":""}, nullable=true)
	 */
	private $country = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="data", type="text", nullable=true)
	 */
	private $data;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;

	const STATUS_CONFIRMED = 1;
	const STATUS_NEUTRAL = 0;
	const STATUS_DELETED = -1;
	const STATUS_MODERATION = -2;
	const STATUS_ABORTED = -4;
	const STATUS_CANCELED = -8;

	/**
	 * Set donationId
	 *
	 * @param integer $donationId
	 * @return self
	 */
	public function setDonationId( $donationId ) {
		$this->donationId = $donationId;

		return $this;
	}

	/**
	 * Get donationId
	 *
	 * @return integer
	 */
	public function getDonationId() {
		return $this->donationId;
	}

	/**
	 * Set timestamp
	 *
	 * @param \DateTime $timestamp
	 * @return self
	 */
	public function setTimestamp( $timestamp ) {
		$this->timestamp = $timestamp;

		return $this;
	}

	/**
	 * Get timestamp
	 *
	 * @return \DateTime
	 */
	public function getTimestamp() {
		return $this->timestamp;
	}

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
	 * Set name
	 *
	 * @param string $name
	 * @return self
	 */
	public function setName( $name ) {
		$this->name = $name;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set first name
	 *
	 * @param string $firstName
	 * @return self
	 */
	public function setFirstName( $firstName ) {
		$this->firstName = $firstName;
		$this->setNameFromParts( $firstName, $this->getLastName() );

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
		$this->setNameFromParts( $this->getFirstName(), $lastName );

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
	 * Sets the full name
	 */
	public function setNameFromParts( $vorname, $nachname) {
		$parts = array_filter( [ $vorname, $nachname ] );
		$this->setName( implode( ' ', $parts ) );

		return $this;
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
	 * Set email
	 *
	 * @param string $email
	 * @return self
	 */
	public function setEmail( $email ) {
		$this->email = $email;

		return $this;
	}

	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Set phone
	 *
	 * @param string $phone
	 * @return self
	 */
	public function setPhone( $phone ) {
		$this->phone = $phone;

		return $this;
	}

	/**
	 * Get phone
	 *
	 * @return string
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Set dob
	 *
	 * @param \DateTime $dob
	 * @return self
	 */
	public function setDob( $dob ) {
		$this->dob = $dob;

		return $this;
	}

	/**
	 * Get dob
	 *
	 * @return \DateTime
	 */
	public function getDob() {
		return $this->dob;
	}

	/**
	 * Set wikimediumShipping
	 *
	 * @param string $wikimediumShipping
	 * @return self
	 */
	public function setWikimediumShipping( $wikimediumShipping ) {
		$this->wikimediumShipping = $wikimediumShipping;

		return $this;
	}

	/**
	 * Get wikimediumShipping
	 *
	 * @return string
	 */
	public function getWikimediumShipping() {
		return $this->wikimediumShipping;
	}

	/**
	 * Set membershipType
	 *
	 * @param string $membershipType
	 * @return self
	 */
	public function setMembershipType( $membershipType ) {
		$this->membershipType = $membershipType;

		return $this;
	}

	/**
	 * Get membershipType
	 *
	 * @return string
	 */
	public function getMembershipType() {
		return $this->membershipType;
	}

	/**
	 * Set membershipFee
	 *
	 * @param integer $membershipFee
	 * @return self
	 */
	public function setMembershipFee( $membershipFee ) {
		$this->membershipFee = $membershipFee;

		return $this;
	}

	/**
	 * Get membershipFee
	 *
	 * @return integer
	 */
	public function getMembershipFee() {
		return $this->membershipFee;
	}

	/**
	 * Set membershipFeeInterval
	 *
	 * @param integer $membershipFeeInterval
	 * @return self
	 */
	public function setMembershipFeeInterval($membershipFeeInterval) {
		$this->membershipFeeInterval = $membershipFeeInterval;

		return $this;
	}

	/**
	 * Get membershipFeeInterval
	 *
	 * @return integer
	 */
	public function getMembershipFeeInterval() {
		return $this->membershipFeeInterval;
	}


	/**
	 * Set accountNumber
	 *
	 * @param string $accountNumber
	 * @return self
	 */
	public function setAccountNumber( $accountNumber ) {
		$this->accountNumber = $accountNumber;

		return $this;
	}

	/**
	 * Get accountNumber
	 *
	 * @return string
	 */
	public function getAccountNumber() {
		return $this->accountNumber;
	}

	/**
	 * Set bankName
	 *
	 * @param string $bankName
	 * @return self
	 */
	public function setBankName( $bankName ) {
		$this->bankName = $bankName;

		return $this;
	}

	/**
	 * Get bankName
	 *
	 * @return string
	 */
	public function getBankName() {
		return $this->bankName;
	}

	/**
	 * Set bankCode
	 *
	 * @param string $bankCode
	 * @return self
	 */
	public function setBankCode( $bankCode ) {
		$this->bankCode = $bankCode;

		return $this;
	}

	/**
	 * Get bankCode
	 *
	 * @return string
	 */
	public function getBankCode() {
		return $this->bankCode;
	}

	/**
	 * Set iban
	 *
	 * @param string $iban
	 * @return self
	 */
	public function setIban( $iban ) {
		$this->iban = $iban;

		return $this;
	}

	/**
	 * Get iban
	 *
	 * @return string
	 */
	public function getIban() {
		return $this->iban;
	}

	/**
	 * Set bic
	 *
	 * @param string $bic
	 * @return self
	 */
	public function setBic( $bic ) {
		$this->bic = $bic;

		return $this;
	}

	/**
	 * Get bic
	 *
	 * @return string
	 */
	public function getBic() {
		return $this->bic;
	}

	/**
	 * Set accountHolder
	 *
	 * @param string $accountHolder
	 * @return self
	 */
	public function setAccountHolder( $accountHolder ) {
		$this->accountHolder = $accountHolder;

		return $this;
	}

	/**
	 * Get accountHolder
	 *
	 * @return string
	 */
	public function getAccountHolder() {
		return $this->accountHolder;
	}

	/**
	 * Set comment
	 *
	 * @param string $comment
	 * @return self
	 */
	public function setComment( $comment ) {
		$this->comment = $comment;

		return $this;
	}

	/**
	 * Get comment
	 *
	 * @return string
	 */
	public function getComment() {
		return $this->comment;
	}

	/**
	 * Set export
	 *
	 * @param \DateTime $export
	 * @return self
	 */
	public function setExport( $export ) {
		$this->export = $export;

		return $this;
	}

	/**
	 * Get export
	 *
	 * @return \DateTime
	 */
	public function getExport() {
		return $this->export;
	}

	/**
	 * Set backup
	 *
	 * @param \DateTime $backup
	 * @return self
	 */
	public function setBackup( $backup ) {
		$this->backup = $backup;

		return $this;
	}

	/**
	 * Get backup
	 *
	 * @return \DateTime
	 */
	public function getBackup() {
		return $this->backup;
	}

	/**
	 * Set wikilogin
	 *
	 * @param boolean $wikilogin
	 * @return self
	 */
	public function setWikilogin( $wikilogin ) {
		$this->wikilogin = $wikilogin;

		return $this;
	}

	/**
	 * Get wikilogin
	 *
	 * @return boolean
	 */
	public function getWikilogin() {
		return $this->wikilogin;
	}

	/**
	 * Set tracking
	 *
	 * @param string $tracking
	 * @return self
	 */
	public function setTracking( $tracking ) {
		$this->tracking = $tracking;

		return $this;
	}

	/**
	 * Get tracking
	 *
	 * @return string
	 */
	public function getTracking() {
		return $this->tracking;
	}

	/**
	 * Set status
	 *
	 * @param integer $status
	 * @return self
	 */
	public function setStatus( $status ) {
		$this->status = $status;

		return $this;
	}

	/**
	 * Get status
	 *
	 * @return integer
	 */
	public function getStatus() {
		return $this->status;
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
	 * Set data
	 *
	 * @param string $data
	 * @return self
	 */
	public function setData( $data ) {
		$this->data = $data;

		return $this;
	}

	/**
	 * Get data
	 *
	 * @return string
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	public function isUnconfirmed() {
		return $this->getStatus() === self::STATUS_NEUTRAL;
	}

	public function log( $message ) {
		$dataArray = $this->getDataArray();
		$dataArray[ "log" ][ date( "Y-m-d H:i:s" ) ] = $message;
		return $this->saveDataArray( $dataArray );
	}

	private function getDataArray() {
		return unserialize( base64_decode( $this->data ) );
	}

	private function saveDataArray( array $dataArray ) {
		$this->data = base64_encode( serialize( $dataArray ) );
		return $this;
	}
}

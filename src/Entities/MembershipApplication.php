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
class MembershipApplication {

	/**
	 * @var integer|null
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
	 * @var string|null
	 *
	 * @ORM\Column(name="anrede", type="string", length=16, nullable=true)
	 */
	private $salutation;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="firma", type="string", length=100, nullable=true)
	 */
	private $company;

	/**
	 * @var string|null
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
	 * @var string|null
	 *
	 * @ORM\Column(name="strasse", type="string", length=100, nullable=true)
	 */
	private $address;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="plz", type="string", length=8, nullable=true)
	 */
	private $postcode;

	/**
	 * @var string|null
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
	 * Date of birth
	 *
	 * @var \DateTime|null
	 *
	 * @ORM\Column(name="dob", type="date", nullable=true)
	 */
	private $dateOfBirth;

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
	 * FIXME: this should not be nullable
	 *
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
	 * @var string|null
	 *
	 * @ORM\Column(name="iban", type="string", length=32, options={"default":""}, nullable=true)
	 */
	private $iban = '';

	/**
	 * @var string|null
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
	 * @var \DateTime|null
	 *
	 * @ORM\Column(name="export", type="datetime", nullable=true)
	 */
	private $export;

	/**
	 * @var \DateTime|null
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
	 * @var string|null
	 *
	 * @ORM\Column(name="tracking", type="string", length=50, nullable=true)
	 */
	private $tracking;

	/**
	 * FIXME: this should not be nullable
	 *
	 * @var integer
	 *
	 * @ORM\Column(name="status", type="smallint", options={"default":0}, nullable=true)
	 */
	private $status = 0;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="country", type="string", length=8, options={"default":""}, nullable=true)
	 */
	private $country = '';

	/**
	 * @var string|null
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
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param integer|null $donationId
	 *
	 * @return self
	 */
	public function setDonationId( $donationId ) {
		$this->donationId = $donationId;

		return $this;
	}

	/**
	 * Returns the id of the donation that led to the membership application,
	 * or null when the application is not linked to any donation.
	 *
	 * @return integer|null
	 */
	public function getDonationId() {
		return $this->donationId;
	}

	/**
	 * @param \DateTime $timestamp
	 *
	 * @return self
	 */
	public function setTimestamp( $timestamp ) {
		$this->timestamp = $timestamp;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getTimestamp() {
		return $this->timestamp;
	}

	/**
	 * @param string|null $salutation
	 *
	 * @return self
	 */
	public function setSalutation( $salutation ) {
		$this->salutation = $salutation;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getSalutation() {
		return $this->salutation;
	}

	/**
	 * @param string|null $company
	 *
	 * @return self
	 */
	public function setCompany( $company ) {
		$this->company = $company;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * @param string $title
	 *
	 * @return self
	 */
	public function setTitle( $title ) {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $name
	 *
	 * @return self
	 */
	public function setName( $name ) {
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $firstName
	 *
	 * @return self
	 */
	public function setFirstName( $firstName ) {
		$this->firstName = $firstName;
		$this->setNameFromParts( $firstName, $this->getLastName() );

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @param string $lastName
	 *
	 * @return self
	 */
	public function setLastName( $lastName ) {
		$this->lastName = $lastName;
		$this->setNameFromParts( $this->getFirstName(), $lastName );

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * Sets the full name
	 *
	 * @param string|null $firstName
	 * @param string|null $lastName
	 *
	 * @return self
	 */
	private function setNameFromParts( $firstName, $lastName ) {
		$this->setName( implode(
			' ',
			array_filter( [ $firstName, $lastName ] )
		) );

		return $this;
	}

	/**
	 * Set address (street, etc)
	 *
	 * @param string|null $address
	 *
	 * @return self
	 */
	public function setAddress( $address ) {
		$this->address = $address;

		return $this;
	}

	/**
	 * Get address (street, etc)
	 *
	 * @return string|null
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @param string|null $postcode
	 *
	 * @return self
	 */
	public function setPostcode( $postcode ) {
		$this->postcode = $postcode;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getPostcode() {
		return $this->postcode;
	}

	/**
	 * @param string|null $city
	 *
	 * @return self
	 */
	public function setCity( $city ) {
		$this->city = $city;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Set email
	 *
	 * @param string $email
	 *
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
	 *
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
	 * Sets the date of birth of the applicant
	 *
	 * @param \DateTime|null $dateOfBirth
	 *
	 * @return self
	 */
	public function setDob( $dateOfBirth ) {
		$this->dateOfBirth = $dateOfBirth;

		return $this;
	}

	/**
	 * Returns the date of birth of the applicant
	 *
	 * @return \DateTime|null
	 */
	public function getDob() {
		return $this->dateOfBirth;
	}

	/**
	 * @param string $wikimediumShipping
	 *
	 * @return self
	 */
	public function setWikimediumShipping( $wikimediumShipping ) {
		$this->wikimediumShipping = $wikimediumShipping;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getWikimediumShipping() {
		return $this->wikimediumShipping;
	}

	/**
	 * @param string $membershipType
	 *
	 * @return self
	 */
	public function setMembershipType( $membershipType ) {
		$this->membershipType = $membershipType;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getMembershipType() {
		return $this->membershipType;
	}

	/**
	 * @param integer $membershipFee
	 *
	 * @return self
	 */
	public function setMembershipFee( $membershipFee ) {
		$this->membershipFee = $membershipFee;

		return $this;
	}

	/**
	 * @return integer
	 */
	public function getMembershipFee() {
		return $this->membershipFee;
	}

	/**
	 * @param integer $membershipFeeInterval
	 *
	 * @return self
	 */
	public function setMembershipFeeInterval($membershipFeeInterval) {
		$this->membershipFeeInterval = $membershipFeeInterval;

		return $this;
	}

	/**
	 * @return integer
	 */
	public function getMembershipFeeInterval() {
		return $this->membershipFeeInterval;
	}


	/**
	 * @param string $accountNumber
	 *
	 * @return self
	 */
	public function setAccountNumber( $accountNumber ) {
		$this->accountNumber = $accountNumber;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAccountNumber() {
		return $this->accountNumber;
	}

	/**
	 * @param string $bankName
	 *
	 * @return self
	 */
	public function setBankName( $bankName ) {
		$this->bankName = $bankName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getBankName() {
		return $this->bankName;
	}

	/**
	 * @param string $bankCode
	 *
	 * @return self
	 */
	public function setBankCode( $bankCode ) {
		$this->bankCode = $bankCode;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getBankCode() {
		return $this->bankCode;
	}

	/**
	 * @param string|null $iban
	 *
	 * @return self
	 */
	public function setIban( $iban ) {
		$this->iban = $iban;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getIban() {
		return $this->iban;
	}

	/**
	 * @param string|null $bic
	 *
	 * @return self
	 */
	public function setBic( $bic ) {
		$this->bic = $bic;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getBic() {
		return $this->bic;
	}

	/**
	 * @param string $accountHolder
	 *
	 * @return self
	 */
	public function setAccountHolder( $accountHolder ) {
		$this->accountHolder = $accountHolder;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAccountHolder() {
		return $this->accountHolder;
	}

	/**
	 * @param string $comment
	 *
	 * @return self
	 */
	public function setComment( $comment ) {
		$this->comment = $comment;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getComment() {
		return $this->comment;
	}

	/**
	 * Sets the time of export.
	 *
	 * @param \DateTime|null $export
	 *
	 * @return self
	 */
	public function setExport( $export ) {
		$this->export = $export;

		return $this;
	}

	/**
	 * Returns the time of export.
	 *
	 * @return \DateTime|null
	 */
	public function getExport() {
		return $this->export;
	}

	/**
	 * Sets the time of backup.
	 *
	 * @param \DateTime|null $backup
	 *
	 * @return self
	 */
	public function setBackup( $backup ) {
		$this->backup = $backup;

		return $this;
	}

	/**
	 * Returns the time of backup.
	 *
	 * @return \DateTime|null
	 */
	public function getBackup() {
		return $this->backup;
	}

	/**
	 * @param boolean $wikilogin
	 *
	 * @return self
	 */
	public function setWikilogin( $wikilogin ) {
		$this->wikilogin = $wikilogin;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function getWikilogin() {
		return $this->wikilogin;
	}

	/**
	 * @param string|null $tracking
	 *
	 * @return self
	 */
	public function setTracking( $tracking ) {
		$this->tracking = $tracking;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getTracking() {
		return $this->tracking;
	}

	/**
	 * Sets the status of the membership request.
	 * The allowed values are the STATUS_ constants in this class.
	 *
	 * @param integer $status
	 *
	 * @return self
	 */
	public function setStatus( $status ) {
		$this->status = $status;

		return $this;
	}

	/**
	 * Returns the status of the membership request.
	 * The possible values are the STATUS_ constants in this class.
	 *
	 * @return integer
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param string|null $country
	 *
	 * @return self
	 */
	public function setCountry( $country ) {
		$this->country = $country;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @param string|null $data
	 * @return self
	 */
	public function setData( $data ) {
		$this->data = $data;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getData() {
		return $this->data;
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

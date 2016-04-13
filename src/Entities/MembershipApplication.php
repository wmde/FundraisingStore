<?php

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use WMDE\Fundraising\Store\MembershipApplicationData;

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
	private $creationTime;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="anrede", type="string", length=16, nullable=true)
	 */
	private $applicantSalutation;

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
	private $applicantTitle;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=250, options={"default":""}, nullable=false)
	 */
	private $probablyUnusedNameField = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="vorname", type="string", length=50, options={"default":""}, nullable=false)
	 */
	private $applicantFirstName = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="nachname", type="string", length=50, options={"default":""}, nullable=false)
	 */
	private $applicantLastName = '';

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
	 * @var string|null
	 *
	 * @ORM\Column(name="country", type="string", length=8, options={"default":""}, nullable=true)
	 */
	private $country = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=250, options={"default":""}, nullable=false)
	 */
	private $applicantEmailAddress = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="phone", type="string", length=30, options={"default":""}, nullable=false)
	 */
	private $applicantPhoneNumber = '';

	/**
	 * Date of birth
	 *
	 * @var \DateTime|null
	 *
	 * @ORM\Column(name="dob", type="date", nullable=true)
	 */
	private $applicantDateOfBirth;

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
	private $paymentAmountInEuro = 0;

	/**
	 * FIXME: this should not be nullable
	 *
	 * @var integer
	 *
	 * @ORM\Column(name="membership_fee_interval", type="smallint", options={"default":12}, nullable=true)
	 */
	private $paymentIntervalInMonths = 12;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="account_number", type="string", length=16, options={"default":""}, nullable=false)
	 */
	private $paymentBankAccount = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="bank_name", type="string", length=50, options={"default":""}, nullable=false)
	 */
	private $paymentBankName = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="bank_code", type="string", length=16, options={"default":""}, nullable=false)
	 */
	private $paymentBankCode = '';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="iban", type="string", length=32, options={"default":""}, nullable=true)
	 */
	private $paymentIban = '';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="bic", type="string", length=32, options={"default":""}, nullable=true)
	 */
	private $paymentBic = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="account_holder", type="string", length=50, options={"default":""}, nullable=false)
	 */
	private $paymentBankAccountHolder = '';

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
	 * @since 2.0
	 *
	 * @param integer|null $id
	 */
	public function setId( $id ) {
		$this->id = $id;
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
	 * @param \DateTime $creationTime
	 *
	 * @return self
	 */
	public function setCreationTime( $creationTime ) {
		$this->creationTime = $creationTime;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreationTime() {
		return $this->creationTime;
	}

	/**
	 * @param string|null $applicantSalutation
	 *
	 * @return self
	 */
	public function setApplicantSalutation( $applicantSalutation ) {
		$this->applicantSalutation = $applicantSalutation;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getApplicantSalutation() {
		return $this->applicantSalutation;
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
	 * @param string $applicantTitle
	 *
	 * @return self
	 */
	public function setApplicantTitle( $applicantTitle ) {
		$this->applicantTitle = $applicantTitle;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getApplicantTitle() {
		return $this->applicantTitle;
	}

	/**
	 * @param string $probablyUnusedNameField
	 *
	 * @return self
	 */
	public function setProbablyUnusedNameField( $probablyUnusedNameField ) {
		$this->probablyUnusedNameField = $probablyUnusedNameField;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getProbablyUnusedNameField() {
		return $this->probablyUnusedNameField;
	}

	/**
	 * @param string $applicantFirstName
	 *
	 * @return self
	 */
	public function setApplicantFirstName( $applicantFirstName ) {
		$this->applicantFirstName = $applicantFirstName;
		$this->setNameFromParts( $applicantFirstName, $this->getApplicantLastName() );

		return $this;
	}

	/**
	 * @return string
	 */
	public function getApplicantFirstName() {
		return $this->applicantFirstName;
	}

	/**
	 * @param string $applicantLastName
	 *
	 * @return self
	 */
	public function setApplicantLastName( $applicantLastName ) {
		$this->applicantLastName = $applicantLastName;
		$this->setNameFromParts( $this->getApplicantFirstName(), $applicantLastName );

		return $this;
	}

	/**
	 * @return string
	 */
	public function getApplicantLastName() {
		return $this->applicantLastName;
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
		$this->setProbablyUnusedNameField( implode(
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
	 * @param string $applicantEmailAddress
	 *
	 * @return self
	 */
	public function setApplicantEmailAddress( $applicantEmailAddress ) {
		$this->applicantEmailAddress = $applicantEmailAddress;

		return $this;
	}

	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getApplicantEmailAddress() {
		return $this->applicantEmailAddress;
	}

	/**
	 * Set phone
	 *
	 * @param string $applicantPhoneNumber
	 *
	 * @return self
	 */
	public function setApplicantPhoneNumber( $applicantPhoneNumber ) {
		$this->applicantPhoneNumber = $applicantPhoneNumber;

		return $this;
	}

	/**
	 * Get phone
	 *
	 * @return string
	 */
	public function getApplicantPhoneNumber() {
		return $this->applicantPhoneNumber;
	}

	/**
	 * @param \DateTime|null $dateOfBirth
	 *
	 * @return self
	 */
	public function setApplicantDateOfBirth( $dateOfBirth ) {
		$this->applicantDateOfBirth = $dateOfBirth;

		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getApplicantDateOfBirth() {
		return $this->applicantDateOfBirth;
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
	 * @param integer $paymentAmountInEuro
	 *
	 * @return self
	 */
	public function setPaymentAmount( $paymentAmountInEuro ) {
		$this->paymentAmountInEuro = $paymentAmountInEuro;

		return $this;
	}

	/**
	 * @return integer
	 */
	public function getPaymentAmount() {
		return $this->paymentAmountInEuro;
	}

	/**
	 * @param integer $paymentIntervalInMonths
	 *
	 * @return self
	 */
	public function setPaymentIntervalInMonths($paymentIntervalInMonths) {
		$this->paymentIntervalInMonths = $paymentIntervalInMonths;

		return $this;
	}

	/**
	 * @return integer
	 */
	public function getPaymentIntervalInMonths() {
		return $this->paymentIntervalInMonths;
	}


	/**
	 * @param string $paymentBankAccount
	 *
	 * @return self
	 */
	public function setPaymentBankAccount( $paymentBankAccount ) {
		$this->paymentBankAccount = $paymentBankAccount;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPaymentBankAccount() {
		return $this->paymentBankAccount;
	}

	/**
	 * @param string $paymentBankName
	 *
	 * @return self
	 */
	public function setPaymentBankName( $paymentBankName ) {
		$this->paymentBankName = $paymentBankName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPaymentBankName() {
		return $this->paymentBankName;
	}

	/**
	 * @param string $paymentBankCode
	 *
	 * @return self
	 */
	public function setPaymentBankCode( $paymentBankCode ) {
		$this->paymentBankCode = $paymentBankCode;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPaymentBankCode() {
		return $this->paymentBankCode;
	}

	/**
	 * @param string|null $paymentIban
	 *
	 * @return self
	 */
	public function setPaymentIban( $paymentIban ) {
		$this->paymentIban = $paymentIban;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getPaymentIban() {
		return $this->paymentIban;
	}

	/**
	 * @param string|null $paymentBic
	 *
	 * @return self
	 */
	public function setPaymentBic( $paymentBic ) {
		$this->paymentBic = $paymentBic;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getPaymentBic() {
		return $this->paymentBic;
	}

	/**
	 * @param string $paymentBankAccountHolder
	 *
	 * @return self
	 */
	public function setPaymentBankAccountHolder( $paymentBankAccountHolder ) {
		$this->paymentBankAccountHolder = $paymentBankAccountHolder;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPaymentBankAccountHolder() {
		return $this->paymentBankAccountHolder;
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
		$dataArray = $this->getDecodedData();
		$dataArray[ "log" ][ date( "Y-m-d H:i:s" ) ] = $message;
		$this->encodeAndSetData( $dataArray );

		return $this;
	}

	/**
	 * NOTE: if possible, use @see getDataObject instead, as it provides a nicer API.
	 *
	 * @since 2.0
	 * @return array
	 */
	public function getDecodedData() {
		$data = unserialize( base64_decode( $this->data ) );

		return is_array( $data ) ? $data : [];
	}

	/**
	 * NOTE: if possible, use @see modifyDataObject instead, as it provides a nicer API.
	 *
	 * @since 2.0
	 * @param array $data
	 */
	public function encodeAndSetData( array $dataArray ) {
		$this->data = base64_encode( serialize( $dataArray ) );
	}

	/**
	 * WARNING: updates made to the return value will not be reflected in the Donation state.
	 * Similarly, updates to the Donation state will not propagate to the returned object.
	 * To update the Donation state, explicitly call @see setDataObject.
	 *
	 * @since 2.0
	 * @return MembershipApplicationData
	 */
	public function getDataObject() {
		$dataArray = $this->getDecodedData();

		$data = new MembershipApplicationData();

		$data->setAccessToken( array_key_exists( 'token', $dataArray ) ? $dataArray['token'] : null );
		$data->setUpdateToken( array_key_exists( 'utoken', $dataArray ) ? $dataArray['utoken'] : null );

		return $data;
	}

	/**
	 * @since 2.0
	 * @param MembershipApplicationData $data
	 */
	public function setDataObject( MembershipApplicationData $data ) {
		$dataArray = array_merge(
			$this->getDecodedData(),
			[
				'token' => $data->getAccessToken(),
				'utoken' => $data->getUpdateToken(),
			]
		);

		foreach ( [ 'token', 'utoken' ] as $keyName ) {
			if ( is_null( $dataArray[$keyName] ) ) {
				unset( $dataArray[$keyName] );
			}
		}

		$this->encodeAndSetData( $dataArray );
	}

	/**
	 * @since 2.0
	 * @param callable $modificationFunction Takes a modifiable MembershipApplicationData parameter
	 */
	public function modifyDataObject( callable $modificationFunction ) {
		$dataObject = $this->getDataObject();
		$modificationFunction( $dataObject );
		$this->setDataObject( $dataObject );
	}

}

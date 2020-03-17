<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use WMDE\Fundraising\Store\MembershipApplicationData;

/**
 * @since 2.0
 *
 * @ORM\Table(
 *     name="request",
 *     indexes={
 *			@ORM\Index(name="m_email", columns={"email"}, flags={"fulltext"}),
 *          @ORM\Index(name="m_name", columns={"name"}, flags={"fulltext"}),
 *     		@ORM\Index(name="m_ort", columns={"ort"}, flags={"fulltext"})
 *     }
 *	 )
 * @ORM\Entity
 */
class MembershipApplication {

	public const STATUS_CONFIRMED = 1;
	public const STATUS_NEUTRAL = 0;
	public const STATUS_DELETED = -1;
	public const STATUS_MODERATION = -2;
	public const STATUS_ABORTED = -4;
	public const STATUS_CANCELED = -8;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;

	/**
	 * FIXME: this should not be nullable
	 *
	 * @var integer
	 *
	 * @ORM\Column(name="status", type="smallint", options={"default":0}, nullable=true)
	 */
	private $status = 0;

	/**
	 * This is no longer written by the fundraising frontend.
	 *
	 * Until we remove all references to this field in the backend, the field is not removed but just marked as deprecated.
	 *
	 * @deprecated
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
	 * @var string
	 *
	 * @ORM\Column(name="payment_type", type="string", options={"default":"BEZ"}, nullable=false)
	 */
	private $paymentType = 'BEZ';

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
	 * @ORM\Column(name="bank_name", type="string", length=100, options={"default":""}, nullable=false)
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
	 * @var string|null
	 *
	 * @ORM\Column(name="data", type="text", nullable=true)
	 */
	private $data;

	/**
	 * @var boolean|null
	 *
	 * @ORM\Column(name="donation_receipt", type="boolean", nullable=true)
	 */
	private $donationReceipt;

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
	 * @param \DateTime|null $creationTime
	 *
	 * @return self
	 */
	public function setCreationTime( $creationTime ) {
		$this->creationTime = $creationTime;

		return $this;
	}

	/**
	 * @return \DateTime|null
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
	 * @since 2.1
	 *
	 * @param string $paymentType
	 *
	 * @return self
	 */
	public function setPaymentType( $paymentType ) {
		$this->paymentType = $paymentType;

		return $this;
	}

	/**
	 * @since 2.1
	 *
	 * @return string
	 */
	public function getPaymentType() {
		return $this->paymentType;
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

	/**
	 * @return bool
	 */
	public function isUnconfirmed() {
		return $this->status === self::STATUS_NEUTRAL;
	}

	/**
	 * @return bool
	 */
	public function needsModeration() {
		return $this->status < 0 && abs( $this->status ) & abs( self::STATUS_MODERATION );
	}

	/**
	 * @return bool
	 */
	public function isCancelled() {
		return $this->status < 0 && abs( $this->status ) & abs( self::STATUS_CANCELED );
	}

	/**
	 * @since 4.2
	 * @return bool
	 */
	public function isDeleted() {
		return $this->status < 0 && abs( $this->status ) & abs( self::STATUS_DELETED );
	}

	public function log( $message ) {
		$dataArray = $this->getDecodedData();
		$dataArray['log'][date( 'Y-m-d H:i:s' )] = $message;
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
		if ( $this->data === null ) {
			return [];
		}

		$data = unserialize( base64_decode( $this->data ) );

		return is_array( $data ) ? $data : [];
	}

	/**
	 * NOTE: if possible, use @see modifyDataObject instead, as it provides a nicer API.
	 *
	 * @since 2.0
	 * @param array $dataArray
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
		$data->setPreservedStatus( array_key_exists( 'old_status', $dataArray ) ? $dataArray['old_status'] : null );

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
				'old_status' => $data->getPreservedStatus(),
			]
		);

		foreach ( [ 'token', 'utoken', 'old_status' ] as $keyName ) {
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

	/**
	 * Set donation receipt state
	 *
	 * @since 7.0
	 *
	 * @param boolean|null $donationReceipt
	 * @return self
	 */
	public function setDonationReceipt( ?bool $donationReceipt ): self {
		$this->donationReceipt = $donationReceipt;

		return $this;
	}

	/**
	 * Get donation receipt state
	 *
	 * @since 7.0
	 *
	 * @return boolean|null
	 */
	public function getDonationReceipt(): ?bool {
		return $this->donationReceipt;
	}
}

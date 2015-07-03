<?php

namespace WMDE\Fundraising\Entities;

use ContactRequest;
use Doctrine\ORM\Mapping as ORM;

/**
 * Request
 *
 * @ORM\Table(name="request", indexes={@ORM\Index(name="idx_donation_id", columns={"donation_id"})})
 * @ORM\Entity
 */
class Request {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="donation_id", type="integer", nullable=true)
	 */
	private $donationId;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="timestamp", type="datetime", nullable=false)
	 */
	private $timestamp;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="anrede", type="string", length=16, nullable=true)
	 */
	private $anrede;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="firma", type="string", length=100, nullable=true)
	 */
	private $firma;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="titel", type="string", length=16, nullable=true)
	 */
	private $titel;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=250, nullable=false)
	 */
	private $name;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="vorname", type="string", length=50, nullable=false)
	 */
	private $vorname;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="nachname", type="string", length=50, nullable=false)
	 */
	private $nachname;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="strasse", type="string", length=100, nullable=true)
	 */
	private $strasse;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="plz", type="string", length=8, nullable=true)
	 */
	private $plz;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="ort", type="string", length=100, nullable=true)
	 */
	private $ort;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=250, nullable=false)
	 */
	private $email;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="phone", type="string", length=30, nullable=false)
	 */
	private $phone;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="dob", type="date", nullable=false)
	 */
	private $dob;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="wikimedium_shipping", type="string", nullable=false)
	 */
	private $wikimediumShipping;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="membership_type", type="string", nullable=false)
	 */
	private $membershipType;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="membership_fee", type="integer", nullable=false)
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
	 * @ORM\Column(name="account_number", type="string", length=16, nullable=false)
	 */
	private $accountNumber;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="bank_name", type="string", length=50, nullable=false)
	 */
	private $bankName;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="bank_code", type="string", length=16, nullable=false)
	 */
	private $bankCode;

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
	 * @ORM\Column(name="account_holder", type="string", length=50, nullable=false)
	 */
	private $accountHolder;

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
	 * @var string
	 *
	 * @ORM\Column(name="guid", type="blob", length=16, nullable=true)
	 */
	private $guid;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="type", type="string", options={"default":"membership"}, nullable=false)
	 */
	private $type = 'membership';

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;


	/**
	 * Set donationId
	 *
	 * @param integer $donationId
	 * @return Request
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
	 * @return Request
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
	 * Set anrede
	 *
	 * @param string $anrede
	 * @return Request
	 */
	public function setAnrede( $anrede ) {
		$this->anrede = $anrede;

		return $this;
	}

	/**
	 * Get anrede
	 *
	 * @return string
	 */
	public function getAnrede() {
		return $this->anrede;
	}

	/**
	 * Set firma
	 *
	 * @param string $firma
	 * @return Request
	 */
	public function setFirma( $firma ) {
		$this->firma = $firma;

		return $this;
	}

	/**
	 * Get firma
	 *
	 * @return string
	 */
	public function getFirma() {
		return $this->firma;
	}

	/**
	 * Set titel
	 *
	 * @param string $titel
	 * @return Request
	 */
	public function setTitel( $titel ) {
		$this->titel = $titel;

		return $this;
	}

	/**
	 * Get titel
	 *
	 * @return string
	 */
	public function getTitel() {
		return $this->titel;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 * @return Request
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
	 * Set vorname
	 *
	 * @param string $vorname
	 * @return Request
	 */
	public function setVorname( $vorname ) {
		$this->vorname = $vorname;

		return $this;
	}

	/**
	 * Get vorname
	 *
	 * @return string
	 */
	public function getVorname() {
		return $this->vorname;
	}

	/**
	 * Set nachname
	 *
	 * @param string $nachname
	 * @return Request
	 */
	public function setNachname( $nachname ) {
		$this->nachname = $nachname;

		return $this;
	}

	/**
	 * Get nachname
	 *
	 * @return string
	 */
	public function getNachname() {
		return $this->nachname;
	}

	/**
	 * Set strasse
	 *
	 * @param string $strasse
	 * @return Request
	 */
	public function setStrasse( $strasse ) {
		$this->strasse = $strasse;

		return $this;
	}

	/**
	 * Get strasse
	 *
	 * @return string
	 */
	public function getStrasse() {
		return $this->strasse;
	}

	/**
	 * Set plz
	 *
	 * @param string $plz
	 * @return Request
	 */
	public function setPlz( $plz ) {
		$this->plz = $plz;

		return $this;
	}

	/**
	 * Get plz
	 *
	 * @return string
	 */
	public function getPlz() {
		return $this->plz;
	}

	/**
	 * Set ort
	 *
	 * @param string $ort
	 * @return Request
	 */
	public function setOrt( $ort ) {
		$this->ort = $ort;

		return $this;
	}

	/**
	 * Get ort
	 *
	 * @return string
	 */
	public function getOrt() {
		return $this->ort;
	}

	/**
	 * Set email
	 *
	 * @param string $email
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 *
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * @return Request
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
	 * Set guid
	 *
	 * @param string $guid
	 * @return Request
	 */
	public function setGuid( $guid ) {
		$this->guid = $guid;

		return $this;
	}

	/**
	 * Get guid
	 *
	 * @return string
	 */
	public function getGuid() {
		return $this->guid;
	}

	/**
	 * Set type
	 *
	 * @param string $type
	 * @return Request
	 */
	public function setType( $type ) {
		$this->type = $type;

		return $this;
	}

	/**
	 * Get type
	 *
	 * @return string
	 */
	public function getType() {
		return $this->type;
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
		return $this->getStatus() === ContactRequest::STATUS_NEUTRAL;
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

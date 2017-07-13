<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use WMDE\Fundraising\Store\DonationData;

/**
 * @since 2.0
 *
 * @ORM\Table(
 *     name="spenden",
 *     indexes={
 *         @ORM\Index(name="d_email", columns={"email"}, flags={"fulltext"}),
 *         @ORM\Index(name="d_name", columns={"name"}, flags={"fulltext"}),
 *         @ORM\Index(name="d_ort", columns={"ort"}, flags={"fulltext"}),
 *         @ORM\Index(name="d_dt_new", columns={"dt_new", "is_public"}),
 *         @ORM\Index(name="d_zahlweise", columns={"zahlweise", "dt_new"}),
 *         @ORM\Index(name="d_dt_gruen", columns={"dt_gruen", "dt_del"}),
 *         @ORM\Index(name="d_ueb_code", columns={"ueb_code"}),
 *         @ORM\Index(name="d_dt_backup", columns={"dt_backup"}),
 *         @ORM\Index(name="d_status", columns={"status", "dt_new"}),
 *         @ORM\Index(name="d_comment_list", columns={"is_public", "dt_del"})
 *     }
 * )
 * @ORM\Entity
 */
class Donation {

	/**
	 * @since 2.0
	 */
	public const STATUS_NEW = 'N'; // status for direct debit
	public const STATUS_PROMISE = 'Z'; // status for bank transfer
	public const STATUS_EXTERNAL_INCOMPLETE = 'X'; // status for external payments
	public const STATUS_EXTERNAL_BOOKED = 'B'; // status for external payments
	public const STATUS_MODERATION = 'P';
	public const STATUS_CANCELLED = 'D';

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="status", type="string", length=1, options={"default":"N", "fixed":true}, nullable=false)
	 */
	private $status = self::STATUS_NEW;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=250, nullable=true)
	 */
	private $donorFullName;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="ort", type="string", length=250, nullable=true)
	 */
	private $donorCity;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=250, nullable=true)
	 */
	private $donorEmail;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="info", type="boolean", options={"default":0}, nullable=false)
	 */
	private $donorOptsIntoNewsletter = 0;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="bescheinigung", type="boolean", nullable=true)
	 */
	private $donationReceipt;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="eintrag", type="string", length=250, options={"default":""}, nullable=false)
	 */
	private $publicRecord = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="betrag", type="string", length=250, nullable=true)
	 */
	private $amount;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="periode", type="smallint", options={"default":0}, nullable=false)
	 */
	private $paymentIntervalInMonths = 0;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="zahlweise", type="string", length=3, options={"default":"BEZ", "fixed":true}, nullable=false)
	 */
	private $paymentType = 'BEZ';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="kommentar", type="text", options={"default":""}, nullable=false)
	 */
	private $comment = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="ueb_code", type="string", length=32, options={"default":""}, nullable=false)
	 */
	private $bankTransferCode = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="data", type="text", nullable=true)
	 */
	private $data;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="source", type="string", length=250, nullable=true)
	 */
	private $source;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="remote_addr", type="string", length=250, options={"default":""}, nullable=false)
	 */
	private $remoteAddr = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="hash", type="string", length=250, nullable=true)
	 */
	private $hash;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="is_public", type="boolean", options={"default":0}, nullable=false)
	 */
	private $isPublic = 0;

	/**
	 * @var \DateTime
	 *
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(name="dt_new", type="datetime")
	 */
	private $creationTime;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="dt_del", type="datetime", nullable=true)
	 */
	private $deletionTime;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="dt_exp", type="datetime", nullable=true)
	 */
	private $dtExp;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="dt_gruen", type="datetime", nullable=true)
	 */
	private $dtGruen;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="dt_backup", type="datetime", nullable=true)
	 */
	private $dtBackup;

	/**
	 * @ORM\OneToOne(targetEntity="WMDE\Fundraising\Entities\DonationPayment", cascade={"all"}, fetch="EAGER")
	 */
	private $payment;

	/**
	 * @param string $donorFullName
	 *
	 * @return self
	 */
	public function setDonorFullName( $donorFullName ) {
		$this->donorFullName = $donorFullName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDonorFullName() {
		return $this->donorFullName;
	}

	/**
	 * @param string $donorCity
	 *
	 * @return self
	 */
	public function setDonorCity( $donorCity ) {
		$this->donorCity = $donorCity;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDonorCity() {
		return $this->donorCity;
	}

	/**
	 * @param string $donorEmail
	 *
	 * @return self
	 */
	public function setDonorEmail( $donorEmail ) {
		$this->donorEmail = $donorEmail;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDonorEmail() {
		return $this->donorEmail;
	}

	/**
	 * @param boolean $donorOptsIntoNewsletter
	 *
	 * @return self
	 */
	public function setDonorOptsIntoNewsletter( $donorOptsIntoNewsletter ) {
		$this->donorOptsIntoNewsletter = $donorOptsIntoNewsletter;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function getDonorOptsIntoNewsletter() {
		return $this->donorOptsIntoNewsletter;
	}

	/**
	 * Set donation receipt state
	 *
	 * @param boolean $donationReceipt
	 * @return self
	 */
	public function setDonationReceipt( $donationReceipt ) {
		$this->donationReceipt = $donationReceipt;

		return $this;
	}

	/**
	 * Get donation receipt state
	 *
	 * @return boolean
	 */
	public function getDonationReceipt() {
		return $this->donationReceipt;
	}

	/**
	 * Set publicly displayed donation record
	 *
	 * @param string $publicRecord
	 * @return self
	 */
	public function setPublicRecord( $publicRecord ) {
		$this->publicRecord = $publicRecord;

		return $this;
	}

	/**
	 * Get publicly displayed donation record
	 *
	 * @return string
	 */
	public function getPublicRecord() {
		return $this->publicRecord;
	}

	/**
	 * @param string $amount
	 * @return self
	 */
	public function setAmount( $amount ) {
		$this->amount = $amount;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * @param integer $paymentIntervalInMonths
	 *
	 * @return self
	 */
	public function setPaymentIntervalInMonths( $paymentIntervalInMonths ) {
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
	 * Set payment type short code
	 *
	 * @param string $paymentType
	 * @return self
	 */
	public function setPaymentType( $paymentType ) {
		$this->paymentType = $paymentType;

		return $this;
	}

	/**
	 * Get payment type short code
	 *
	 * @return string
	 */
	public function getPaymentType() {
		return $this->paymentType;
	}

	/**
	 * @param string $comment
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
	 * Set bank transfer reference code
	 *
	 * @param string $bankTransferCode
	 *
	 * @return self
	 */
	public function setBankTransferCode( $bankTransferCode ) {
		$this->bankTransferCode = $bankTransferCode;

		return $this;
	}

	/**
	 * Get bank transfer reference code
	 *
	 * @return string
	 */
	public function getBankTransferCode() {
		return $this->bankTransferCode;
	}

	/**
	 * @param string $source
	 * @return self
	 */
	public function setSource( $source ) {
		$this->source = $source;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSource() {
		return $this->source;
	}

	/**
	 * @param string $remoteAddr
	 * @return self
	 */
	public function setRemoteAddr( $remoteAddr ) {
		$this->remoteAddr = $remoteAddr;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getRemoteAddr() {
		return $this->remoteAddr;
	}

	/**
	 * @param string $hash
	 * @return self
	 */
	public function setHash( $hash ) {
		$this->hash = $hash;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getHash() {
		return $this->hash;
	}

	/**
	 * Sets if the donations comment should be public or private.
	 * @param boolean $isPublic
	 * @return self
	 */
	public function setIsPublic( $isPublic ) {
		$this->isPublic = $isPublic;

		return $this;
	}

	/**
	 * Gets if the donations comment is public or private.
	 * @return boolean
	 */
	public function getIsPublic() {
		return $this->isPublic;
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
	 * @param \DateTime|null $deletionTime
	 *
	 * @return self
	 */
	public function setDeletionTime( $deletionTime ) {
		$this->deletionTime = $deletionTime;

		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getDeletionTime() {
		return $this->deletionTime;
	}

	/**
	 * @param \DateTime $dtExp
	 * @return self
	 */
	public function setDtExp( $dtExp ) {
		$this->dtExp = $dtExp;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getDtExp() {
		return $this->dtExp;
	}

	/**
	 * @param string $status
	 * @return self
	 */
	public function setStatus( $status ) {
		$this->status = $status;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param \DateTime $dtGruen
	 * @return self
	 */
	public function setDtGruen( $dtGruen ) {
		$this->dtGruen = $dtGruen;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getDtGruen() {
		return $this->dtGruen;
	}

	/**
	 * @param \DateTime $dtBackup
	 * @return self
	 */
	public function setDtBackup( $dtBackup ) {
		$this->dtBackup = $dtBackup;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getDtBackup() {
		return $this->dtBackup;
	}

	/**
	 * @return integer|null
	 */
	public function getId() {
		return $this->id;
	}

	public function getPayment(): ?DonationPayment {
		return $this->payment;
	}

	public function setPayment( DonationPayment $payment ) {
		$this->payment = $payment;
	}


	/**
	 * @since 2.0
	 *
	 * @param integer|null $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	public function getUExpiry() {
		return $this->getDecodedData()['uexpiry'];
	}

	public function uTokenIsExpired() {
		return time() > strtotime( $this->getUExpiry() );
	}

	public function validateToken( $tokenToCheck, $serverSecret ) {
		$checkToken = preg_replace( '/\$.*$/', '', $tokenToCheck );

		$checkToken = $checkToken . '$' .
			sha1( sha1( "$checkToken+$serverSecret" ) . '|' .
				sha1( "{$this->id}+$serverSecret" ) . '|' .
				sha1( "{$this->creationTime->format( 'Y-m-d H:i:s' )}+$serverSecret" ) );
		return $checkToken === $tokenToCheck;
	}

	public function getEntryType( $mode = null ) {
		$data = $this->getDecodedData();

		if ( $mode === null ) {
			$mode = $this->publicRecord;
			if ( !is_int( $mode ) ) {
				return $this->publicRecord;
			}
		}

		if ( $mode == 1 || $mode == 2 ) {
			$eintrag = $this->donorFullName;
		} else {
			$eintrag = 'anonym';
		}

		if ( ( $mode == 1 || $mode == 3 ) && !empty( $data['ort'] ) ) {
			$eintrag .= ', ' . $data['ort'];
		}

		return $eintrag;
	}

	/**
	 * @deprecated since 2.0, use encodeAndSetData or setDataObject instead
	 *
	 * @param string $data Base 64 encoded, serialized PHP array
	 * @return self
	 */
	public function setData( $data ) {
		$this->data = $data;

		return $this;
	}

	/**
	 * @deprecated since 2.0, use @see getDecodedData or @see getDataObject instead
	 *
	 * @return string Base 64 encoded, serialized PHP array
	 */
	public function getData() {
		return $this->data;
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
	 * @param array $data
	 */
	public function encodeAndSetData( array $data ) {
		$this->data = base64_encode( serialize( $data ) );
	}

	/**
	 * WARNING: updates made to the return value will not be reflected in the Donation state.
	 * Similarly, updates to the Donation state will not propagate to the returned object.
	 * To update the Donation state, explicitly call @see setDataObject.
	 *
	 * @since 2.0
	 * @return DonationData
	 */
	public function getDataObject() {
		$dataArray = $this->getDecodedData();

		$data = new DonationData();

		$data->setAccessToken( array_key_exists( 'token', $dataArray ) ? $dataArray['token'] : null );
		$data->setUpdateToken( array_key_exists( 'utoken', $dataArray ) ? $dataArray['utoken'] : null );
		$data->setUpdateTokenExpiry( array_key_exists( 'uexpiry', $dataArray ) ? $dataArray['uexpiry'] : null );

		return $data;
	}

	/**
	 * @since 2.0
	 * @param DonationData $data
	 */
	public function setDataObject( DonationData $data ) {
		$dataArray = array_merge(
			$this->getDecodedData(),
			[
				'token' => $data->getAccessToken(),
				'utoken' => $data->getUpdateToken(),
				'uexpiry' => $data->getUpdateTokenExpiry(),
			]
		);

		foreach ( [ 'token', 'utoken', 'uexpiry' ] as $keyName ) {
			if ( is_null( $dataArray[$keyName] ) ) {
				unset( $dataArray[$keyName] );
			}
		}

		$this->encodeAndSetData( $dataArray );
	}

	/**
	 * @since 2.0
	 * @param callable $modificationFunction Takes a modifiable DonationData parameter
	 */
	public function modifyDataObject( callable $modificationFunction ) {
		$dataObject = $this->getDataObject();
		$modificationFunction( $dataObject );
		$this->setDataObject( $dataObject );
	}

}

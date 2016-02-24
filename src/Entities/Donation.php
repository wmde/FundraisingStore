<?php

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @since 2.0
 *
 * @ORM\Table(name="spenden", indexes={@ORM\Index(name="email", columns={"email"}), @ORM\Index(name="name", columns={"name"}), @ORM\Index(name="ort", columns={"ort"}), @ORM\Index(name="dt_new", columns={"dt_new", "is_public"}), @ORM\Index(name="dt_exp", columns={"dt_exp", "dt_del"}), @ORM\Index(name="zahlweise", columns={"zahlweise", "dt_new"}), @ORM\Index(name="dt_gruen", columns={"dt_gruen", "dt_del"}), @ORM\Index(name="ueb_code", columns={"ueb_code"}), @ORM\Index(name="dt_backup", columns={"dt_backup"}), @ORM\Index(name="status", columns={"status", "dt_new"}), @ORM\Index(name="comment_list", columns={"is_public", "dt_del"})})
 * @ORM\Entity
 */
class Donation {
	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=250, nullable=true)
	 */
	private $name;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="ort", type="string", length=250, nullable=true)
	 */
	private $city;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=250, nullable=true)
	 */
	private $email;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="info", type="boolean", options={"default":0}, nullable=false)
	 */
	private $info = 0;

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
	private $period = 0;

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
	private $transferCode = '';

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
	private $dtNew;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="dt_del", type="datetime", nullable=true)
	 */
	private $dtDel;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="dt_exp", type="datetime", nullable=true)
	 */
	private $dtExp;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="status", type="string", length=1, options={"default":"N", "fixed":true}, nullable=false)
	 */
	private $status = 'N';

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
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;


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
	 * Set info
	 *
	 * @param boolean $info
	 * @return self
	 */
	public function setInfo( $info ) {
		$this->info = $info;

		return $this;
	}

	/**
	 * Get info
	 *
	 * @return boolean
	 */
	public function getInfo() {
		return $this->info;
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
	 * Set amount
	 *
	 * @param string $amount
	 * @return self
	 */
	public function setAmount( $amount ) {
		$this->amount = $amount;

		return $this;
	}

	/**
	 * Get amount
	 *
	 * @return string
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * Set period
	 *
	 * @param integer $period
	 * @return self
	 */
	public function setPeriod( $period ) {
		$this->period = $period;

		return $this;
	}

	/**
	 * Get period
	 *
	 * @return integer
	 */
	public function getPeriod() {
		return $this->period;
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
	 * Set bank transfer reference code
	 *
	 * @param string $transferCode
	 * @return self
	 */
	public function setTransferCode( $transferCode ) {
		$this->transferCode = $transferCode;

		return $this;
	}

	/**
	 * Get bank transfer reference code
	 *
	 * @return string
	 */
	public function getTransferCode() {
		return $this->transferCode;
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
	 * Set source
	 *
	 * @param string $source
	 * @return self
	 */
	public function setSource( $source ) {
		$this->source = $source;

		return $this;
	}

	/**
	 * Get source
	 *
	 * @return string
	 */
	public function getSource() {
		return $this->source;
	}

	/**
	 * Set remoteAddr
	 *
	 * @param string $remoteAddr
	 * @return self
	 */
	public function setRemoteAddr( $remoteAddr ) {
		$this->remoteAddr = $remoteAddr;

		return $this;
	}

	/**
	 * Get remoteAddr
	 *
	 * @return string
	 */
	public function getRemoteAddr() {
		return $this->remoteAddr;
	}

	/**
	 * Set hash
	 *
	 * @param string $hash
	 * @return self
	 */
	public function setHash( $hash ) {
		$this->hash = $hash;

		return $this;
	}

	/**
	 * Get hash
	 *
	 * @return string
	 */
	public function getHash() {
		return $this->hash;
	}

	/**
	 * Set isPublic
	 *
	 * @param boolean $isPublic
	 * @return self
	 */
	public function setIsPublic( $isPublic ) {
		$this->isPublic = $isPublic;

		return $this;
	}

	/**
	 * Get isPublic
	 *
	 * @return boolean
	 */
	public function getIsPublic() {
		return $this->isPublic;
	}

	/**
	 * Set dtNew
	 *
	 * @param \DateTime $dtNew
	 * @return self
	 */
	public function setDtNew( $dtNew ) {
		$this->dtNew = $dtNew;

		return $this;
	}

	/**
	 * Get dtNew
	 *
	 * @return \DateTime
	 */
	public function getDtNew() {
		return $this->dtNew;
	}

	/**
	 * Set dtDel
	 *
	 * @param \DateTime|null $dtDel
	 * @return self
	 */
	public function setDtDel( $dtDel ) {
		$this->dtDel = $dtDel;

		return $this;
	}

	/**
	 * Get dtDel
	 *
	 * @return \DateTime|null
	 */
	public function getDtDel() {
		return $this->dtDel;
	}

	/**
	 * Set dtExp
	 *
	 * @param \DateTime $dtExp
	 * @return self
	 */
	public function setDtExp( $dtExp ) {
		$this->dtExp = $dtExp;

		return $this;
	}

	/**
	 * Get dtExp
	 *
	 * @return \DateTime
	 */
	public function getDtExp() {
		return $this->dtExp;
	}

	/**
	 * Set status
	 *
	 * @param string $status
	 * @return self
	 */
	public function setStatus( $status ) {
		$this->status = $status;

		return $this;
	}

	/**
	 * Get status
	 *
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Set dtGruen
	 *
	 * @param \DateTime $dtGruen
	 * @return self
	 */
	public function setDtGruen( $dtGruen ) {
		$this->dtGruen = $dtGruen;

		return $this;
	}

	/**
	 * Get dtGruen
	 *
	 * @return \DateTime
	 */
	public function getDtGruen() {
		return $this->dtGruen;
	}

	/**
	 * Set dtBackup
	 *
	 * @param \DateTime $dtBackup
	 * @return self
	 */
	public function setDtBackup( $dtBackup ) {
		$this->dtBackup = $dtBackup;

		return $this;
	}

	/**
	 * Get dtBackup
	 *
	 * @return \DateTime
	 */
	public function getDtBackup() {
		return $this->dtBackup;
	}

	/**
	 * Get id
	 *
	 * @return integer|null
	 */
	public function getId() {
		return $this->id;
	}

	public function getUExpiry() {
		$data = $this->decodeData( $this->data );

		return $data[ 'uexpiry' ];
	}

	public function uTokenIsExpired() {
		$uexp_time = strtotime( $this->getUExpiry() );
		return time() > $uexp_time;
	}

	public function validateToken( $tokenToCheck, $serverSecret ) {
		$checkToken = preg_replace( '/\$.*$/', '', $tokenToCheck );

		$checkToken = $checkToken . '$' .
			sha1( sha1( "$checkToken+$serverSecret" ) . '|' .
				sha1( "{$this->id}+$serverSecret" ) . '|' .
				sha1( "{$this->dtNew->format( 'Y-m-d H:i:s' )}+$serverSecret" ) );
		return $checkToken === $tokenToCheck;
	}

	public function getEntryType( $mode = null ) {
		$data = $this->decodeData( $this->data );

		if ( $mode === null ) {
			$mode = $this->publicRecord;
			if ( !is_int( $mode ) ) {
				return $this->publicRecord;
			}
		}

		if ( $mode == 1 || $mode == 2 ) {
			$eintrag = $this->name;
		} else {
			$eintrag = "anonym";
		}

		if ( ( $mode == 1 || $mode == 3 ) && !empty( $data[ "ort" ] ) ) {
			$eintrag .= ", " . $data[ "ort" ];
		}

		return $eintrag;
	}

	private function decodeData( $data ) {
		return unserialize( base64_decode( $data ) );
	}
}

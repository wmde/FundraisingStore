<?php

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Spenden
 *
 * @ORM\Table(name="spenden", indexes={@ORM\Index(name="email", columns={"email"}), @ORM\Index(name="name", columns={"name"}), @ORM\Index(name="ort", columns={"ort"}), @ORM\Index(name="dt_new", columns={"dt_new", "is_public"}), @ORM\Index(name="dt_exp", columns={"dt_exp", "dt_del"}), @ORM\Index(name="zahlweise", columns={"zahlweise", "dt_new"}), @ORM\Index(name="dt_gruen", columns={"dt_gruen", "dt_del"}), @ORM\Index(name="ueb_code", columns={"ueb_code"}), @ORM\Index(name="dt_backup", columns={"dt_backup"}), @ORM\Index(name="status", columns={"status", "dt_new"}), @ORM\Index(name="comment_list", columns={"is_public", "dt_del"})})
 * @ORM\Entity
 */
class Spenden {
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
	private $ort;

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
	private $bescheinigung;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="eintrag", type="string", length=250, options={"default":""}, nullable=false)
	 */
	private $eintrag = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="betrag", type="string", length=250, nullable=true)
	 */
	private $betrag;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="periode", type="smallint", options={"default":0}, nullable=false)
	 */
	private $periode = 0;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="zahlweise", type="string", length=3, options={"default":"BEZ", "fixed":true}, nullable=false)
	 */
	private $zahlweise = 'BEZ';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="kommentar", type="text", options={"default":""}, nullable=false)
	 */
	private $kommentar = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="ueb_code", type="string", length=32, options={"default":""}, nullable=false)
	 */
	private $uebCode = '';

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
	 * @ORM\Column(name="dt_new", type="datetime", nullable=true)
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
	 * @return Spenden
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
	 * Set ort
	 *
	 * @param string $ort
	 * @return Spenden
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
	 * @return Spenden
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
	 * @return Spenden
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
	 * Set bescheinigung
	 *
	 * @param boolean $bescheinigung
	 * @return Spenden
	 */
	public function setBescheinigung( $bescheinigung ) {
		$this->bescheinigung = $bescheinigung;

		return $this;
	}

	/**
	 * Get bescheinigung
	 *
	 * @return boolean
	 */
	public function getBescheinigung() {
		return $this->bescheinigung;
	}

	/**
	 * Set eintrag
	 *
	 * @param string $eintrag
	 * @return Spenden
	 */
	public function setEintrag( $eintrag ) {
		$this->eintrag = $eintrag;

		return $this;
	}

	/**
	 * Get eintrag
	 *
	 * @return string
	 */
	public function getEintrag() {
		return $this->eintrag;
	}

	/**
	 * Set betrag
	 *
	 * @param string $betrag
	 * @return Spenden
	 */
	public function setBetrag( $betrag ) {
		$this->betrag = $betrag;

		return $this;
	}

	/**
	 * Get betrag
	 *
	 * @return string
	 */
	public function getBetrag() {
		return $this->betrag;
	}

	/**
	 * Set periode
	 *
	 * @param integer $periode
	 * @return Spenden
	 */
	public function setPeriode( $periode ) {
		$this->periode = $periode;

		return $this;
	}

	/**
	 * Get periode
	 *
	 * @return integer
	 */
	public function getPeriode() {
		return $this->periode;
	}

	/**
	 * Set zahlweise
	 *
	 * @param string $zahlweise
	 * @return Spenden
	 */
	public function setZahlweise( $zahlweise ) {
		$this->zahlweise = $zahlweise;

		return $this;
	}

	/**
	 * Get zahlweise
	 *
	 * @return string
	 */
	public function getZahlweise() {
		return $this->zahlweise;
	}

	/**
	 * Set kommentar
	 *
	 * @param string $kommentar
	 * @return Spenden
	 */
	public function setKommentar( $kommentar ) {
		$this->kommentar = $kommentar;

		return $this;
	}

	/**
	 * Get kommentar
	 *
	 * @return string
	 */
	public function getKommentar() {
		return $this->kommentar;
	}

	/**
	 * Set uebCode
	 *
	 * @param string $uebCode
	 * @return Spenden
	 */
	public function setUebCode( $uebCode ) {
		$this->uebCode = $uebCode;

		return $this;
	}

	/**
	 * Get uebCode
	 *
	 * @return string
	 */
	public function getUebCode() {
		return $this->uebCode;
	}

	/**
	 * Set data
	 *
	 * @param string $data
	 * @return Spenden
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
	 * @return Spenden
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
	 * @return Spenden
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
	 * @return Spenden
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
	 * @return Spenden
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
	 * @return Spenden
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
	 * @param \DateTime $dtDel
	 * @return Spenden
	 */
	public function setDtDel( $dtDel ) {
		$this->dtDel = $dtDel;

		return $this;
	}

	/**
	 * Get dtDel
	 *
	 * @return \DateTime
	 */
	public function getDtDel() {
		return $this->dtDel;
	}

	/**
	 * Set dtExp
	 *
	 * @param \DateTime $dtExp
	 * @return Spenden
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
	 * @return Spenden
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
	 * @return Spenden
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
	 * @return Spenden
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
	 * @return integer
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
			$mode = $this->eintrag;
			if ( !is_int( $mode ) ) {
				return $this->eintrag;
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

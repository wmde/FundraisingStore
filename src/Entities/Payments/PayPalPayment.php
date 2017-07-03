<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Entities\Payments;

use Doctrine\ORM\Mapping as ORM;

/**
 * @since 6.0
 *
 * @ORM\Table(name="payment_paypal")
 * @ORM\Entity
 */
class PayPalPayment {

	/**
	 * @var string
	 * Example value: 61E67681CH3238416
	 * Data blob field: ext_payment_id
	 *
	 * @ORM\Column(name="transaction_id", type="string", length=25?, nullable=false, unique=true)
	 */
	private $transactionId = '';

	/**
	 * @var string
	 * Example value: instant
	 * Data blob field: ext_payment_type
	 *
	 * @ORM\Column(name="type", type="string", length=??, nullable=false)
	 */
	private $type = '';

	/**
	 * @var string
	 * Example value: Completed
	 * Data blob field: ext_payment_status
	 *
	 * @ORM\Column(name="status", type="string", length=??, nullable=false)
	 */
	private $status = '';

	/**
	 * @var string
	 * Example value: LPLWNMTBWMFAY
	 * Data blob field: ext_payment_account
	 *
	 * @ORM\Column(name="payer_id", type="string", length=??, nullable=false)
	 */
	private $payerId;

	/**
	 * @var string
	 * Example value: 8RHHUM3W3PRH7QY6B59
	 * Data blob field: ext_subscr_id AND paypal_subscr_id
	 *
	 * @ORM\Column(name="subscriber_id", type="string", length=??, nullable=false)
	 */
	private $subscriberId;

	/**
	 * @var string
	 * Example value: verified
	 * Data blob field: paypal_payer_status
	 *
	 * @ORM\Column(name="payer_status", type="string", length=??, nullable=false)
	 */
	private $payerStatus;

	/**
	 * @var string
	 * Example value: confirmed
	 * Data blob field: paypal_address_status
	 *
	 * @ORM\Column(name="payer_status", type="string", length=??, nullable=false)
	 */
	private $addressStatus;

	/**
	 * @var string
	 * Example value: Bossbraham
	 * Data blob field: paypal_first_name
	 *
	 * @ORM\Column(name="first_name", type="string", length=??, nullable=false)
	 */
	private $firstName;

	/**
	 * @var string
	 * Example value: The Wise
	 * Data blob field: paypal_last_name
	 *
	 * @ORM\Column(name="last_name", type="string", length=??, nullable=false)
	 */
	private $lastName;

	/**
	 * @var string
	 * Example value: Bossbraham The Wise
	 * Data blob field: paypal_address_name
	 *
	 * @ORM\Column(name="address_name", type="string", length=??, nullable=false)
	 */
	private $addressName;

	/**
	 * @var string
	 * Example value: 1.23
	 * Data blob field: paypal_mc_gross
	 *
	 * @ORM\Column(name="gross_amount", type="string", length=??, nullable=false)
	 */
	private $amount;

	/**
	 * @var string
	 * Example value: EUR
	 * Data blob field: paypal_mc_currency
	 *
	 * @ORM\Column(name="currency_code", type="string", length=??, nullable=false)
	 */
	private $currencyCode;

	/**
	 * @var string
	 * Example value: 0.23
	 * Data blob field: paypal_mc_fee
	 *
	 * @ORM\Column(name="fee", type="string", length=??, nullable=false)
	 */
	private $fee;

	/**
	 * @var string
	 * Example value: 2.34
	 * Data blob field: paypal_settle_amount
	 *
	 * @ORM\Column(name="settle_amount", type="string", length=??, nullable=false)
	 */
	private $settleAmount;

	/**
	 * @var \DateTime
	 * Example value: comes into the system as "20:12:59 Jan 13, 2009 PST"
	 * Data blob field: ext_payment_timestamp
	 *
	 * @ORM\Column(name="payment_timestamp", type="datetime", length=??, nullable=??)
	 */
	private $paymentTimestamp = '';

	// Do we need this one?
	private $firstPaymentDate = '';

}

# Persistence Services for WMDE Fundraising

[![Build Status](https://secure.travis-ci.org/wmde/FundraisingStore.png?branch=master)](http://travis-ci.org/wmde/FundraisingStore)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/wmde/FundraisingStore/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/wmde/FundraisingStore/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/wmde/FundraisingStore/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/wmde/FundraisingStore/?branch=master)
[![Dependency Status](https://www.versioneye.com/php/wmde:fundraising-store/dev-master/badge.svg)](https://www.versioneye.com/php/wmde:fundraising-store/dev-master)
[![Download count](https://poser.pugx.org/wmde/fundraising-store/d/total.png)](https://packagist.org/packages/wmde/fundraising-store)
[![License](https://poser.pugx.org/wmde/fundraising-store/license.svg)](https://packagist.org/packages/wmde/fundraising-store)

[![Latest Stable Version](https://poser.pugx.org/wmde/fundraising-store/version.png)](https://packagist.org/packages/wmde/fundraising-store)
[![Latest Unstable Version](https://poser.pugx.org/wmde/fundraising-store/v/unstable.svg)](//packagist.org/packages/wmde/fundraising-store)

**Fundraising Store** contains persistence services for the WMDE fundraising codebase.

## Installation

You can use [Composer](http://getcomposer.org/) to download and install
this package as well as its dependencies.

To add this package as a local, per-project dependency to your project, run:

    composer require wmde/fundraising-store

This package provides `vendor/bin/cli-config.php` file required by the Doctrine Console.
A default database configuration, compatible with the container used for integration tests (see `docker-compose.yml`),
can be found in `local-db-config.php`. 
Applications wanting to use this package in conjunction with the Doctrine Console should provide their own `cli-config.php`.

## Development

In order to create a level playing field for development this project uses
<a href="https://docs.docker.com/engine/installation/">docker</a> &
<a href="https://docs.docker.com/compose/install/">docker-compose</a>,
as well as <a href="https://getcomposer.org/">composer</a> for dependency management.

### Provision the system

    docker-compose build

### Install dependencies

    docker run -it --rm --user $(id -u):$(id -g) -v "$PWD":/code -v ~/.composer:/composer -w /code composer composer install

### Tests

    docker-compose run --rm app vendor/bin/phpunit

### Running test and code-style checks with composer
All committed code is checked by our CI against the unit tests and the coding styleguide. 
The configuration for these tools can be found in the root directory. 
After installation through composer you can either call the tools directly from their location in `vendor/bin` 
or use the provided `composer` tasks:

	composer ci   # Run all checks
	composer cs   # Run style checks
	composer test # Run unit tests

Be aware that the concepts of composer as a script runner and containerization might not work together out-of-the-box.

## Release notes

### Version 9.0.0 (2018-08-16)

* Remove `User`, `ActionLog`, `BackendBanner`, `BackendImpression` doctrine entity and move them to `fundraising-backend` repository

### Version 8.0.0 (2018-06-06)

* Add `AddressChange` entity for address export functionality

### Version 7.0.1 (2017-12-05)

* Changed default timestamp value from "0" to "current time", prevening errors on newer versions of MySQL

### Version 7.0.0 (2017-11-01)

* Introduced `MembershipApplication::setDonationReceipt()` et al.

### Version 6.1.0 (2017-08-16)

* Introduced constant `Donation::STATUS_EXPORTED` for historical reasons.

### Version 6.0.1 (2017-08-02)

* Updated Doctrine DBAL and ORM min version.

### Version 6.0.0 (2017-07-18)

* Added `DonationPayments\SofortPayment` entity

### Version 5.0.0 (2017-03-30)

#### Breaking changes

* Added full text indices for donations and memberships. This breaks backward compatibility for MySQL versions < 5.6.
* Prefixed all indices of donations with `d_`.
* Mark `donation_id` of `MembershipApplication` as deprecated. It's no longer written by the fundraising frontend, but 
  still referenced in some places by the backend, so for now we just mark it as deprecated instead of removing it.

### Version 4.2.0 (2017-01-04)

* Added `MembershipApplication::isDeleted()`

### Version 4.1.0 (2016-12-06)

* Add parameter for setting proxy dir to Factory. For backwards compatibility it's optional and defaults to `/tmp`.

### Version 4.0.0 (2016-11-25)

#### Breaking changes

* The subscription confirmation code is now a plain string instead of a binary (blob). This makes it easier to read and test. 

### Version 3.0.0 (2016-11-16)

#### Breaking changes

* The Subscription status flags have been removed and usage of setStatus and getStatus is now discouraged
* Changed the minimum PHP version to 7.0

#### New features

* Added `source` field to `subscription` table. This field indicates what led to the subscription,
  for instance the "remind me later" feature.
* Added `Subscription::getSource` and `Subscription::setSource`
* Added `Subscription::markAsConfirmed`
* Added `Subscription::markForModeration`
* Added `Subscription::needsModeration`

#### Bug fixes

* `Subscription::isUnconfirmed` now correctly returns true when a subscription has been marked for moderation

### Version 2.1.0 (2016-10-10)

* Schema change: Added `payment_type` field column to the `request` table
* Added `MembershipApplication::setPaymentType` and `MembershipApplication::getPaymentType`
* Ability ro re-ruse the file `cli-config.php` when including `FundraisingStore` in an application is removed.

### Version 2.0.1 (2016-09-28)

By the rules of semantic versioning, this version should have been 2.1 but was tagged wrongly.

* Added `MembershipApplicationData::setPreservedStatus` and `MembershipApplicationData::getPreservedStatus`. 
  This is used to store the previous status when the status changes from a positive to a negative value.

### Version 2.0.0 (2016-08-03)

#### Breaking changes

* Renamed several entities. Database table names where not changed to remain backwards compatible.
	* `Spenden` => `Donation`.
	* `Users` => `User`
	* `BackendImpressions` => `BackendImpression`
	* `Request` was split into `MembershipApplication` and `Subscription` (the type field was removed)
* The public PHP interfaces of `Donation` and `MembershipApplication` were changed to English.
* Creation timestamps are now added automatically to donations, membership requests and subscriptions. Donation creation 
  timestamp `dt_new` is now mandatory (not nullable).
* The `guid` field of `MembershipApplication` was removed.
* Changed the minimum PHP version to 5.6

#### New features

* Added `Address` entity
* Added `DonationData` class to provide nicer access to the data field
* Added new methods to `Donation`
	* `setId`
	* `getDecodedData`
	* `encodeAndSetData`
	* `getDataObject`
	* `setDataObject`
	* `modifyDataObject`
* Added `MembershipApplicationData` class to provide nicer access to the data field
* Added new methods to `MembershipApplication`
	* `setId`
	* `getDecodedData`
	* `encodeAndSetData`
	* `getDataObject`
	* `setDataObject`
	* `modifyDataObject`

### Version 1.0 (2016-01-11)

* Added CLI configuration for Doctrine ORM shell commands
* Added request type and status constants
* Automatically set the full name in Request when first or last name is set.
* Changed the minimum PHP version to 5.5

### Version 0.1 (2015-07-10)

Initial release with `Store\Factory`, `Store\Installer` and these entities:

* ActionLog
* BackendBanner
* BackendImpressions
* Request
* Spenden
* Users

## Future Plans
* Migrate the payment metadata from `Donation::data` to specific subclasses of the `DonationPayment` abstract class. 

## Links

* [Fundraising Store on Packagist](https://packagist.org/packages/wmde/fundraising-store)
* [Fundraising Store on TravisCI](https://travis-ci.org/wmde/FundraisingStore)
* [Fundraising Store on ScrutinizerCI](https://scrutinizer-ci.com/g/wmde/FundraisingStore)

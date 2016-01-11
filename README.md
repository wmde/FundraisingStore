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

To add this package as a local, per-project dependency to your project, simply add a
dependency on `wmde/fundraising-store` to your project's `composer.json` file.
Here is a minimal example of a `composer.json` file that just defines a dependency on
Fundraising Store 1.x:

```js
{
    "require": {
        "wmde/fundraising-store": "^1.0.0"
    }
}
```

This package provides `vendor/bin/cli-config.php` file required by the Doctrine Console. In order to use it,
database credentials must be provided in `vendor/bin/config.ini`. Rename or copy `vendor/bin/config.ini.template`
and fill in actual credentials.

## Tests

This library comes with a set up PHPUnit tests that cover all non-trivial code. Additionally, code
style checks by PHPCS and PHPMD are supported. The configuration for all 3 these tools can be found
in the root directory. You can use the tools in their standard manner, though can run all checks
required by our CI by executing `composer ci`. To just run tests use `composer test`, and to just
run style checks use `composer cs`.

## Release notes

### Version 1.1 (2016-01-11)

* Automatically set the full name in Request when first or last name is set.

### Version 1.0 (2015-08-21)

* Added CLI configuration for Doctrine ORM shell commands

### Version 0.1 (2015-07-10)

Initial release with `Store\Factory`, `Store\Installer` and these entities:

* ActionLog
* BackendBanner
* BackendImpressions
* Request
* Spenden
* Users

## Links

* [Fundraising Store on Packagist](https://packagist.org/packages/wmde/fundraising-store)
* [Fundraising Store on TravisCI](https://travis-ci.org/wmde/FundraisingStore)
* [Fundraising Store on ScrutinizerCI](https://scrutinizer-ci.com/g/wmde/FundraisingStore)

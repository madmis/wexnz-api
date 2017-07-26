# Btc-e.com REST API PHP Client

[![SensioLabsInsight][sensiolabs-insight-image]][sensiolabs-insight-link]
[![Build Status][testing-image]][testing-link]
[![Coverage Status][coverage-image]][coverage-link]
[![Latest Stable Version][stable-image]][package-link]
[![Total Downloads][downloads-image]][package-link]
[![License][license-image]][license-link]

[Btc-e.com](https://btc-e.com) provides REST APIs that you can use
 to interact with platform programmatically.

This API client will help you interact with Btc-e by REST API. 
 

## License

MIT License

## Btc-e REST API Reference

Public API - https://btc-e.com/api/3/docs
Trade API - https://btc-e.com/tapi/docs
Push API - https://btc-e.com/pushAPI/docs


## Contributing
To create new endpoint - [create issue](https://github.com/madmis/btce-api/issues/new) 
or [create pull request](https://github.com/madmis/btce-api/compare)


## Install
    
    composer require madmis/btce-api 1.0.*


## Usage


### Mapping


### Error handling


## Running the tests
To run the tests, you'll need to install [phpunit](https://phpunit.de/). 
Easiest way to do this is through composer.

    composer install

Tests required running php built in server on 8000 port.

    php -S localhost:8000

### Running Unit tests

    php vendor/bin/phpunit -c phpunit.xml.dist


[testing-link]: https://travis-ci.org/madmis/btce-api
[testing-image]: https://travis-ci.org/madmis/btce-api.svg?branch=master

[sensiolabs-insight-link]: https://insight.sensiolabs.com/projects/77152883-412e-4a91-86b6-fb976243a020
[sensiolabs-insight-image]: https://insight.sensiolabs.com/projects/77152883-412e-4a91-86b6-fb976243a020/mini.png

[package-link]: https://packagist.org/packages/madmis/btce-api
[downloads-image]: https://poser.pugx.org/madmis/btce-api/downloads
[stable-image]: https://poser.pugx.org/madmis/btce-api/v/stable
[license-image]: https://poser.pugx.org/madmis/btce-api/license
[license-link]: https://packagist.org/packages/madmis/btce-api

[coverage-link]: https://coveralls.io/github/madmis/btce-api?branch=master
[coverage-image]: https://coveralls.io/repos/github/madmis/btce-api/badge.svg?branch=master


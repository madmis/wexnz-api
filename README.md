# Wex.nz REST API PHP Client

[![SensioLabsInsight][sensiolabs-insight-image]][sensiolabs-insight-link]
[![Build Status][testing-image]][testing-link]
[![Coverage Status][coverage-image]][coverage-link]
[![Latest Stable Version][stable-image]][package-link]
[![Total Downloads][downloads-image]][package-link]
[![License][license-image]][license-link]

[Wex.nz](https://wex.nz) provides REST APIs that you can use
 to interact with platform programmatically.

This API client will help you interact with Wex.nz by REST API. 
 

## License

MIT License

## Btc-e REST API Reference

Public API - https://wex.nz/api/3/docs

Trade API - https://wex.nz/tapi/docs

Push API - https://wex.nz/pushAPI/docs


## Contributing
[create issue](https://github.com/madmis/wexnz-api/issues/new) 
or [create pull request](https://github.com/madmis/wexnz-api/compare)


## Install
    
    composer require madmis/wexnz-api 1.0.*


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


[testing-link]: https://travis-ci.org/madmis/wexnz-api
[testing-image]: https://travis-ci.org/madmis/wexnz-api.svg?branch=master

[sensiolabs-insight-link]: https://insight.sensiolabs.com/projects/b9991422-01a6-48ea-abfb-cf53482465e5
[sensiolabs-insight-image]: https://insight.sensiolabs.com/projects/b9991422-01a6-48ea-abfb-cf53482465e5/mini.png

[package-link]: https://packagist.org/packages/madmis/wexnz-api
[downloads-image]: https://poser.pugx.org/madmis/wexnz-api/downloads
[stable-image]: https://poser.pugx.org/madmis/wexnz-api/v/stable
[license-image]: https://poser.pugx.org/madmis/wexnz-api/license
[license-link]: https://packagist.org/packages/madmis/wexnz-api

[coverage-link]: https://coveralls.io/github/madmis/wexnz-api?branch=master
[coverage-image]: https://coveralls.io/repos/github/madmis/wexnz-api/badge.svg?branch=master


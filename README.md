# Attributes Options

<p align="center">
    <a href="https://codecov.io/gh/Attributes-PHP/options"><img src="https://codecov.io/gh/Attributes-PHP/options/graph/badge.svg?token=9W2JHIDQ2V"/></a>
    <a href="https://packagist.org/packages/Attributes-PHP/options"><img alt="Latest Version" src="https://img.shields.io/packagist/v/Attributes-PHP/options"></a>
    <a href="https://packagist.org/packages/Attributes-PHP/options"><img alt="Software License" src="https://img.shields.io/badge/Licence-MIT-brightgreen"></a>
</p>

**Attributes Options** is a collection of Attributes that can be used to enhance the [validation](https://github.com/Attributes-PHP/validation)
and/or [serialization](https://github.com/Attributes-PHP/serializer) stages.

## Supported options

### Class specific options

- *AliasGenerator*, generates an alias per each class property

### Property options

- *Alias*, specifies a given alias for a property
- *Ignore*, skips the validation and/or serialization of a property

## Requirements

- PHP 8.1+

We aim to support versions that haven't reached their end-of-life.

## How it works?

```php
<?php

use Attributes\Validation\Validator;
use Attributes\Options\AliasGenerator;
use Attributes\Options\Alias;
use Attributes\Options\Ignore;
use Attributes\Serializer\ReflectionSerializer;

#[AliasGenerator('snake')]
class Login
{
    public string $userName;

    #[Alias('password'), Ignore(validation: false)]
    public string $myPassword;
}

$rawData = [
    'user_name' => 'user',
    'password'  => '1234',
];

// Validation stage
$validator = new Validator();
$login = $validator->validate($rawData, new Login);

var_dump($login->user);     // string(4) "user
var_dump($login->password); // string(4) "1234"

// Serialization stage
$serializer = new Serializer;
$serializedData = $serializer->serialize($login);

var_dump($serializedData);          // array { ["user_name"] => "user" }
```

## Installation

```bash
composer require attributes-php/options
```

Attributes Options was created by **[André Gil](https://www.linkedin.com/in/andre-gil/)** and is open-sourced software licensed under the **[MIT license](https://opensource.org/licenses/MIT)**.

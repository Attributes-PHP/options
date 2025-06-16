<?php

/**
 * Holds integration tests for Ignore
 *
 * @license MIT
 */

declare(strict_types=1);

namespace Attributes\Options\Tests\Integration;

use Attributes\Options;

test('Ignore', function (bool $validation, bool $serialization) {
    $ignore = new Options\Ignore(validation: $validation, serialization: $serialization);
    expect($ignore->ignoreValidation())
        ->toBe($validation)
        ->and($ignore->ignoreSerialization())
        ->toBe($serialization);
})
    ->with([true, false])
    ->with([true, false])
    ->group('options', 'ignore');

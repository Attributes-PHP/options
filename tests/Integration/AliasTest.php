<?php

/**
 * Holds integration tests for Alias
 *
 * @license MIT
 */

declare(strict_types=1);

namespace Attributes\Options\Tests\Integration;

use Attributes\Options;

test('Alias', function (string $value) {
    $alias = new Options\Alias($value);
    expect($alias->getAlias())
        ->toBeString()
        ->toBe($value);
})
    ->with(['hey', 'Hello World'])
    ->group('options', 'alias');

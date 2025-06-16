<?php

/**
 * Holds integration tests for AliasGenerator
 *
 * @license MIT
 */

declare(strict_types=1);

namespace Attributes\Options\Tests\Integration;

use Attributes\Options;

test('AliasGenerator camelCase', function (string $value, string $expectedAlias) {
    $aliasGenerator = new Options\AliasGenerator('camel');
    $getAlias = $aliasGenerator->getAliasGenerator();

    $alias = $getAlias($value);
    expect($alias)
        ->toBeString()
        ->toBe($expectedAlias);
})
    ->with([
        ['snake_case', 'snakeCase'],
        ['PascalCase', 'pascalCase'],
        ['camelCase', 'camelCase'],
        ['Hello World', 'helloWorld'],
    ])
    ->group('options', 'alias-generator', 'camel');

test('AliasGenerator snake_case', function (string $value, string $expectedAlias) {
    $aliasGenerator = new Options\AliasGenerator('snake');
    $getAlias = $aliasGenerator->getAliasGenerator();

    $alias = $getAlias($value);
    expect($alias)
        ->toBeString()
        ->toBe($expectedAlias);
})
    ->with([
        ['snake_case', 'snake_case'],
        ['PascalCase', 'pascal_case'],
        ['camelCase', 'camel_case'],
        ['Hello World', 'hello_world'],
    ])
    ->group('options', 'alias-generator', 'snake');

test('AliasGenerator PascalCase', function (string $value, string $expectedAlias) {
    $aliasGenerator = new Options\AliasGenerator('pascal');
    $getAlias = $aliasGenerator->getAliasGenerator();

    $alias = $getAlias($value);
    expect($alias)
        ->toBeString()
        ->toBe($expectedAlias);
})
    ->with([
        ['snake_case', 'SnakeCase'],
        ['PascalCase', 'PascalCase'],
        ['camelCase', 'CamelCase'],
        ['Hello World', 'HelloWorld'],
    ])
    ->group('options', 'alias-generator', 'pascal');

test('AliasGenerator custom callable', function (string $value, string $expectedAlias) {
    $aliasGenerator = new Options\AliasGenerator(fn (string $name) => "${name}_suffix");
    $getAlias = $aliasGenerator->getAliasGenerator();

    $alias = $getAlias($value);
    expect($alias)
        ->toBeString()
        ->toBe($expectedAlias);
})
    ->with([
        ['snake_case', 'snake_case_suffix'],
        ['PascalCase', 'PascalCase_suffix'],
        ['camelCase', 'camelCase_suffix'],
        ['Hello World', 'Hello World_suffix'],
    ])
    ->group('options', 'alias-generator', 'custom');

test('AliasGenerator invalid generator', function () {
    $aliasGenerator = new Options\AliasGenerator('invalid-alias');
    $getAlias = $aliasGenerator->getAliasGenerator();
    $getAlias('Hello World');
})
    ->throws(Options\Exceptions\InvalidOptionException::class, 'Invalid alias generator \'invalid-alias\'')
    ->group('options', 'alias-generator', 'custom');

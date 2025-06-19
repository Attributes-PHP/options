<?php

declare(strict_types=1);

namespace Attributes\Options;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class Ignore implements Option
{
    private bool $ignoreValidation;

    private bool $ignoreSerialize;

    public function __construct(bool $validation = true, bool $serialization = true)
    {
        $this->ignoreValidation = $validation;
        $this->ignoreSerialize = $serialization;
    }

    public function ignoreValidation(): bool
    {
        return $this->ignoreValidation;
    }

    public function ignoreSerialization(): bool
    {
        return $this->ignoreSerialize;
    }
}

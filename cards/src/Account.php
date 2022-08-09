<?php

declare(strict_types=1);

namespace App;

use JetBrains\PhpStorm\Internal\TentativeType;

final class Account implements \JsonSerializable
{
    public function __construct(
        public readonly string $id
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
        ];
    }
}
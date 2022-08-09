<?php

declare(strict_types=1);

namespace UUS;

use JetBrains\PhpStorm\Internal\TentativeType;

final class Account implements \JsonSerializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $product
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'product' => $this->product,
        ];
    }
}
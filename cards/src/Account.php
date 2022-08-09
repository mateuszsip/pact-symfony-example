<?php

declare(strict_types=1);

namespace Cards;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use JetBrains\PhpStorm\Internal\TentativeType;

#[Entity]
final class Account implements \JsonSerializable
{
    public function __construct(
        #[Id]
        #[Column]
        public readonly string $id
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
        ];
    }
}
<?php

declare(strict_types=1);

namespace Cards;

use Doctrine\ORM\EntityManagerInterface;

final class AccountRepository
{
    public function __construct(private readonly EntityManagerInterface $em)
    {}

    public function create(Account ...$accounts): void
    {
        foreach ($accounts as $account) {
            $this->em->persist($account);
        }
        $this->em->flush();
    }

    /** @return Account[] */
    public function all(): array
    {
        return $this->em->getRepository(Account::class)
            ->findAll();
    }
}
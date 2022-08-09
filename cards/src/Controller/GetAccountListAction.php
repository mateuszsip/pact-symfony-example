<?php

declare(strict_types=1);

namespace Cards\Controller;

use Cards\Account;
use Cards\AccountRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class GetAccountListAction
{
    public function __construct(private readonly AccountRepository $repository) {}

    #[Route('/accounts', name: 'account_list')]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse($this->repository->all());
    }
}

<?php

declare(strict_types=1);

namespace UUS\Controller;

use UUS\FetchAccountList;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class GetAccountListAction
{
    public function __construct(private readonly FetchAccountList $fetchAccountList) {}

    #[Route('/accounts', name: 'account_list')]
    public function __invoke(): JsonResponse
    {
        $accounts = ($this->fetchAccountList)();

        return new JsonResponse([
            'accounts' => $accounts
        ]);
    }
}

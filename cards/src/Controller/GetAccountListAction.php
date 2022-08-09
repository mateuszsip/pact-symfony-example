<?php

declare(strict_types=1);

namespace App\Controller;

use App\Account;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class GetAccountListAction
{
    #[Route('/accounts', name: 'account_list')]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            new Account('3022eec0-26fc-49fc-9bb2-b69d24641720'),
            new Account('ee9f9849-fd8b-465e-83c9-327a55ab5009'),
            new Account('8fc2e5b9-ae46-43cb-8acd-707661c9bd16'),
            new Account('b42aeca8-444f-4a91-8375-679c3e496c15'),
            new Account('28258539-f6d4-44ce-ad20-a5f503531f28'),
        ]);
    }
}

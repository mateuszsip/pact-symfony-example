<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class GetAccountListAction
{
    #[Route('/accounts', name: 'account_list')]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'accounts' => [
                new Account('acc-123-456', 'ShinyNewProduct'),
                new Account('3022eec0-26fc-49fc-9bb2-b69d24641720', 'OtherProduct'),
                new Account('997', 'ForgottenProduct'),
            ]
        ]);
    }
}

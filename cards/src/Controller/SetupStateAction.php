<?php

declare(strict_types=1);

namespace Cards\Controller;

use Cards\Account;
use Cards\AccountRepository;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

final class SetupStateAction
{
    public function __construct(
        private readonly Connection $dbConnection,
        private readonly AccountRepository $accountRepository
    ) {}

    #[Route('/setup-state', name: 'setup_state')]
    public function __invoke(Request $request)
    {
        $this->dbConnection->exec('TRUNCATE TABLE account;');

        $payload = $request->toArray();

        $consumer = $payload['consumer'];
        $state = $payload['state'];

        switch ([$consumer, $state]) {
            case ['unified-user-service', 'accounts exist']:
                $accounts = [];

                for ($i=1;$i<=5;$i++) {
                    $accounts[] = new Account(Uuid::v4()->toRfc4122());
                }

                $this->accountRepository->create(...$accounts);

                return new JsonResponse(null, JsonResponse::HTTP_OK);

                break;
        }

        return new JsonResponse(null, JsonResponse::HTTP_NOT_FOUND);
    }
}
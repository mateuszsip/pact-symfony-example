<?php

declare(strict_types=1);

namespace Cards\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class SetupStateAction
{
    #[Route('/setup-state', name: 'setup_state')]
    public function __invoke(Request $request)
    {
        var_dump($request->getContent());
    }
}
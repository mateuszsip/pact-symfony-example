<?php

declare(strict_types=1);

namespace UUS\Tests;

use PhpPact\Consumer\InteractionBuilder;
use PhpPact\Consumer\Matcher\Matcher;
use PhpPact\Consumer\Model\ConsumerRequest;
use PhpPact\Consumer\Model\ProviderResponse;
use PhpPact\Standalone\MockService\MockServer;
use PhpPact\Standalone\MockService\MockServerConfig;
use PhpPact\Standalone\MockService\MockServerEnvConfig;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Uid\Uuid;
use UUS\FetchAccountList;

final class FetchAccountListTest extends KernelTestCase
{
    public function testFetchesAccountList(): void
    {
        $request = new ConsumerRequest();
        $request->setMethod('GET')
            ->setPath('/accounts');

        $matcher = new Matcher();
        $response = new ProviderResponse();
            $response->setStatus(200)
                ->setBody(
                    $matcher->eachLike([
                        'id' => $matcher->like($matcher->uuid()),
                    ], 1),
                );

        $config = new MockServerEnvConfig();
        $builder = new InteractionBuilder($config);
        $builder->given('accounts exist')
            ->uponReceiving('a get request to /accounts')
            ->with($request)
            ->willRespondWith($response);

        /** @var FetchAccountList $sut */
        $sut = self::getContainer()->get(FetchAccountList::class);

        $result = ($sut)();

        self::assertNotEmpty($result);
        foreach ($result as $resultAccount) {
            self::assertTrue(Uuid::isValid($resultAccount->id));
            self::assertSame('Cards', $resultAccount->product);
        }
    }
}

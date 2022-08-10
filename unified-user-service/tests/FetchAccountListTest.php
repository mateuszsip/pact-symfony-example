<?php

declare(strict_types=1);

namespace UUS\Tests;

use PhpPact\Consumer\InteractionBuilder;
use PhpPact\Consumer\Matcher\Matcher;
use PhpPact\Consumer\Model\ConsumerRequest;
use PhpPact\Consumer\Model\ProviderResponse;
use PhpPact\Http\GuzzleClient;
use PhpPact\Standalone\MockService\MockServer;
use PhpPact\Standalone\MockService\MockServerConfig;
use PhpPact\Standalone\MockService\MockServerEnvConfig;
use PhpPact\Standalone\MockService\Service\MockServerHttpService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Uid\Uuid;
use UUS\FetchAccountList;

final class FetchAccountListTest extends KernelTestCase
{
    private MockServerEnvConfig $config;

    public function setUp(): void
    {
        parent::setUp();

        $this->config = new MockServerEnvConfig();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $builder = new InteractionBuilder($this->config);
        $builder->verify();
        $builder->finalize();
    }

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

        $builder = new InteractionBuilder($this->config);
        $builder->given('accounts exist')
            ->uponReceiving('a request for cards accounts')
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

    public function testFetchesEmptyAccountList(): void
    {
        $request = new ConsumerRequest();
        $request->setMethod('GET')
            ->setPath('/accounts');

        $response = new ProviderResponse();
        $response->setStatus(200)
            ->setBody([]);

        $builder = new InteractionBuilder($this->config);
        $builder
            ->uponReceiving('a request for cards accounts')
            ->with($request)
            ->willRespondWith($response);

        /** @var FetchAccountList $sut */
        $sut = self::getContainer()->get(FetchAccountList::class);

        $result = ($sut)();

        self::assertEmpty($result);
    }
}

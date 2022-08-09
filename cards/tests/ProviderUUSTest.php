<?php

declare(strict_types=1);

namespace UUS\Tests;

use GuzzleHttp\Psr7\Uri;
use PhpPact\Standalone\ProviderVerifier\Model\VerifierConfig;
use PhpPact\Standalone\ProviderVerifier\Verifier;
use PHPUnit\Framework\TestCase;

final class ProviderUUSTest extends TestCase
{
    public function testsSatisfiesContracts()
    {
        $config = new VerifierConfig();

        $config->setProviderName('cards')
            ->setProviderVersion('1.0.0')
            ->setProviderBranch('master')
            ->setProviderBaseUrl(new Uri('http://cards-web'))
            ->setProviderStatesSetupUrl('http://cards-web/setup-state')
            ->setBrokerUri(new Uri('http://pact-broker'))
            ->setPublishResults(true);

        $verifier = new Verifier($config);
        $verifier->verify('unified-user-service');

        $this->expectNotToPerformAssertions();
    }
}
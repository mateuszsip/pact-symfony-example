<?php

declare(strict_types=1);

namespace UUS;

use Symfony\Contracts\HttpClient\HttpClientInterface;

final class FetchAccountList
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client, private readonly string $product, string $baseUri)
    {
        $this->client = $client->withOptions([
            'base_uri' => $baseUri,
        ]);
    }

    /** @return Account[] */
    public function __invoke(): array
    {
        $response = $this->client->request(
            'GET',
            '/accounts'
        );

        $payload = $response->toArray();


        return array_map(
            fn(array $account) => new Account($account['id'], $this->product),
            $payload
        );
    }
}
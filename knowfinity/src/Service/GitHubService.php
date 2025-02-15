<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GitHubService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getRepositories(string $username): array
    {
        $response = $this->client->request('GET', 'https://api.github.com/users/' . $username . '/repos');
        return $response->toArray();
    }
}

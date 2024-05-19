<?php

namespace App\Service\ApiAggregator;

use App\Service\SharedApi\Client;
use App\Service\Common\AggregateInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

 class SauravTech implements AggregateInterface
{
    public function __construct(
        private HttpClientInterface $client,
        private $apiUrl,
        private $apiKey
    ) {
    }

    public function fetchPosts(): array
    {
        $client = new Client();
        $data = $client->send($this->client,$this->apiUrl, $this->apiKey);
        $articles = [];
        foreach ($data['articles'] as $item) {
            $articles[] = [
                'title' => $item['title'],
                'author' => $item['author'] ?? '',
                'url' => $item['url'] ?? '',
                'imageUrl' => $item['urlToImage'] ?? '',
                'description' => $item['description'] ?? '',
                'content' => $item['content'] ?? '',
                'publishedAt' => $item['publishedAt']
            ];
        }
        return $articles;
    }
} 
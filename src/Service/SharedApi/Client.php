<?php

namespace App\Service\SharedApi;

class Client
{
    public function send($client,$api, $key):array
    {
        $response = $client->request('GET', $api, [
            'query' => $key ? ['key' => $key] : [],
        ]);
        return $response->toArray(); 
    }
 
} 
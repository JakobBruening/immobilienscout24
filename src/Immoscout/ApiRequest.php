<?php
declare(strict_types=1);

namespace Immoscout;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Immoscout\Exceptions\ApiException;

/**
 * Class ApiRequest
 *
 * @author Jakob Bruening <kontakt@jakobbruening.com>
 * @package Immoscout
 */
class ApiRequest
{
    private Client $client;

    protected const API_URL = 'https://rest.immobilienscout24.de/restapi/api/offer/v1.0/%s';

    public function __construct(?array $auth = null)
    {
        $this->prepareClient($auth);
    }

    /**
     * Authenticate and prepare GuzzleHttp client
     */
    private function prepareClient(?array $authData = null): void
    {
        $key = $authData['consumer_key'] ?? $_ENV['IMSC_CONSUMER_KEY'] ?? null;
        $secret = $authData['consumer_secret'] ?? $_ENV['IMSC_CONSUMER_SECRET'] ?? null;
        $token = $authData['token'] ?? $_ENV['IMSC_TOKEN'] ?? null;
        $tokenSecret = $authData['token_secret'] ?? $_ENV['IMSC_TOKEN_SECRET'] ?? null;

        if (in_array(null, [$key, $secret, $token, $tokenSecret], true)) {
            throw new \LogicException('Invalid authentication data.');
        }

        $stack = HandlerStack::create();

        $stack->push(new Oauth1([
            'consumer_key'    => $key,
            'consumer_secret' => $secret,
            'token'           => $token,
            'token_secret'    => $tokenSecret
        ]));

        $this->client = new Client([
            'handler'               => $stack,
            RequestOptions::AUTH    => 'oauth',
            RequestOptions::HEADERS => ['Accept' => 'application/json'],
        ]);
    }

    /**
     * Sends the api request to ImmoScout24
     */
    protected function request(string $url, string $method = 'GET'): array
    {
        try {
            $request = $this->client->request($method, sprintf(self::API_URL, $url));
        } catch (GuzzleException $e) {
            throw new ApiException($e->getMessage(), $e->getCode());
        }

        try {
            $data = json_decode($request->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new ApiException(sprintf('Invalid API response: %s', $e->getMessage()));
        }

        return $data;
    }
}
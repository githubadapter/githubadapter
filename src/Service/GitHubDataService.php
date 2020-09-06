<?php


namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GitHubDataService
{
    /**
     * @var HttpClientInterface
     */
    private $client;
    /**
     * @var ParameterBagInterface
     */
    private $params;

    /**
     * @param HttpClientInterface $githubClient
     */
    public function __construct(HttpClientInterface $githubClient, ParameterBagInterface $params) {
        $this->client = $githubClient;
        $this->params = $params;
    }

    public function getRepoInfo($owner, $repo) {
        $response = $this->client->request(
            'GET',
            "/repos/$owner/$repo"
        );

        if (Response::HTTP_OK !== $response->getStatusCode()) {
            return null;
        }

        $content = $response->getContent();
        //echo '<pre>'; print_r($response->toArray());
        //print_r($response->getHeaders());
        return $response->toArray();
    }

    public function getUserInfo($login) {
        $response = $this->client->request(
            'GET',
            "/users/$login"
        );

        if (Response::HTTP_OK !== $response->getStatusCode()) {
            return null;
        }

        $content = $response->getContent();
        //echo '<pre>'; print_r($response->toArray());
        //print_r($response->getHeaders());
        return $response->toArray();
    }
}
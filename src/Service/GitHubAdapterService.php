<?php


namespace App\Service;


use App\DTO\GitHubRepoDTO;
use App\DTO\GitHubUserDTO;

class GitHubAdapterService
{
    /**
     * @var GitHubDataService
     */
    private $github;

    /**
     * GitHubAdapterService constructor.
     */
    public function __construct(GitHubDataService $github)
    {
        $this->github = $github;
    }

    public function getRepoInfo($ownerLogin, $repositoryName) {
        $data = $this->github->getRepoInfo($ownerLogin, $repositoryName);

        if  (empty($data)) return null;

        return new GitHubRepoDTO($data);
    }

    public function getUserInfo($login) {
        $data = $this->github->getUserInfo($login);

        if  (empty($data)) return null;

        return new GitHubUserDTO($data);
    }
}
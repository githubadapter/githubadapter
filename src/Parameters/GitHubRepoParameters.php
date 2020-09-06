<?php


namespace App\Parameters;

use Symfony\Component\Validator\Constraints as Assert;

class GitHubRepoParameters{
    /**
     * @Assert\Regex("/^\w/") //start with alphanumeric
     * @Assert\Regex("/\w$/") //end with alphanumeric
     * @Assert\Regex("/^[\w\-]+$/") //maybe hyphens in the middle
     * @Assert\Regex("/^((?!\-\-).)*$/") //no consecutive hyphens
     * @Assert\NotBlank
     * @Assert\Length(max = 39)
     */
    private $login;

    /**
     * @Assert\Regex("/^\w[\w-]*$/") //start with alphanumeric plus maybe hyphens later
     * @Assert\Length(max = 100)
     * @Assert\NotBlank()
     */
    private $repo;

    /**
     * @return mixed
     */
    public function getRepo()
    {
        return $this->repo;
    }

    /**
     * @param mixed $repo
     */
    public function setRepo($repo): void
    {
        $this->repo = $repo;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * GitHubUser constructor.
     */
    public function __construct($login, $repo)
    {
        $this->login = $login;
        $this->repo = $repo;
    }
}
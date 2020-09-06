<?php


namespace App\Parameters;

use Symfony\Component\Validator\Constraints as Assert;

class GitHubUserParameters{
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
    public function __construct($login)
    {
        $this->login = $login;
    }
}
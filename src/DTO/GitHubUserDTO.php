<?php


namespace App\DTO;


class GitHubUserDTO
{
    private $name;
    private $url;
    private $email;
    private $createdAt;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function __toString()
    {
        return
            "Name: " . $this->name . "\n" .
            "Url: " . $this->url . "\n" .
            "Email: " . $this->email . "\n" .
            "Created At: " . $this->createdAt . "\n";
    }

    /**
     * GitHubUserDTO constructor.
     */
    public function __construct($data)
    {
        $this->name = $data['name'] ?? '';
        $this->url = $data['url'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->createdAt = $data['created_at'] ?? '';
    }
}

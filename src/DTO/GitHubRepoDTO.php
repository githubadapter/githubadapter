<?php


namespace App\DTO;


class GitHubRepoDTO
{
    private $fullName;
    private $description;
    private $cloneUrl;
    private $stars;
    private $createdAt;

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCloneUrl()
    {
        return $this->cloneUrl;
    }

    /**
     * @param mixed $cloneUrl
     */
    public function setCloneUrl($cloneUrl): void
    {
        $this->cloneUrl = $cloneUrl;
    }

    /**
     * @return mixed
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * @param mixed $stars
     */
    public function setStars($stars): void
    {
        $this->stars = $stars;
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
            "Full Name: " . $this->fullName . "\n" .
            "Description: " . $this->description . "\n" .
            "Clone Url: " . $this->cloneUrl . "\n" .
            "Stars: " . $this->stars . "\n" .
            "Created At: " . $this->createdAt . "\n";
    }

    /**
     * GitHubRepoDTO constructor.
     */
    public function __construct($data)
    {
        $this->fullName = $data['full_name'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->cloneUrl = $data['url'] ?? '';
        $this->stars = $data['stargazers_count'] ?? '';
        $this->createdAt = $data['created_at'] ?? '';
    }
}

<?php

namespace App\Controller;

use App\Parameters\GitHubRepoParameters;
use App\Parameters\GitHubUserParameters;
use App\Service\GitHubAdapterService;
use Nelmio\ApiDocBundle\Tests\Functional\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\View\View;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ApiController extends FOSRestController
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var GitHubAdapterService
     */
    private $github;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * ApiController constructor.
     */
    public function __construct(
        RequestStack $requestStack,
        ValidatorInterface $validator,
        GitHubAdapterService $github
    )
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->github = $github;
        $this->validator = $validator;
    }

    /**
     * @Route("/api/v1.0/repositories/{ownerLogin}/{repositoryName}", name="apirepo")
     * @ParamConverter("user", class="GitHubUserDTO")
     * @return View
     */
    public function repoInfo($ownerLogin, $repositoryName)
    {
        $repoParams = new GitHubRepoParameters($ownerLogin, $repositoryName);
        $errors = $this->validator->validate($repoParams);

        if (count($errors) > 0) {
            return View::create('Bad parameters', Response::HTTP_BAD_REQUEST);
        }

        $data = $this->github->getRepoInfo($ownerLogin, $repositoryName);

        if (empty($data)) {
            return View::create('Error getting data', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return View::create($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/v1.0/users/{login}", name="apiuser")
     * @return View
     */
    public function userInfo($login)
    {
        $userParams = new GitHubUserParameters($login);
        $errors = $this->validator->validate($userParams);

        if (count($errors) > 0) {
            return View::create('Bad parameters', Response::HTTP_BAD_REQUEST);
        }

        $data = $this->github->getUserInfo($login);

        if (empty($data)) {
            return View::create('Error getting data', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return View::create($data, Response::HTTP_OK);
    }
}

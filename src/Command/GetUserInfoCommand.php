<?php


namespace App\Command;


use App\Parameters\GitHubUserParameters;
use App\Service\GitHubAdapterService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class GetUserInfoCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:userinfo';
    /**
     * @var GitHubAdapterService
     */
    private $github;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(
        ValidatorInterface $validator,
        GitHubAdapterService $github
    )
    {
        $this->github = $github;
        $this->validator = $validator;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('userinfo')
            ->setDescription('Gets user info from GitHub')
            ->addArgument('login', InputArgument::REQUIRED, 'Please enter user login');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $login = $input->getArgument('login');

        $userParams = new GitHubUserParameters($login);
        $errors = $this->validator->validate($userParams);

        if (count($errors) > 0) {
            $output->writeln('Bad parameters');
            return 400;
        }

        $data = $this->github->getUserInfo($login);

        if (empty($data)) {
            $output->writeln('Error getting data');
            return 500;
        }

        echo $data;

        return 0;
    }
}
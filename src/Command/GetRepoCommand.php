<?php


namespace App\Command;


use App\Parameters\GitHubRepoParameters;
use App\Parameters\GitHubUserParameters;
use App\Service\GitHubAdapterService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class GetRepoCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:repoinfo';
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
            ->setName('repoinfo')
            ->setDescription('Gets repo info from GitHub')
            ->addArgument('login', InputArgument::REQUIRED, 'Please enter user login')
            ->addArgument('repo', InputArgument::REQUIRED, 'Please enter repo name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $login = $input->getArgument('login');
        $repo = $input->getArgument('repo');

        $repoParams = new GitHubRepoParameters($login, $repo);
        $errors = $this->validator->validate($repoParams);

        if (count($errors) > 0) {
            $output->writeln('Bad parameters');
            return 400;
        }

        $data = $this->github->getRepoInfo($login, $repo);

        if (empty($data)) {
            $output->writeln('Error getting data');
            return 500;
        }

        echo $data;

        return 0;
    }
}
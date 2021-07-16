<?php

namespace App\Command;

use App\Security\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Trismegiste\Toolbox\MongoDb\Repository;

/**
 * Description of CreateUserCommand
 */
class CreateUser extends Command
{

    protected static $defaultName = 'app:create-user';
    private $encoderFactory;
    private $repository;

    public function __construct(PasswordHasherFactoryInterface $encoderFactory, Repository $userRepo)
    {
        $this->encoderFactory = $encoderFactory;
        $this->repository = $userRepo;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Create a new admin user')
                ->addArgument('user', InputArgument::REQUIRED, 'username');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('user');
        $io->title($this->getDescription() . ' : ' . $username);

        $password = $io->ask('Password');
        $encoder = $this->encoderFactory->getPasswordHasher(User::class);
        $encodedPwd = $encoder->hash($password);

        $user = new User($username, $encodedPwd);
        // save to a mongo collection
        $this->repository->save($user);

        return 0;
    }

}

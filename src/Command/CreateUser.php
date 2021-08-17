<?php

namespace App\Command;

use App\Entity\Negotiator;
use App\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
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
    private $hasher;
    private $repository;

    public function __construct(PasswordHasherFactoryInterface $encoderFactory, Repository $userRepo)
    {
        $this->hasher = $encoderFactory->getPasswordHasher(User::class);
        $this->repository = $userRepo;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Create a new user')
                ->addArgument('user', InputArgument::REQUIRED, 'The unique identifier')
                ->addArgument('role', InputArgument::REQUIRED, 'The user role : USER, NEGOTIATOR, ADMIN');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('user');
        $io->title($this->getDescription() . ' : ' . $username);

        $password = $io->ask('Password');
        $encodedPwd = $this->hasher->hash($password);

        // Role
        $role = $input->getArgument('role');
        switch ($role) {
            case 'USER' :
                $user = new User($username);
                break;
            case 'NEGOTIATOR':
                $user = new Negotiator($username);
                $user->setRoles(['ROLE_NEGOTIATOR']);
                break;
            case 'ADMIN':
                $user = new User($username);
                $user->setRoles(['ROLE_USER', 'ROLE_NEGOTIATOR', 'ROLE_ADMIN']);
                break;
            default :
                throw new InvalidArgumentException("Role $role is unknown");
        }
        $user->setHashedPassword($encodedPwd);

        // save to a mongo collection
        $this->repository->save($user);

        return 0;
    }

}

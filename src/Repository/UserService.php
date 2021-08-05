<?php

/*
 * Vesta
 */

namespace App\Repository;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use App\Entity\User;
use Trismegiste\Toolbox\MongoDb\Repository;

/**
 * UserRepo is a repository for User with business intelligence
 */
class UserService
{

    protected $repo;
    protected $hasher;

    public function __construct(Repository $userRepo, PasswordHasherFactoryInterface $h)
    {
        $this->repo = $userRepo;
        $this->hasher = $h->getPasswordHasher(User::class);
    }

    public function createAndSave(string $email, string $crypto): User
    {
        $user = new User($email, $this->hasher->hash($crypto));
        $this->repo->save($user);

        return $user;
    }

}

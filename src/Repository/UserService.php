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

    public function create(string $email): User
    {
        return new User($email);
    }

    public function changePassword(User $u, string $pwd): void
    {
        $u->setHashedPassword($this->hasher->hash($pwd));
    }

    public function save(User $u): void
    {
        $this->repo->save($u);
    }

}

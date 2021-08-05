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

    public function create(string $email, string $crypto): User
    {
        return new User($email, $this->hasher->hash($crypto));
    }

    public function save(User $u): void
    {
        $this->repo->save($u);
    }

}

<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Trismegiste\Toolbox\MongoDb\Root;
use Trismegiste\Toolbox\MongoDb\RootImpl;

class User implements UserInterface, Root, PasswordAuthenticatedUserInterface
{

    use RootImpl;

    protected $username;
    protected $roles = [];
    // human
    public $firstname;
    public $lastname;
    public $phone;
    public $professional;
    public $fingerPrint; // browser fingerprint
    public $searchCriterion; // last search

    /**
     * @var string The hashed password
     */
    private $password;

    public function __construct(string $user)
    {
        $this->username = $user;
        $this->roles = ['ROLE_USER'];
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    public function setHashedPassword(string $pwd): void
    {
        $this->password = $pwd;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = array_unique($roles);
    }

}

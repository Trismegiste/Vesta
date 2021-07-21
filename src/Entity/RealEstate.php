<?php

namespace App\Entity;

use Trismegiste\Toolbox\MongoDb\Root;
use Trismegiste\Toolbox\MongoDb\RootImpl;

/**
 * RealEstate is a real Estate
 */
class RealEstate implements Immovable, Root
{

    use RootImpl;

    protected $currentState;
    protected $titre;
    protected $description;
    protected $tag = [];
    protected $location;
    protected $surface;
    protected $piece;
    protected $prix;
    protected $devise = 'EUR';

    public function __construct()
    {
        $this->location = new Address();
    }

    public function getCurrentState()
    {
        return $this->currentState;
    }

    public function setCurrentState($param, $context = [])
    {
        $this->currentState = $param;
    }

    public function getAddress(): Address
    {
        return $this->location;
    }

    public function setTitre(string $t): void
    {
        $this->titre = $t;
    }

    public function setDescription(string $t): void
    {
        $this->description = $t;
    }

    public function setSurface(int $s): void
    {
        $this->surface = $s;
    }

    public function setPiece(string $p): void
    {
        $this->piece = $p;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSurface(): int
    {
        return $this->surface;
    }

    public function getPiece(): int
    {
        return $this->piece;
    }

    public function addTag(string $tag): void
    {
        if (false === array_search($tag, $this->tag)) {
            array_push($this->tag, $tag);
        }
    }

    public function deleteTag(string $tag): void
    {
        $idx = array_search($tag, $this->tag);
        if (false !== $idx) {
            unset($this->tag[$idx]);
        }
    }

    public function getTag(): array
    {
        return $this->tag;
    }

    public function getPrix(): int
    {
        return $this->prix;
    }

    public function setPrix(int $p)
    {
        $this->prix = $p;
    }

    public function getDevise(): string
    {
        return $this->devise;
    }

}

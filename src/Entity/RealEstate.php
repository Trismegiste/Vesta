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
    protected $title;
    protected $description;
    protected $tag = [];
    protected $location;
    protected $surface;
    protected $room;
    protected $price;
    protected $currency = 'EUR';

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

    public function setTitle(string $t): void
    {
        $this->title = $t;
    }

    public function setDescription(string $t): void
    {
        $this->description = $t;
    }

    public function setSurface(int $s): void
    {
        $this->surface = $s;
    }

    public function setRoom(string $p): void
    {
        $this->room = $p;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSurface(): int
    {
        return $this->surface;
    }

    public function getRoom(): int
    {
        return $this->room;
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

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $p)
    {
        $this->price = $p;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

}

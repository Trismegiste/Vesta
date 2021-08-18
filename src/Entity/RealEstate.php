<?php

namespace App\Entity;

use MongoDB\BSON\ObjectIdInterface;
use Trismegiste\Toolbox\MongoDb\Root;
use Trismegiste\Toolbox\MongoDb\RootImpl;

/**
 * RealEstate is a real estate
 */
class RealEstate implements Immovable, Root
{

    use RootImpl;

    protected $currentState = ['photoshoot' => true];
    // FRONT INFORMATION
    protected $category;
    protected $tag = [];
    protected $price = 0;
    protected $currency = 'EUR';
    // location
    protected $streetAddr = '';
    protected $postalCode = '';
    protected $city = '';
    protected $latitude = 0;
    protected $longitude = 0;
    // fk
    protected $owner;
    protected $negotiator;
    // MLS
    public $dweller = false;
    protected $buildingInfo;
    protected $termsOfSale;
    protected $diagnosticDescr;
    protected $appartDescr;

    public function getCurrentState()
    {
        return $this->currentState;
    }

    public function setCurrentState($param, $context = [])
    {
        $this->currentState = $param;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $param)
    {
        $this->category = $param;
    }

    public function getSurface(): int
    {
        return $this->appartDescr->carrezArea;
    }

    public function getRoom(): int
    {
        return $this->appartDescr->room;
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

    public function setCoord(float $long, float $lat): void
    {
        $this->longitude = $long;
        $this->latitude = $lat;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * Is there an offer on this item ?
     * 
     * @return bool
     */
    public function hasOffer(): bool
    {
        return (bool) random_int(0, 1);
    }

    /**
     * Is this a new item ?
     * 
     * @return bool
     */
    public function isNewEntry(): bool
    {
        return (bool) random_int(0, 1);
    }

    /**
     * The floor in the building
     * 
     * @return int
     */
    public function getFloor(): int
    {
        return $this->appartDescr->floor;
    }

    /**
     * Gets the percentage (between 0 to 100) for ALL the requisite
     * informations needed by the Notary
     * 
     * @return int
     */
    public function getCompletionPercent(): int
    {
        return 0;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getAddress(): string
    {
        return $this->streetAddr;
    }

    public function setAddress(string $addr): void
    {
        $this->streetAddr = $addr;
    }

    public function setCity(string $c): void
    {
        $this->city = $c;
    }

    public function setPostalCode(string $pc): void
    {
        $this->postalCode = $pc;
    }

    public function setLatitude(float $l): void
    {
        $this->latitude = $l;
    }

    public function setLongitude(float $l): void
    {
        $this->longitude = $l;
    }

    public function setOwnerFk(User $u): void
    {
        $this->owner = $u->getPk();
    }

    public function getOwnerFk(): ObjectIdInterface
    {
        return $this->owner;
    }

    public function getBuilding(): ?Building
    {
        return $this->buildingInfo;
    }

    public function setBuilding(Building $info): void
    {
        $this->buildingInfo = $info;
    }

    public function getTermsOfSale(): ?TermsOfSale
    {
        return $this->termsOfSale;
    }

    public function setTermsOfSale(TermsOfSale $info): void
    {
        $this->termsOfSale = $info;
    }

    public function getDiagnostics(): ?Diagnostics
    {
        return $this->diagnosticDescr;
    }

    public function setDiagnostics(Diagnostics $info): void
    {
        $this->diagnosticDescr = $info;
    }

    public function getAppartDescr(): ?AppartDescr
    {
        return $this->appartDescr;
    }

    public function setAppartDescr(AppartDescr $info): void
    {
        $this->appartDescr = $info;
    }

    public function isGeoValid(): bool
    {
        return ($this->latitude != 0) && ($this->longitude != 0);
    }

    public function setNegotiatorFk(Negotiator $neg): void
    {
        $this->negotiator = $neg->getPk();
    }

    public function getNegotiatorFk(): ObjectIdInterface
    {
        return $this->negotiator;
    }

}

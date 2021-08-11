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
    protected $title = '';
    protected $description = '';
    protected $tag = [];
    protected $room = 0;
    protected $floorNumber = 0;
    protected $price = 0;
    protected $currency = 'EUR';
    // location
    protected $streetAddr = '';
    protected $postalCode = '';
    protected $city = '';
    protected $latitude = 0;
    protected $longitude = 0;
    // @todo autre possibilité : faire un tableau pour le stockage ['addr'=>'','pc'=>''...], les accesseurs étant inchangés
    // fk
    protected $owner;
    public $dweller = false;
    // MLS
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

    public function setTitle(string $t): void
    {
        $this->title = $t;
    }

    public function setDescription(string $t): void
    {
        $this->description = $t;
    }

    public function setFloor(int $param): void
    {
        $this->floorNumber = $param;
    }

    public function setRoom(int $p): void
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
        return $this->floorNumber;
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

    public function setFkOwner(ObjectIdInterface $id): void
    {
        $this->owner = $id;
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

}

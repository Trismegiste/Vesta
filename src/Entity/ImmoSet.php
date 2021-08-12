<?php

/*
 * Vesta
 */

namespace App\Entity;

/**
 * Description of ImmoSet
 *
 * @author flo
 */
class ImmoSet implements \Iterator
{

    protected $iter;
    protected $maxLat = -90;
    protected $minLat = 90;
    protected $maxLong = -180;
    protected $minLong = 180;

    public function __construct(\Iterator $iter)
    {
        $this->iter = $iter;
    }

    public function current()
    {
        $this->updateBoudaries();
        return $this->iter->current();
    }

    public function key(): int
    {
        return $this->iter->key();
    }

    public function next(): void
    {
        $this->iter->next();
    }

    public function rewind(): void
    {
        $this->iter->rewind();
    }

    public function valid(): bool
    {
        return $this->iter->valid();
    }

    /**
     * Gets the bounding box for all **SCANNED** Immovable in this Iterator
     * 
     * @return [[$minLat, $minLong], [$maxLat, $maxLong]]
     * @throws InvalidArgumentException
     */
    public function getBoundaries(): array
    {
        return [[$this->minLat, $this->minLong], [$this->maxLat, $this->maxLong]];
    }

    private function updateBoudaries(): void
    {
        $item = $this->iter->current();

        if (!$item instanceof Immovable) {
            throw new \InvalidArgumentException("Item is not an Immovable");
        }

        if ($item->getLongitude() < $this->minLong) {
            $this->minLong = $item->getLongitude();
        }
        if ($item->getLongitude() > $this->maxLong) {
            $this->maxLong = $item->getLongitude();
        }
        if ($item->getLatitude() < $this->minLat) {
            $this->minLat = $item->getLatitude();
        }
        if ($item->getLatitude() > $this->maxLat) {
            $this->maxLat = $item->getLatitude();
        }
    }

}

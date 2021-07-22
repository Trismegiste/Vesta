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

    public function __construct(\Iterator $iter)
    {
        $this->iter = $iter;
    }

    public function current()
    {
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
     * Gets the bounding box for all Immovable in this Iterator
     * 
     * @return [[$minLat, $minLong], [$maxLat, $maxLong]]
     * @throws InvalidArgumentException
     */
    public function getBoundaries(): array
    {
        $maxLat = -90;
        $minLat = 90;
        $maxLong = -180;
        $minLong = 180;
        $this->iter->rewind(); // @todo Is it OK with a MongoCursor ? Forward Only Cursor ?

        foreach ($this->iter as $item) {
            if (!$item instanceof Immovable) {
                throw new InvalidArgumentException("Item is not an Immovable");
            }
            if ($item->getLongitude() < $minLong) {
                $minLong = $item->getLongitude();
            }
            if ($item->getLongitude() > $maxLong) {
                $maxLong = $item->getLongitude();
            }
            if ($item->getLatitude() < $minLat) {
                $minLat = $item->getLatitude();
            }
            if ($item->getLatitude() > $maxLat) {
                $maxLat = $item->getLatitude();
            }
        }

        return [[$minLat, $minLong], [$maxLat, $maxLong]];
    }

}

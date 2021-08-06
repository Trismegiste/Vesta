<?php

/*
 * Vesta
 */

namespace App\Repository;

use InvalidArgumentException;
use Symfony\Component\Yaml\Yaml;

/**
 * A repository for flat list stored in yml file
 */
class YamlRepository
{

    protected $data;
    protected $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    protected function restore(): void
    {
        if (is_null($this->data)) {
            $this->data = Yaml::parseFile($this->path);
        }
    }

    public function findAll(string $key): array
    {
        $this->restore();
        if (!array_key_exists($key, $this->data)) {
            throw new InvalidArgumentException("No data for the key '$key'");
        }
        $tmp = $this->data[$key];

        $listing = [];
        foreach ($tmp as $row) {
            $listing[$row] = $row;
        }

        return $listing;
    }

}

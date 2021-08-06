<?php

/*
 * Vesta
 */

namespace App\Repository;

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
            $tmp = Yaml::parseFile($this->path);
            foreach ($tmp as $row) {
                $this->data[$row] = $row;
            }
        }
    }

    public function get(): array
    {
        $this->restore();

        return $this->data;
    }

}

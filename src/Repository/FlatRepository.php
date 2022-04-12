<?php

/*
 * Vesta
 */

namespace Trismegiste\SymfoTools\Repository;

/**
 * Repository for flat full text choices
 */
interface FlatRepository
{

    public function findAll(string $key): array;
}

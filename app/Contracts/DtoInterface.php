<?php

namespace App\Contracts;

interface DtoInterface
{
    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @param array $data
     * 
     * @return self
     */
    public static function fromArray(array $data): self;
}

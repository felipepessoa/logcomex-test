<?php

namespace App\Dto\Pokemon;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class PokemonDto extends Data
{
    public function __construct(
        public string $name,
        public string $type,
        public int $height,
        public float $weight,
    )
    {
    }
}

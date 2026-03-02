<?php

namespace App\Dto\Pokemon\Service;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class PokemonListItemDto extends Data
{
    public function __construct(
        public string $name,
        public string $url,
    )
    {
    }
}

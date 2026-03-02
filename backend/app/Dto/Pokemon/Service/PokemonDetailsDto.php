<?php

namespace App\Dto\Pokemon\Service;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class PokemonDetailsDto extends Data
{
    public function __construct(
        public string $name,
        public string $type,
        public int $height,
        public float $weight,
    )
    {
    }

    public static function fromApi(array $data): self
    {
        return new self(
            name: $data['name'],
            type: $data['types'][0]['type']['name'] ?? 'unknown',
            height: $data['height'],
            weight: $data['weight'],
        );
    }
}

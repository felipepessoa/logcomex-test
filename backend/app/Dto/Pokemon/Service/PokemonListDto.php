<?php

namespace App\Dto\Pokemon\Service;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class PokemonListDto extends Data
{
    public function __construct(
        public int $count,
        public ?string $next,
        public ?string $previous,
        #[DataCollectionOf(PokemonListItemDto::class)]
        public DataCollection $results,
    )
    {
    }
}

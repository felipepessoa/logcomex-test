<?php

namespace App\Dto\Pokemon;

use App\Models\Pokemon\Pokemon;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Support\Validation\ValidationContext;
#[MapName(SnakeCaseMapper::class)]
class PokemonFilterDto extends Data
{
    public function __construct(
        public ?string $name = null,
        public ?string $type = null,
    )
    {}

    public static function rules(?ValidationContext $context = null): array
    {
        return [
            'name' => [
                'nullable',
                'string',
                'max:255'
            ],
            'type' => [
                'nullable',
                'string',
                'max:255',
                Rule::exists(Pokemon::class, 'type'),
            ],
        ];
    }

    public static function attributes(...$args): array
    {
        return [
            'name' => 'Name',
            'type' => 'Type',
        ];
    }


}

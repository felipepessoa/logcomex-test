<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript, MapName(SnakeCaseMapper::class)]
class ExpenseRequestFilterData extends Data
{
    public function __construct(
        public readonly ?string $collaborator = null,
        public readonly ?string $cnpj = null,
        public readonly ?string $merchant = null,
        public readonly ?string $category = null,
    )
    {
    }

    public static function rules(?ValidationContext $context = null): array
    {
        return [
            'collaborator' => 'nullable|string',
            'cnpj' => 'nullable|string',
            'merchant' => 'nullable|string',
            'category' => 'nullable|string',
        ];
    }
}

<?php

namespace App\Data;

use App\Data\Normalizers\ExpenseAiNormalizer;
use App\Models\Expense;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript, MapName(SnakeCaseMapper::class)]
class ExpenseData extends Data
{
    public function __construct(
        public ?string $collaborator = null,
        public ?string $cnpj = null,
        public ?string $merchantName = null,
        public ?string $date = null,
        public ?string $category = null,
        public ?int    $amount = null
    )
    {
    }

    public static function normalizers(): array
    {
        return array_merge(
            [ExpenseAiNormalizer::class],
            parent::normalizers()
        );
    }

    public static function fromModel(Expense $expense): self
    {
        return new self(
            collaborator: $expense->collaborator,
            cnpj: $expense->cnpj,
            merchantName: $expense->merchant_name,
            date: $expense->date->format('Y-m-d'),
            category: $expense->category,
            amount: $expense->amount

        );
    }

    public function toModel(): array
    {
        return [
            'collaborator' => $this->collaborator,
            'cnpj' => $this->cnpj,
            'merchantName' => $this->merchantName,
            'date' => $this->date,
            'category' => $this->category,
            'amount' => $this->amount
        ];
    }
}

<?php

namespace App\Data;

use App\Models\Expense;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ExpenseCollectionData extends Data
{
    public function __construct(
        #[DataCollectionOf(ExpenseData::class)]
        public DataCollection $expenses,
    )
    {
    }

    public static function fromAi(array $data): self
    {
        return self::from([
            'expenses' => ExpenseData::collect($data)
        ]);
    }

    public static function fromCollection(Collection $expenses): self
    {
        return new self(
            expenses: new DataCollection(
                ExpenseData::class,
                $expenses
                    ->map(fn (Expense $expense) => ExpenseData::fromModel($expense))
                    ->all()
            )
        );
    }
}

<?php

namespace App\Services\AI\Expense;

use App\Models\Expense;
use DB;
use Illuminate\Support\Collection;
use Spatie\LaravelData\DataCollection;

class ExpenseImporter
{
    public function import(DataCollection $expenses): Collection
    {
        return DB::transaction(function () use ($expenses) {
            $imported = collect();
            foreach ($expenses as $expense) {
                $attr = $expense->toModel();
                if ($this->isDuplicate($attr)) {
                    continue;
                }
                $imported->push(Expense::query()->create($attr));
            }
            return $imported;
        });
    }


    private function isDuplicate(array $data): bool
    {
        return Expense::query()->where('collaborator', $data['collaborator'])
            ->where('cnpj', $data['cnpj'])
            ->where('merchant_name', $data['merchantName'])
            ->where('date', $data['date'])
            ->where('amount', $data['amount'])
            ->exists();
    }
}

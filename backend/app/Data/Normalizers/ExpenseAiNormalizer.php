<?php

namespace App\Data\Normalizers;

use App\Data\ExpenseData;
use Carbon\Carbon;
use Exception;
use Spatie\LaravelData\Normalizers\Normalizer;

class ExpenseAiNormalizer implements Normalizer
{
    public function normalize(mixed $value): ?array
    {

        if (!is_array($value) || empty($value)) {
            return null;
        }

        return [
            'collaborator' => $this->nullableString($value['collaborator'] ?? null),
            'cnpj' => $this->normalizeCnpj($value['cnpj'] ?? null),
            'merchant_name' => $this->nullableString($value['merchant_name'] ?? null),
            'date' => $this->normalizeDate($value['date'] ?? null),
            'category' => $this->nullableString($value['category'] ?? null),
            'amount' => $this->normalizeAmount($value['amount'] ?? null),
        ];
    }


    private function nullableString(mixed $value): ?string
    {
        return is_string($value) ? trim($value) : null;
    }

    private function normalizeCnpj(mixed $value): ?string
    {
        $digits = preg_replace('/\D/', '', $value);
        return strlen($digits) === 14 ? $digits : null;
    }

    private function normalizeDate(mixed $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (Exception $e) {
            return null;
        }
    }

    private function normalizeAmount(mixed $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        if (is_int($value)) {
            return $value;
        }

        if (is_float($value)) {
            return round($value * 100);
        }

        $raw = trim($value);
        if (preg_match('/^\d+$/', $raw)) {
            return (int)$raw;
        }
        $clean = preg_replace('/[^\d,.-]/', '', $raw) ?? '';
        $clean = str_replace('.', '', $clean);
        $clean = str_replace(',', '.', $clean);
        if (!is_numeric($clean)) {
            return null;
        }
        return (int)round((float)$clean * 100);

    }
}

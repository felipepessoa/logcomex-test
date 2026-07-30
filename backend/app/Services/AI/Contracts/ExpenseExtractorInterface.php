<?php

namespace App\Services\AI\Contracts;

interface ExpenseExtractorInterface
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public function extract(string $pdfContent): array;
}

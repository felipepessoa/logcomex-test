<?php

namespace App\Jobs;

use App\Data\ExpenseCollectionData;
use App\Services\AI\Contracts\ExpenseExtractorInterface;
use App\Services\AI\Expense\ExpenseImporter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;

class ProcessExpenseImportJob implements ShouldQueue
{
    use Queueable, SerializesModels;

    public int $timeout = 300;

    public function __construct(
        public string $pdfContent,
    )
    {
    }

    public function handle(
        ExpenseExtractorInterface $extractor,
        ExpenseImporter $importer
    ): void {
        $rawExpenses = $extractor->extract($this->pdfContent);
        $normalized = ExpenseCollectionData::fromAi($rawExpenses);
        $imported = $importer->import($normalized->expenses);
    }
}

<?php

namespace App\Http\Controllers;

use App\Data\ExpenseCollectionData;
use App\Data\ExpenseRequestFilterData;
use App\Data\ImportExpenseRequestData;
use App\Jobs\ProcessExpenseImportJob;
use App\Models\Expense;
use Illuminate\Http\JsonResponse;

class ExpensesController extends Controller
{
    public function import(ImportExpenseRequestData $request): JsonResponse
    {
        $content = file_get_contents($request->file->getRealPath());

        ProcessExpenseImportJob::dispatch(base64_encode($content));

        return response()->json(['message' => 'Importação iniciada com sucesso'],202);
    }

    public function index(ExpenseRequestFilterData $request): JsonResponse
    {
        $query = Expense::query()->orderBy('id');

        if (!empty($request->collaborator)) {
            $query->where('collaborator', 'ilike', "%$request->collaborator%");
        }
        if (!empty($request->category)) {
            $query->where('category', 'ilike', "%$request->category%");
        }
        if (!empty($request->cnpj)) {
            $query->where('cnpj', 'ilike', "%$request->cnpj%");
        }
        if (!empty($request->merchant)) {
            $query->where('merchant_name', 'ilike', "%$request->merchant%");
        }

        return response()->json(
            ExpenseCollectionData::fromCollection($query->get())
        );

    }
}

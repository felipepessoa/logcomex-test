<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable(['collaborator', 'cnpj','merchant_name', 'date', 'category', 'amount'])]
class Expense extends Model
{
    use HasUuid;

    protected function casts()
    {
        return [
            'date' => 'date'
        ];
    }

}

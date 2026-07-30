<?php

namespace App\Data;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript, MapName(SnakeCaseMapper::class)]
class ImportExpenseRequestData extends Data
{
    public function __construct(
        public readonly UploadedFile $file,
    )
    {
    }

    public static function rules(?ValidationContext $context = null): array
    {
        return [
            'file' => 'required|file|mimetypes:application/pdf',
        ];
    }

    public static function attributes(...$args): array
    {
        return [
            'file' => 'Arquivo',
        ];
    }
}

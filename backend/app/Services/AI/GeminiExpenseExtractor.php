<?php

namespace App\Services\AI;

use App\Exceptions\AiExtractException;
use App\Services\AI\Contracts\ExpenseExtractorInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class GeminiExpenseExtractor implements ExpenseExtractorInterface
{
    public function extract(string $pdfContent): array
    {
        $apiKey = config('ai-providers.gemini.api_key');
        $model = config('ai-providers.gemini.model');
        $timeout = config('ai-providers.gemini.timeout');

        if (empty($apiKey)) {
            throw new AiExtractException('Chave de API não configurada.');
        }

        $schema = [
            'type' => 'object',
            'properties' => [
                'expenses' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'object',
                        'properties' => [
                            'collaborator' => ['type' => 'string', 'nullable' => true],
                            'cnpj' => ['type' => 'string', 'nullable' => true],
                            'merchant_name' => ['type' => 'string', 'nullable' => true],
                            'date' => ['type' => 'string', 'nullable' => true],
                            'category' => ['type' => 'string', 'nullable' => true],
                            'amount' => ['type' => 'integer', 'nullable' => true],
                        ],
                        'required' => [
                            'collaborator',
                            'cnpj',
                            'merchant_name',
                            'date',
                            'category',
                            'amount',
                        ],
                    ],
                ],
            ],
            'required' => ['expenses'],
        ];

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => 'Extraia todas as despesas de viagem corporativa deste documento PDF escaneado. '
                                . 'Retorne apenas JSON no formato solicitado. '
                                . 'Preserve a ordem das despesas conforme aparecem no documento. '
                                . 'Para valores monetários, retorne amount em centavos (inteiro). '
                                . 'Campos ausentes devem ser null.',
                        ],
                        [
                            'inline_data' => [
                                'mime_type' => 'application/pdf',
                                'data' => base64_encode($pdfContent),
                            ],
                        ],
                    ],
                ],
            ],
            'generationConfig' => [
                'responseMimeType' => 'application/json',
                'responseSchema' => $schema,
            ],
        ];

        try{
            $response = Http::timeout($timeout)
                ->post(sprintf(config('ai-providers.gemini.url'), $model, $apiKey), $payload);
        } catch (ConnectionException $e) {
            throw new AiExtractException('Erro de conexão com o serviço Gemini: ' . $e->getMessage());
        }

        if($response->failed()){
            dd($response->body());
            throw new AiExtractException('Erro ao extrair despesas');
        }

        $text = data_get($response->json(), 'candidates.0.content.parts.0.text');

        if(! is_string($text) || empty($text)){
            throw new AiExtractException('Resposta vazia do Gemini');
        }

        $decoded = json_decode($text, true);
        if(! is_array($decoded) || ! isset($decoded['expenses']) || ! is_array($decoded['expenses'])){
            throw new AiExtractException('JSON mal formatado');
        }


        return $decoded['expenses'];


    }
}
